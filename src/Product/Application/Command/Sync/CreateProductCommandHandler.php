<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync;

use App\Product\Domain\Model\Product;
use App\Product\Domain\Model\ProductId;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Command\Sync\CommandHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
class CreateProductCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    )
    {
    }
    
    
    public function __invoke(CreateProductCommand $command)
    {
       
        $product = Product::create(
            new ProductId($command->id),
            $command->name,  
        );   
        
        $this->productRepository->save($product);
    }

}

