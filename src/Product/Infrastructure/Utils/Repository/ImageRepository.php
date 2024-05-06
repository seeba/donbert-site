<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\Utils\Repository;

use App\Product\Domain\Exception\ImageNotFoundException;
use App\Product\Domain\Exception\ProductNotFoundException;
use App\Product\Domain\Exception\VariantNotFoundException;
use App\Product\Domain\Model\Image;
use App\Product\Domain\Model\ImageId;
use App\Product\Domain\Model\VariantId;
use App\Product\Domain\Model\Variant;
use App\Product\Domain\Repository\ImageRepositoryInterface as ImageDomainRepositoryInterface;
use App\Product\Infrastructure\Repository\ImageRepository as DoctrineImageRepository;
use App\Product\Infrastructure\Utils\Transformer\ImageTransformer;
use Doctrine\Common\Collections\Collection;

final class ImageRepository implements ImageDomainRepositoryInterface
{
    public function __construct(
        private DoctrineImageRepository $repository,
        private ImageTransformer $transformer,
    )
    {    
    }

    public function save(Image $image): void
    {
        $this->repository->save(
            $this->transformer->fromDomain($image)
        );
    }
    
    public function get(ImageId $id): Image
    {
        $entity = $this->repository->find($id->toString());

        return $entity === null ? throw new ImageNotFoundException() : $this->transformer->toDomain($entity);
    }

    public function findAll() : Collection
    {
        /** @var Collection $variants */
        $variants = $this->repository->findAll();

        return $variants;
    }
}