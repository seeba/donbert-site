<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync\CreateVariant;

use App\Product\Domain\Model\ProductId;
use App\Product\Domain\Model\Variant;
use App\Product\Domain\Model\VariantId;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Command\Sync\CommandHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
class CreateVariantCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    )
    {
    }
    
    public function __invoke(CreateVariantCommand $command)
    {
        
        $product = $this->productRepository->get(new ProductId($command->productId));
       
        $variant = Variant::create(
            new VariantId($command->id),
            $command->name
        );

        $product->addVariant($variant);
       
        $this->productRepository->save($product);
    }
}

