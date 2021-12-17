<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\TaxRateInterface;

/**
 * Class TaxRate
 * @codeCoverageIgnore
 */
final class TaxRate extends Base implements TaxRateInterface
{
    private string $name = '';
    private float $rate = 0;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return float|int
     */
    public function getRate(): float|int
    {
        return $this->rate;
    }

    /**
     * @param float|int $rate
     */
    public function setRate(float|int $rate): void
    {
        $this->rate = $rate;
    }
}
