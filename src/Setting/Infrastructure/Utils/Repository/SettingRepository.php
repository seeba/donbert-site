<?php

declare(strict_types=1);

namespace App\Setting\Infrastructure\Utils\Repository;

use App\Setting\Domain\Exception\SettingNotFoundException;
use App\Setting\Domain\Model\Setting;
use App\Setting\Domain\Model\SettingId;
use App\Setting\Domain\Repository\SettingRepositoryInterface;
use App\Setting\Infrastructure\Repository\SettingRepository as DoctrineSettingRepository;
use App\Setting\Infrastructure\Utils\Transformer\SettingTransformer;

final class SettingRepository implements SettingRepositoryInterface
{
    public function __construct(
        private DoctrineSettingRepository $repository,
        private SettingTransformer $transformer
    )
    {
        
    }

    public function save(Setting $setting): void
    {
        $this->repository->save(
            $this->transformer->fromDomain($setting)
        );
    }

    public function get(SettingId $id): Setting
    {
        $entity = $this->repository->find($id->toString());

        return $entity === null 
            ? throw new SettingNotFoundException()
            : $this->transformer->toDomain($entity);
    }

    public function findByName(string $name): Setting
    {
        $entity = $this->repository->findByName($name);
    
        return $entity === null
            ? throw new SettingNotFoundException()
            : $this->transformer->toDomain($entity);
    }
}