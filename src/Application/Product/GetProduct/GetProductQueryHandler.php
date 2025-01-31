<?php

declare(strict_types=1);

namespace App\Application\Product\GetProduct;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetProductQueryHandler
{
    private Connection $connection;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->connection = $entityManager->getConnection();
    }

    public function __invoke(GetProductQuery $query): ?ProductDTO
    {
        $sql = '
            SELECT id, name, description, sku, price_amount, price_currency
            FROM products p
            WHERE p.id = :id
        ';

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $query->productId);

        /** @var array{
         *     id: string,
         *     name: string,
         *     description: string,
         *     sku: string,
         *     price_amount: int,
         *     price_currency: string
         * }|false $result
         */
        $result = $statement
            ->executeQuery()
            ->fetchAssociative();

        if (false === $result) {
            return null;
        }

        return new ProductDTO(
            $result['id'],
            $result['name'],
            $result['description'],
            $result['sku'],
            new PriceDTO($result['price_amount'], $result['price_currency']),
        );
    }
}
