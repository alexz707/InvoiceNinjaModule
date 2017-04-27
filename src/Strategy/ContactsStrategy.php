<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Strategy;

use InvoiceNinjaModule\Model\Contact;
use InvoiceNinjaModule\Model\Interfaces\ContactInterface;
use Zend\Hydrator\Exception\BadMethodCallException;
use Zend\Hydrator\HydratorInterface;
use Zend\Hydrator\Strategy\StrategyInterface;

/**
 * Class ContactsStrategy
 */
class ContactsStrategy implements StrategyInterface
{
    /** @var HydratorInterface  */
    private $hydrator;

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
    public function extract($value) : array
    {
        $result = [];
        /** @var ContactInterface $contactObj */
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
    public function hydrate($value) : array
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
