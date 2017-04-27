<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\ContactInterface;

/**
 * Class Contact
 */
class Contact extends Base implements ContactInterface
{
    /** @var  string */
    private $firstName = '';
    /** @var  string */
    private $lastName = '';
    /** @var  string */
    private $email = '';
    /** @var bool */
    private $isPrimary = false;
    /** @var  string */
    private $phone  = '';
    /** @var  int */
    private $lastLogin;
    /** @var  bool */
    private $sendInvoice = false;

    /**
     * @return string
     */
    public function getFirstName() :string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName) :void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName() :string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName) :void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail() :string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email) :void
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isPrimary() :bool
    {
        return $this->isPrimary;
    }

    /**
     * @param bool $isPrimary
     */
    public function setPrimary(bool $isPrimary) :void
    {
        $this->isPrimary = $isPrimary;
    }

    /**
     * @return string
     */
    public function getPhone() :string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone) :void
    {
        $this->phone = $phone;
    }

    /**
     * @return int
     */
    public function getLastLogin() :?int
    {
        return $this->lastLogin;
    }

    /**
     * @return bool
     */
    public function isSendInvoice() :bool
    {
        return $this->sendInvoice;
    }

    /**
     * @param bool $sendInvoice
     */
    public function setSendInvoice(bool $sendInvoice) :void
    {
        $this->sendInvoice = $sendInvoice;
    }
}
