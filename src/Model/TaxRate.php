<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\TaxRateInterface;

/**
 * Class TaxRate
 * @codeCoverageIgnore
 */
final class TaxRate extends Base implements TaxRateInterface
{
    /** @var  string */
    private $name = '';
    /** @var  float */
    private $rate = '';
    /** @var  float */
    private $isInclusive = false;

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getRate() : float
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate(float $rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return float
     */
    public function getisInclusive() : float
    {
        return $this->isInclusive;
    }

    /**
     * @param float $isInclusive
     */
    public function setIsInclusive(float $isInclusive)
    {
        $this->isInclusive = $isInclusive;
    }
}
