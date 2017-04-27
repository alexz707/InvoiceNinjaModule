<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface ProductInterface
 */
interface ProductInterface extends BaseInterface
{
    /**
     * @return string
     */
    public function getProductKey() : string;

    /**
     * @param string $productKey
     */
    public function setProductKey(string $productKey) : void;

    /**
     * @return string
     */
    public function getNotes() : string;

    /**
     * @param string $notes
     */
    public function setNotes(string $notes) :void;

    /**
     * @return float
     */
    public function getCost() : float;

    /**
     * @param float $cost
     */
    public function setCost(float $cost) :void;

    /**
     * @return float
     */
    public function getQty() : float;

    /**
     * @param float $qty
     */
    public function setQty(float $qty) :void;

    /**
     * @return int
     */
    public function getDefaultTaxRateId() : int;

    /**
     * @param int $defaultTaxRateId
     */
    public function setDefaultTaxRateId(int $defaultTaxRateId) :void;
}
