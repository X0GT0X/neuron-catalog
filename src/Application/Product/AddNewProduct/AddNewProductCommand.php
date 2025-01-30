<?php

declare(strict_types=1);

namespace App\Application\Product\AddNewProduct;

use App\Application\Contract\AbstractCommand;

final readonly class AddNewProductCommand extends AbstractCommand
{
    public function __construct(
        public string $name,
        public string $description,
        public string $sku,
        public int $priceAmount,
        public string $priceCurrency,
    ) {
        parent::__construct();
    }
}
