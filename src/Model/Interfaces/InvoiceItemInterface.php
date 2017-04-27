<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface InvoiceItemInterface
 */
interface InvoiceItemInterface extends BaseInterface
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
    public function setNotes(string $notes) : void;

    /**
     * @return float
     */
    public function getCost() : float;

    /**
     * @param float $cost
     */
    public function setCost(float $cost) : void;

    /**
     * @return int
     */
    public function getQty() : int;

    /**
     * @param int $qty
     */
    public function setQty(int $qty) : void;

    /**
     * @return string
     */
    public function getTaxName1() : string;

    /**
     * @param string $taxName1
     */
    public function setTaxName1(string $taxName1) : void;

    /**
     * @return float
     */
    public function getTaxRate1() : float;

    /**
     * @param float $taxRate1
     */
    public function setTaxRate1(float $taxRate1) : void;

    /**
     * @return string
     */
    public function getTaxName2() : string;

    /**
     * @param string $taxName2
     */
    public function setTaxName2(string $taxName2) : void;

    /**
     * @return float
     */
    public function getTaxRate2() : float;

    /**
     * @param float $taxRate2
     */
    public function setTaxRate2(float $taxRate2) : void;
}
