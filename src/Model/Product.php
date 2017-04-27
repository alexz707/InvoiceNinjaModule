<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

/**
 * Class Product
 * @codeCoverageIgnore
 */
class Product extends Base
{
    /** @var  string */
    private $productKey = '';
    /** @var  string */
    private $notes = '';
    /** @var  float */
    private $cost = 0;
    /** @var  float */
    private $qty;
    /** @var  int */
    private $defaultTaxRateId = 0;

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
        return $this->cost;
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
     * @return int
     */
    public function getDefaultTaxRateId() : int
    {
        return $this->defaultTaxRateId;
    }

    /**
     * @param int $defaultTaxRateId
     */
    public function setDefaultTaxRateId(int $defaultTaxRateId) :void
    {
        $this->defaultTaxRateId = $defaultTaxRateId;
    }
}
