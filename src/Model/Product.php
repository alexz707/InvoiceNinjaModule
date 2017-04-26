<?php

namespace InvoiceNinjaModule\Model;

class Product extends Base
{
    /** @var  string */
    private $productKey;
    /** @var  string */
    private $notes;
    /** @var  float */
    private $cost;
    /** @var  float */
    private $qty;
    /** @var  int */
    private $defaultTaxRateId;

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
    public function setProductKey(string $productKey)
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
    public function setNotes(string $notes)
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
    public function setCost(float $cost)
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
    public function setQty(float $qty)
    {
        $this->qty = $qty;
    }

    /**
     * @return int
     */
    public function getDefaultTaxRateId() : int
    {
        return $this->defaultTaxRateId;
    }

    /**
     * @param int $defaultTaxRateId
     */
    public function setDefaultTaxRateId(int $defaultTaxRateId)
    {
        $this->defaultTaxRateId = $defaultTaxRateId;
    }
}
