<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync\CreateAttribute;

use App\Product\Application\Command\Sync\CreateAttribute\DTO\CreateAttributeDTO;
use App\Product\Application\Factory\AttributeFactory;
use App\Product\Domain\Model\Attribute\AttributeId;
use App\Product\Domain\Model\Attribute\ColorAttribute;
use App\Product\Domain\Model\Attribute\SizeAttribute;
use App\Product\Domain\Repository\AttributeRepositoryInterface;
use App\Product\Domain\ValueObject\AttributeType;
use App\Shared\Application\Command\Sync\CommandHandlerInterface;
use Attribute;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
class CreateAttributeHandler implements CommandHandlerInterface
{
    public function __construct(
        private AttributeRepositoryInterface $attributeRepository,
        private AttributeFactory $attributeFactory
    ) { 
    }

    public function __invoke(CreateAttributeCommand $command)
    {
        $createAttributeDTO = $command->createAttributeDTO;

        $attribute = $this->attributeFactory->produce($createAttributeDTO, $command->id);

        $this->attributeRepository->save($attribute);
        
    }

    
}

