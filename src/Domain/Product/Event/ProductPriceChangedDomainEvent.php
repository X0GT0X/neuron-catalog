<?php

declare(strict_types=1);

namespace App\Domain\Product\Event;

use App\Domain\Money\Currency;
use App\Domain\Money\Money;
use App\Domain\Product\ProductId;
use Neuron\BuildingBlocks\Domain\DomainEventBase;
use Neuron\BuildingBlocks\Domain\DomainEventInterface;
use Symfony\Component\Uid\Uuid;

final class ProductPriceChangedDomainEvent extends DomainEventBase
{
    public function __construct(
        public readonly ProductId $productId,
        public readonly string $sku,
        public readonly Money $oldPrice,
        public readonly Money $newPrice,
        ?Uuid $id = null,
        ?\DateTimeImmutable $occurredOn = null
    ) {
        parent::__construct($id, $occurredOn);
    }

    /**
     * @param array{
     *     productId: array{value: string},
     *     name: string,
     *     sku: string,
     *     oldPrice: array{amount: int, currency: array{value: string}},
     *     newPrice: array{amount: int, currency: array{value: string}}
     * } $data
     */
    public static function from(Uuid $id, \DateTimeImmutable $occurredOn, array $data): DomainEventInterface
    {
        return new self(
            new ProductId($data['productId']['value']),
            $data['sku'],
            Money::from($data['oldPrice']['amount'], Currency::from($data['oldPrice']['currency']['value'])),
            Money::from($data['newPrice']['amount'], Currency::from($data['newPrice']['currency']['value'])),
            $id,
            $occurredOn,
        );
    }
}
