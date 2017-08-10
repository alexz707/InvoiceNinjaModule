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
    /** @var  string */
    private $productKey = '';
    /** @var  string */
    private $notes = '';
    /** @var  float */
    private $cost = 0;
    /** @var  float */
    private $qty;
    /** @var  string */
    private $taxName1;
    /** @var  string */
    private $taxName2;
    /** @var  float */
    private $taxRate1;
    /** @var  float */
    private $taxRate2;

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
    public function setProductKey(string $productKey) :void
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
    public function setNotes(string $notes) :void
    {
        $this->notes = $notes;
    }

    /**
     * @return float
     */
    public function getCost() : float
    {
        return (float)$this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost) :void
    {
        $this->cost = $cost;
    }

    /**
     * @return float
     */
    public function getQty() : float
    {
        return $this->qty;
    }

    /**
     * @param float $qty
     */
    public function setQty(float $qty) :void
    {
        $this->qty = $qty;
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
    public function setTaxName1(string $taxName1) :void
    {
        $this->taxName1 = $taxName1;
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
    public function setTaxName2(string $taxName2) :void
    {
        $this->taxName2 = $taxName2;
    }

    /**
     * @return float
     */
    public function getTaxRate1() : float
    {
        return $this->taxRate1;
    }

    /**
     * @param float $taxRate1
     */
    public function setTaxRate1(float $taxRate1) :void
    {
        $this->taxRate1 = $taxRate1;
    }

    /**
     * @return float
     */
    public function getTaxRate2() : float
    {
        return $this->taxRate2;
    }

    /**
     * @param float $taxRate2
     */
    public function setTaxRate2(float $taxRate2) :void
    {
        $this->taxRate2 = $taxRate2;
    }
}
