<?php

declare(strict_types=1);

namespace App\Tests\UnitTest\Domain\Product;

use App\Domain\Money\Currency;
use App\Domain\Money\Money;
use App\Domain\Product\Event\NewProductAddedDomainEvent;
use App\Domain\Product\Product;
use App\Tests\UnitTest\UnitTestCase;

class ProductTest extends UnitTestCase
{
    public function testThatSuccessfullyCreatesNewProduct(): void
    {
        $product = Product::addNew(
            'Table',
            'Simple wood table.',
            'WOO/TAB',
            Money::from(2000, Currency::USD)
        );

        /** @var NewProductAddedDomainEvent $domainEvent */
        $domainEvent = $this->assertPublishedDomainEvents($product, NewProductAddedDomainEvent::class)[0];

        $this->assertEquals($product->id, $domainEvent->productId);
        $this->assertEquals('Table', $domainEvent->productName);
        $this->assertEquals('WOO/TAB', $domainEvent->productSku);
    }
}
