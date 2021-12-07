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
    public function setNotes(string $notes) : void;

    /**
     * @return float|int
     */
    public function getCost() : float|int;

    /**
     * @param float|int $cost
     */
    public function setCost(float|int $cost) : void;

    /**
     * @return float|int
     */
    public function getPrice() : float|int;

    /**
     * @param float|int $price
     */
    public function setPrice(float|int $price) : void;

    /**
     * @return float|int
     */
    public function getQuantity() : float|int;

    /**
     * @param float|int $quantity
     */
    public function setQuantity(float|int $quantity) : void;

    /**
     * @return string
     */
    public function getTaxName1() : string;

    /**
     * @param string $taxName1
     */
    public function setTaxName1(string $taxName1) : void;

    /**
     * @return float|int
     */
    public function getTaxRate1() : float|int;

    /**
     * @param float|int $taxRate1
     */
    public function setTaxRate1(float|int $taxRate1) : void;

    /**
     * @return string
     */
    public function getTaxName2() : string;

    /**
     * @param string $taxName2
     */
    public function setTaxName2(string $taxName2) : void;

    /**
     * @return float|int
     */
    public function getTaxRate2() : float|int;

    /**
     * @param float|int $taxRate2
     */
    public function setTaxRate2(float|int $taxRate2) : void;

    /**
     * @return string
     */
    public function getTaxName3() : string;

    /**
     * @param string $taxName3
     */
    public function setTaxName3(string $taxName3) : void;

    /**
     * @return float|int
     */
    public function getTaxRate3() : float|int;

    /**
     * @param float|int $taxRate3
     */
    public function setTaxRate3(float|int $taxRate3) : void;

    /**
     * @return string
     */
    public function getCustomValue1() : string;

    /**
     * @param string $customValue1
     */
    public function setCustomValue1(string $customValue1) : void;

    /**
     * @return string
     */
    public function getCustomValue2() : string;

    /**
     * @param string $customValue2
     */
    public function setCustomValue2(string $customValue2) : void;

    /**
     * @return string
     */
    public function getCustomValue3() : string;

    /**
     * @param string $customValue3
     */
    public function setCustomValue3(string $customValue3) : void;

    /**
     * @return string
     */
    public function getCustomValue4() : string;

    /**
     * @param string $customValue4
     */
    public function setCustomValue4(string $customValue4) : void;
}
