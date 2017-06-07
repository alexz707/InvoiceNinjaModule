<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface TaxRateInterface
 */
interface TaxRateInterface extends BaseInterface
{
    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @param string $name
     */
    public function setName(string $name);

    /**
     * @return float
     */
    public function getRate() : float;

    /**
     * @param float $rate
     */
    public function setRate(float $rate);

    /**
     * @return float
     */
    public function getisInclusive() : float;

    /**
     * @param float $isInclusive
     */
    public function setIsInclusive(float $isInclusive);
}
