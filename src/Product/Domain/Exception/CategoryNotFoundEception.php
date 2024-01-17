<?php

declare(strict_types=1);

namespace App\Product\Domain\Exception;

use App\Shared\Domain\Exception\NotFoundException;

final class CategoryNotFoundException extends NotFoundException
{
}
