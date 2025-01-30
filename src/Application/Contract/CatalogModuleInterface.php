<?php

declare(strict_types=1);

namespace App\Application\Contract;

interface CatalogModuleInterface
{
    public function executeQuery(QueryInterface $query): mixed;

    public function executeCommand(CommandInterface $command): mixed;
}
