<?php

declare(strict_types=1);

namespace App\Application\Product\GetProduct;

use App\Application\Contract\QueryInterface;
use Symfony\Component\Uid\Uuid;

final readonly class GetProductQuery implements QueryInterface
{
    public function __construct(
        public Uuid $productId,
    ) {
    }
}
