<?php

declare(strict_types=1);

namespace App\Product\Application\Command\Sync;

use App\Shared\Application\Command\Sync\CommandHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
class AddImagesToVariantCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        
    )
    {
    }
    
    public function __invoke(AddImagesToVariantCommand $command)
    {   
       
    }
}

