<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Strategy;

use InvoiceNinjaModule\Model\Interfaces\ContactInterface;
use InvoiceNinjaModule\Model\Interfaces\InvoiceItemInterface;
use InvoiceNinjaModule\Model\InvoiceItem;
use Laminas\Hydrator\Exception\BadMethodCallException;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\StrategyInterface;
use function is_array;

/**
 * Class InvoiceItemsStrategy
 */
final class InvoiceItemsStrategy implements StrategyInterface
{
    private HydratorInterface $hydrator;

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
     * @param InvoiceItemInterface[]  $value  The original value.
     *
     * @return array Returns the value that should be extracted.
     * @throws BadMethodCallException for a non-object $contactObj
     */
    public function extract($value, ?object $object = null): array
    {
        $result = [];
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
    public function hydrate($value, ?array $data) :array
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
