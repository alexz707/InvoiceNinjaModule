<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\ProductInterface;

/**
 * Class Product
 * @codeCoverageIgnore
 */
final class Product extends Base implements ProductInterface
{
    private string $productKey = '';
    private string $notes = '';
    private float $cost = 0;
    private float $price = 0;
    private float $quantity = 0;
    private string $taxName1 = '';
    private float $taxRate1 = 0;
    private string $taxName2 = '';
    private float $taxRate2 = 0;
    private string $taxName3 = '';
    private float $taxRate3 = 0;
    private string $customValue1 = '';
    private string $customValue2 = '';
    private string $customValue3 = '';
    private string $customValue4 = '';

    /**
     * @return string
     */
    public function getProductKey() : string
    {
        return $this->productKey;
    }

    /**
     * @param string $productKey
     */
    public function setProductKey(string $productKey) : void
    {
        $this->productKey = $productKey;
    }

    /**
     * @return string
     */
    public function getNotes() : string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes(string $notes) : void
    {
        $this->notes = $notes;
    }

    /**
     * @return float|int
     */
    public function getCost() : float|int
    {
        return $this->cost;
    }

    /**
     * @param float|int $cost
     */
    public function setCost(float|int $cost) : void
    {
        $this->cost = $cost;
    }

    /**
     * @return float|int
     */
    public function getPrice() : float|int
    {
        return $this->price;
    }

    /**
     * @param float|int $price
     */
    public function setPrice(float|int $price) : void
    {
        $this->price = $price;
    }

    /**
     * @return float|int
     */
    public function getQuantity() : float|int
    {
        return $this->quantity;
    }

    /**
     * @param float|int $quantity
     */
    public function setQuantity(float|int $quantity) : void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getTaxName1() : string
    {
        return $this->taxName1;
    }

    /**
     * @param string $taxName1
     */
    public function setTaxName1(string $taxName1) : void
    {
        $this->taxName1 = $taxName1;
    }

    /**
     * @return float|int
     */
    public function getTaxRate1() : float|int
    {
        return $this->taxRate1;
    }

    /**
     * @param float|int $taxRate1
     */
    public function setTaxRate1(float|int $taxRate1) : void
    {
        $this->taxRate1 = $taxRate1;
    }

    /**
     * @return string
     */
    public function getTaxName2() : string
    {
        return $this->taxName2;
    }

    /**
     * @param string $taxName2
     */
    public function setTaxName2(string $taxName2) : void
    {
        $this->taxName2 = $taxName2;
    }

    /**
     * @return float|int
     */
    public function getTaxRate2() : float|int
    {
        return $this->taxRate2;
    }

    /**
     * @param float|int $taxRate2
     */
    public function setTaxRate2(float|int $taxRate2) : void
    {
        $this->taxRate2 = $taxRate2;
    }

    /**
     * @return string
     */
    public function getTaxName3() : string
    {
        return $this->taxName3;
    }

    /**
     * @param string $taxName3
     */
    public function setTaxName3(string $taxName3) : void
    {
        $this->taxName3 = $taxName3;
    }

    /**
     * @return float|int
     */
    public function getTaxRate3() : float|int
    {
        return $this->taxRate3;
    }

    /**
     * @param float|int $taxRate3
     */
    public function setTaxRate3(float|int $taxRate3) : void
    {
        $this->taxRate3 = $taxRate3;
    }

    /**
     * @return string
     */
    public function getCustomValue1() : string
    {
        return $this->customValue1;
    }

    /**
     * @param string $customValue1
     */
    public function setCustomValue1(string $customValue1) : void
    {
        $this->customValue1 = $customValue1;
    }

    /**
     * @return string
     */
    public function getCustomValue2() : string
    {
        return $this->customValue2;
    }

    /**
     * @param string $customValue2
     */
    public function setCustomValue2(string $customValue2) : void
    {
        $this->customValue2 = $customValue2;
    }

    /**
     * @return string
     */
    public function getCustomValue3() : string
    {
        return $this->customValue3;
    }

    /**
     * @param string $customValue3
     */
    public function setCustomValue3(string $customValue3) : void
    {
        $this->customValue3 = $customValue3;
    }

    /**
     * @return string
     */
    public function getCustomValue4() : string
    {
        return $this->customValue4;
    }

    /**
     * @param string $customValue4
     */
    public function setCustomValue4(string $customValue4) : void
    {
        $this->customValue4 = $customValue4;
    }
}
