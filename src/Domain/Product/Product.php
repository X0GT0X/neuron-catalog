<?php

namespace App\Domain\Product;

use App\Domain\Money\Money;
use App\Domain\Product\Event\NewProductAddedDomainEvent;
use App\Domain\Product\Event\ProductPriceChangedDomainEvent;
use Neuron\BuildingBlocks\Domain\AggregateRootInterface;
use Neuron\BuildingBlocks\Domain\Entity;
use Symfony\Component\Uid\Uuid;

final class Product extends Entity implements AggregateRootInterface
{
    public private(set) ProductId $id;

    private string $name;

    private string $description;

    private string $sku;

    private Money $price;

    private \DateTimeImmutable $createdAt;

    private ?\DateTimeImmutable $updatedAt = null;

    public static function addNew(string $name, string $description, string $sku, Money $price): self
    {
        return new self(
            new ProductId((string) Uuid::v4()),
            $name,
            $description,
            $sku,
            $price,
            new \DateTimeImmutable(),
        );
    }

    public function changePrice(Money $price): void
    {
        $oldPrice = $this->price;

        $this->price = $price;
        $this->updatedAt = new \DateTimeImmutable();

        $this->addDomainEvent(new ProductPriceChangedDomainEvent($this->id, $this->sku, oldPrice: $oldPrice, newPrice: $price));
    }

    private function __construct(ProductId $id, string $name, string $description, string $sku, Money $price, \DateTimeImmutable $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->sku = $sku;
        $this->price = $price;
        $this->createdAt = $createdAt;

        $this->addDomainEvent(new NewProductAddedDomainEvent($this->id, $this->name, $this->sku));
    }
}
