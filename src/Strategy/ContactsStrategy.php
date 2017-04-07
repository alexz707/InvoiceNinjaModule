<?php

namespace InvoiceNinjaModule\Strategy;

use InvoiceNinjaModule\Model\Contact;
use InvoiceNinjaModule\Model\Interfaces\ContactInterface;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\Exception\BadMethodCallException;
use Zend\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Zend\Hydrator\Strategy\StrategyInterface;

/**
 * Class ContactsStrategy
 *
 * @package InvoiceNinjaModule\Strategy
 */
class ContactsStrategy implements StrategyInterface
{
    /** @var ClassMethods  */
    private $hydrator;

    /**
     * ContactsStrategy constructor.
     */
    public function __construct()
    {
        $strategy = new UnderscoreNamingStrategy();
        $this->hydrator = new ClassMethods();
        $this->hydrator->setNamingStrategy($strategy);
    }

    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param ContactInterface[]  $value  The original value.
     *
     * @return array Returns the value that should be extracted.
     * @throws BadMethodCallException for a non-object $contactObj
     */
    public function extract($value)
    {
        $result = [];
        /** @var ContactInterface $contactObj */
        foreach ($value as $contactObj) {
            $result[] = $this->hydrator->extract($contactObj);
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
    public function hydrate($value)
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