<?php

declare(strict_types=1);

namespace App\Product\Application\Service;

use App\Product\Domain\Service\ThumbnailServiceInterface;
use App\Setting\Domain\Service\SettingServiceInterface;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Imagine\Image\Palette\RGB;
use Imagine\Image\Point;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ThumbnailService implements ThumbnailServiceInterface
{
    private Imagine $imagine;
    private Filesystem $filesystem;

    public function __construct(
        private SettingServiceInterface $settingService,    
    )
    {
        $this->imagine = new Imagine;
        $this->filesystem = new Filesystem;

    }
    
    public function generateThumbs(File $file, string $filename, string $variantId): array
    {
        $thumbsConfig = $this->settingService->getThumbSettings()->getData();
        
        $urls = [];
        foreach ($thumbsConfig['sizes'] as $size) {

            $newWidth = $size['width'];
            $newHeight = $size['height'];

            $image = $this->imagine->open($file);
           
            $currentWidth = $image->getSize()->getWidth();
            $currentHeight = $image->getSize()->getHeight();

            $ratioWidth = $newWidth/$currentWidth;
            $ratioHeight = $newHeight/$currentHeight;

            if ($ratioWidth < $ratioHeight) {
                $newWidth = $currentWidth * $ratioWidth;
                $newHeight = $currentHeight * $ratioWidth;

            } else {
                $newWidth = $currentWidth * $ratioHeight;
                $newHeight = $currentHeight * $ratioHeight;
            }  
            $newSize = new Box($size['width'], $size['height']);
    
            $backgroundColor = (new RGB)->color($thumbsConfig['background_color']);
            $newImage = $this->imagine->create($newSize, $backgroundColor);

            $newImage->paste(
                $image->resize(new Box($newWidth, $newHeight), ImageInterface::FILTER_LANCZOS),
                new Point(abs($size['width']-$newWidth)/2, abs($size['height']-$newHeight)/2)
            );

            $this->filesystem->mkdir($this->generateDir($size, $variantId));

            $thumbnailPath = $this->generateThumbnailPath($size, $filename, $variantId);

            $newImage->save($thumbnailPath, ['jpeg_quality' => 100]);
            $urls[] = $thumbnailPath;

        }

        return $urls;
    }
    
    private function generateThumbnailPath(array $thumb, $filename, $variantId): string
    {
        return $this->generateDir($thumb, $variantId).$filename;
    }
    private function generateDir(array $thumb, $variantId)
    {
        $dir = '/var/www/symfony_docker/public/uploads/images/';
        $dir .=$variantId.'/'.$thumb['width'].'x'.$thumb['height'].'/';

        return $dir;
    }

    
}