<?php

declare(strict_types=1);

namespace App\Domain\Money;

class Money
{
    public readonly int $amount;

    public readonly Currency $currency;

    private function __construct(int $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public static function from(int $amount, Currency $currency): self
    {
        return new self($amount, $currency);
    }
}
