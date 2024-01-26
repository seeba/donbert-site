<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync;

use App\Product\Domain\Model\Category;
use App\Product\Domain\Model\CategoryId;
use App\Product\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Application\Command\Sync\CommandHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
class CreateCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    )
    {
    }
    
    
    public function __invoke(CreateCategoryCommand $command)
    {
       
        $category = Category::create(
            new CategoryId($command->id),
            $command->name, 
            is_null($command->parentId) ? null : new CategoryId($command->parentId)   
        );   
        
        $this->categoryRepository->save($category);
    }

}

