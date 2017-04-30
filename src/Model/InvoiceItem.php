<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\InvoiceItemInterface;

/**
 * Class InvoiceItem
 * @codeCoverageIgnore
 */
final class InvoiceItem extends Base implements InvoiceItemInterface
{
    /** @var  string */
    private $productKey = '';
    /** @var  string */
    private $notes = '';
    /** @var  double */
    private $cost = 0;
    /** @var  int */
    private $qty = 0;
    /** @var  string */
    private $taxName1 = '';
    /** @var  double */
    private $taxRate1 = 0;
    /** @var  string */
    private $taxName2 = '';
    /** @var  double */
    private $taxRate2 = 0;

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
     * @return float
     */
    public function getCost() : float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     */
    public function setCost(float $cost) : void
    {
        $this->cost = $cost;
    }

    /**
     * @return int
     */
    public function getQty() : int
    {
        return $this->qty;
    }

    /**
     * @param int $qty
     */
    public function setQty(int $qty) : void
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
    public function setTaxName1(string $taxName1) : void
    {
        $this->taxName1 = $taxName1;
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
    public function setTaxRate1(float $taxRate1) : void
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
     * @return float
     */
    public function getTaxRate2() : float
    {
        return $this->taxRate2;
    }

    /**
     * @param float $taxRate2
     */
    public function setTaxRate2(float $taxRate2) : void
    {
        $this->taxRate2 = $taxRate2;
    }
}
