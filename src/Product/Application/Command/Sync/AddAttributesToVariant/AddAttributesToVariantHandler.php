<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync\AddAttributesToVariant;

use App\Product\Domain\Model\Attribute\AttributeId;
use App\Product\Domain\Model\VariantId;
use App\Product\Domain\Repository\AttributeRepositoryInterface;
use App\Product\Domain\Repository\VariantRepositoryInterface;
use App\Shared\Application\Command\Sync\CommandHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
class AddAttributesToVariantHandler implements CommandHandlerInterface
{
    public function __construct(
        private VariantRepositoryInterface $variantRepository,
        private AttributeRepositoryInterface $attributeRepository
    ) { 
    }

    public function __invoke(AddAttributesToVariantCommand $command)
    {
        $variant = $this->variantRepository->get(new VariantId($command->variantId));
        
        foreach ($command->attributes as $attr) {

            foreach ($attr as $attributeId) {
                if (!empty($attributeId)){ 
                    $attribute = $this->attributeRepository->get(new AttributeId($attributeId));
                } 
                $variant->addAttribute($attribute);
            }  
        }

        $this->variantRepository->save($variant);        
    }  
}

