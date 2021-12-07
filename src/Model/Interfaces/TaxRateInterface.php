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
     * @return float|int
     */
    public function getRate() : float|int;

    /**
     * @param float|int $rate
     */
    public function setRate(float|int $rate) : void;
}
