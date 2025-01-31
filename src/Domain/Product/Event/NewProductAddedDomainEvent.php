<?php

declare(strict_types=1);

namespace App\Domain\Product\Event;

use App\Domain\Product\ProductId;
use Neuron\BuildingBlocks\Domain\DomainEventBase;
use Neuron\BuildingBlocks\Domain\DomainEventInterface;
use Symfony\Component\Uid\Uuid;

final class NewProductAddedDomainEvent extends DomainEventBase
{
    public function __construct(
        public readonly ProductId $productId,
        public readonly string $productName,
        public readonly string $productSku,
        ?Uuid $id = null,
        ?\DateTimeImmutable $occurredOn = null
    ) {
        parent::__construct($id, $occurredOn);
    }

    /**
     * @param array{
     *     productId: array{value: string},
     *     productName: string,
     *     productSku: string
     * } $data
     */
    public static function from(Uuid $id, \DateTimeImmutable $occurredOn, array $data): DomainEventInterface
    {
        return new self(
            new ProductId($data['productId']['value']),
            $data['productName'],
            $data['productSku'],
            $id,
            $occurredOn,
        );
    }
}
