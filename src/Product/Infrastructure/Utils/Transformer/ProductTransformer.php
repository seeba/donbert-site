<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Transformer;

use App\Product\Domain\Model\Category;
use App\Product\Domain\Model\CategoryId;
use App\Product\Domain\Model\Product;
use App\Product\Domain\Model\ProductId;
use App\Product\Infrastructure\Entity\Product as ProductEntity;
use App\Product\Infrastructure\Repository\CategoryRepository;
use App\Product\Infrastructure\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class ProductTransformer
{
    public function __construct(
        private ProductRepository $productRepository,
        private CategoryRepository $categoryRepository,
    )
    {     
    }

    public function fromDomain(Product $product): ProductEntity
    {
        $productEntity = $this->productRepository->find($product->getId()->toString());
        if ($productEntity === null) {
            $productEntity = new ProductEntity(
                $product->getId()->toString(),
                $product->getName()
            );
        }

        /**
         * @var Category[] $categories
         * @var Category $category
         */
        $categories = $product->getCategories();
        
        $ids = [];
        foreach($categories as $category) {
            $ids[] = $category->getId()->toString();
        }
        /**
         * @var Collection $categoriesEntities
         */
        $categoriesEntities = $this->categoryRepository->findBy(['id' => $ids]);
       
        if ($categoriesEntities != null) {

            $productEntity->addCategories($categoriesEntities);
        
        }
    
        return $productEntity;
    }

    public function toDomain(ProductEntity $productEntity) : Product
    {
        $product =  Product::restore(
            new ProductId($productEntity->getId()),
            $productEntity->getName()
        );

        $categoriesEntities = $productEntity->getCategories();
        
        foreach ($categoriesEntities as $categoryEntity) {
            $product->addCategory(
                new Category(
                    new CategoryId($categoryEntity->getId()),
                    $categoryEntity->getName(),
                    new CategoryId($categoryEntity->getParent()->getId())
                    )
            );
        }

        return $product;
    }
}