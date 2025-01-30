<?php

declare(strict_types=1);

namespace App\Application\Product\AddNewProduct;

use App\Application\Configuration\Command\CommandHandlerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Uid\Uuid;

#[AsMessageHandler]
class AddNewProductCommandHandler implements CommandHandlerInterface
{
    public function __invoke(AddNewProductCommand $command): Uuid
    {
        return Uuid::v4();
    }
}
