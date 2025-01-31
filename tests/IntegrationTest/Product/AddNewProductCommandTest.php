<?php

declare(strict_types=1);

namespace App\Tests\IntegrationTest\Product;

use App\Application\Product\AddNewProduct\AddNewProductCommand;
use App\Application\Product\GetProduct\GetProductQuery;
use App\Application\Product\GetProduct\ProductDTO;
use App\Tests\IntegrationTest\IntegrationTestCase;
use Symfony\Component\Uid\Uuid;

class AddNewProductCommandTest extends IntegrationTestCase
{
    public function testThatAddsNewProduct(): void
    {
        /** @var Uuid $productId */
        $productId = $this->catalogModule->executeCommand(new AddNewProductCommand(
            'Table',
            'Simple wood table',
            'WOO/TAB',
            2000,
            'USD',
        ));

        /** @var ProductDTO $product */
        $product = $this->catalogModule->executeQuery(new GetProductQuery($productId));

        $this->assertEquals($productId, $product->id);
        $this->assertEquals('Table', $product->name);
        $this->assertEquals('Simple wood table', $product->description);
        $this->assertEquals(2000, $product->price->amount);
        $this->assertEquals('USD', $product->price->currency);
    }
}
