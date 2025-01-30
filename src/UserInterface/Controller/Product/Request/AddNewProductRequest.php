<?php

declare(strict_types=1);

namespace App\UserInterface\Controller\Product\Request;

use Neuron\BuildingBlocks\UserInterface\Request\RequestInterface;
use Symfony\Component\Validator\Constraints as Assert;

class AddNewProductRequest implements RequestInterface
{
    public function __construct(
        #[Assert\NotBlank]
        public string $name,
        #[Assert\NotBlank]
        public string $description,
        #[Assert\NotBlank]
        public string $sku,
        #[Assert\NotBlank]
        public int $priceAmount,
        #[Assert\NotBlank]
        public string $priceCurrency,
    ) {
    }
}
