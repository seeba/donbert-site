<?php

declare(strict_types=1);

namespace App\Setting\Application\Query;

interface GetSettingByNameQuery
{
    public function execute(string $name);
}