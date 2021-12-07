<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Strategy;

use InvoiceNinjaModule\Model\Contact;
use InvoiceNinjaModule\Model\Interfaces\ContactInterface;
use Laminas\Hydrator\Exception\BadMethodCallException;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\Strategy\StrategyInterface;
use function is_array;

/**
 * Class ContactsStrategy
 */
final class ContactsStrategy implements StrategyInterface
{
    private HydratorInterface $hydrator;

    /**
     * ContactsStrategy constructor.
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
    public function extract($value, ?object $object = null) : array
    {
        $result = [];
        foreach ($value as $contactObj) {
            if ($contactObj instanceof ContactInterface) {
                $result[] = $this->hydrator->extract($contactObj);
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
    public function hydrate($value, ?array $data) : array
    {
        $result = [];
        if (is_array($value)) {
            foreach ($value as $contact) {
                $contactObj = new Contact();
                $this->hydrator->hydrate($contact, $contactObj);
                $result[] = $contactObj;
            }
        }
        return $result;
    }
}
