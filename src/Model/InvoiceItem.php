<?php

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\InvoiceItemInterface;

class InvoiceItem extends Base implements InvoiceItemInterface
{
    /** @var  string */
    private $productKey;
    /** @var  string */
    private $notes;
    /** @var  double */
    private $cost;
    /** @var  int */
    private $qty;
    /** @var  string */
    private $taxName1;
    /** @var  double */
    private $taxRate1;
    /** @var  string */
    private $taxName2;
    /** @var  double */
    private $taxRate2;

    /**
     * @return string
     */
    public function getProductKey()
    {
        return $this->productKey;
    }

    /**
     * @param string $productKey
     */
    public function setProductKey($productKey)
    {
        $this->productKey = $productKey;
    }

    /**
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    /**
     * @return int
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * @param int $qty
     */
    public function setQty($qty)
    {
        $this->qty = $qty;
    }

    /**
     * @return string
     */
    public function getTaxName1()
    {
        return $this->taxName1;
    }

    /**
     * @param string $taxName1
     */
    public function setTaxName1($taxName1)
    {
        $this->taxName1 = $taxName1;
    }

    /**
     * @return float
     */
    public function getTaxRate1()
    {
        return $this->taxRate1;
    }

    /**
     * @param float $taxRate1
     */
    public function setTaxRate1($taxRate1)
    {
        $this->taxRate1 = $taxRate1;
    }

    /**
     * @return string
     */
    public function getTaxName2()
    {
        return $this->taxName2;
    }

    /**
     * @param string $taxName2
     */
    public function setTaxName2($taxName2)
    {
        $this->taxName2 = $taxName2;
    }

    /**
     * @return float
     */
    public function getTaxRate2()
    {
        return $this->taxRate2;
    }

    /**
     * @param float $taxRate2
     */
    public function setTaxRate2($taxRate2)
    {
        $this->taxRate2 = $taxRate2;
    }
}
