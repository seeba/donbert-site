<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync\AddImagesToProduct;

use App\Product\Application\Command\Sync\AddImagesToProduct\AddImagesToProductCommand;
use App\Product\Domain\Model\Image;
use App\Product\Domain\Model\ImageId;
use App\Product\Domain\Model\ProductId;
use App\Product\Domain\Repository\ImageRepositoryInterface;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Product\Domain\Service\ThumbnailServiceInterface;
use App\Shared\Application\Command\Sync\CommandHandlerInterface;
use App\Shared\Application\Service\IdGeneratorInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[AsMessageHandler()]
class AddImagesToProductCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ImageRepositoryInterface $imageRepository,
        private IdGeneratorInterface $idGenerator,
        private ThumbnailServiceInterface $thumbnailService       
    ) {
    }
    
    public function __invoke(AddImagesToProductCommand $command)
    {   
        
        $product = $this->productRepository->get(new ProductId($command->getProductId()));
     
        foreach ($command->getImages() as $picture) {
            /**
             * @var UploadedFile $file
             */ 
            $file = $picture['file'];
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $result = $file->move('/var/www/symfony_docker/public/uploads/images/'.$command->getProductId(), $filename);
            

            $urls = $this->thumbnailService->generateThumbs($result, $filename, $command->getProductId());
    
            $image = Image::create(
                new ImageId($this->idGenerator->generate()->toString()),
                $picture['main'],
                $result->getFilename(),
                $filename,
                $result->getMimeType(),
                $urls           
            );
       
            $product->addImage($image);
    
        }
    
        $this->productRepository->save($product);
    }
}

