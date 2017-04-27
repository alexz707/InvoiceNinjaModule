<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Strategy;

use InvoiceNinjaModule\Model\Interfaces\ContactInterface;
use InvoiceNinjaModule\Model\Interfaces\InvoiceItemInterface;
use InvoiceNinjaModule\Model\InvoiceItem;
use Zend\Hydrator\Exception\BadMethodCallException;
use Zend\Hydrator\HydratorInterface;
use Zend\Hydrator\Strategy\StrategyInterface;

/**
 * Class InvoiceItemsStrategy
 */
class InvoiceItemsStrategy implements StrategyInterface
{
    /** @var HydratorInterface  */
    private $hydrator;

    /**
     * InvoiceItemsStrategy constructor.
     *
     * @param HydratorInterface $hydrator
     */
    public function __construct(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param ContactInterface[]  $value  The original value.
     *
     * @return array Returns the value that should be extracted.
     * @throws BadMethodCallException for a non-object $contactObj
     */
    public function extract($value) :array
    {
        $result = [];
        /** @var InvoiceItemInterface $invoiceItem */
        foreach ($value as $invoiceItem) {
            if ($invoiceItem instanceof InvoiceItemInterface) {
                $result[] = $this->hydrator->extract($invoiceItem);
            }
        }
        return $result;
    }

    /**
     * Converts the given value so that it can be hydrated by the hydrator.
     * @param array $value
     *
     * @return ContactInterface[]
     * @throws BadMethodCallException for a non-object $contactObj
     */
    public function hydrate($value) :array
    {
        $result = [];
        if (is_array($value)) {
            foreach ($value as $invoiceItemArr) {
                $invoiceItem = new InvoiceItem();
                $this->hydrator->hydrate($invoiceItemArr, $invoiceItem);
                $result[] = $invoiceItem;
            }
        }
        return $result;
    }
}
