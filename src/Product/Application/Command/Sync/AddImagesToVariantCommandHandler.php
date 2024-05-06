<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync;

use App\Product\Domain\Model\Image;
use App\Product\Domain\Model\ImageId;
use App\Product\Domain\Model\VariantId;
use App\Product\Domain\Repository\ImageRepositoryInterface;
use App\Product\Domain\Repository\VariantRepositoryInterface;
use App\Product\Domain\Service\ThumbnailServiceInterface;
use App\Setting\Domain\Service\SettingServiceInterface;
use App\Shared\Application\Command\Sync\CommandHandlerInterface;
use App\Shared\Application\Service\IdGeneratorInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[AsMessageHandler()]
class AddImagesToVariantCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private VariantRepositoryInterface $variantRepository,
        private ImageRepositoryInterface $imageRepository,
        private IdGeneratorInterface $idGenerator,
        private ThumbnailServiceInterface $thumbnailService       
    ) {
    }
    
    public function __invoke(AddImagesToVariantCommand $command)
    {   
        $variant = $this->variantRepository->get(new VariantId($command->getVariantId()));
     //   dump($command);
        foreach ($command->getImages() as $picture) {
            /**
             * @var UploadedFile $file
             */ 
            $file = $picture['file'];
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $result = $file->move('/var/www/symfony_docker/public/uploads/images/'.$command->getVariantId(), $filename);
            

            $urls = $this->thumbnailService->generateThumbs($result, $filename, $command->getVariantId());
        //    dd($picture);
            $image = Image::create(
                new ImageId($this->idGenerator->generate()->toString()),
                $picture['main'],
                $result->getFilename(),
                $filename,
                $result->getMimeType(),
                $urls           
            );
        //    $file->move($this->photoDir, $filename);
            $variant->addImage($image);
    
        }
      // dd($variant);
    //  dd($file);
        $this->variantRepository->save($variant);
    }
}

