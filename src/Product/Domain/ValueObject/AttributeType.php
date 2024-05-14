<?php

declare(strict_types=1);

namespace App\Product\Domain\ValueObject;

enum AttributeType: string 
{
    case SIZE = 'size';
    case COLOR = 'color';
    case THICKNESS = 'thickness';
    case QUANTITY_PER_ROLL = 'quantity_per_roll';
}