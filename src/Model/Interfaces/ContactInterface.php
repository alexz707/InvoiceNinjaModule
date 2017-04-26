<?php

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface ContactInterface
 *
 * @package InvoiceNinjaModule\Model\Interfaces
 */
interface ContactInterface extends BaseInterface
{
    /**
     * @return string
     */
    public function getFirstName() :string;

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName) :void;

    /**
     * @return string
     */
    public function getLastName() :string;
    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName) :void;

    /**
     * @return string
     */
    public function getEmail() :string;
    /**
     * @param string $email
     */
    public function setEmail(string $email) :void;

    /**
     * @return bool
     */
    public function isPrimary() :bool;

    /**
     * @param bool $isPrimary
     */
    public function setPrimary(bool $isPrimary) :void;

    /**
     * @return string
     */
    public function getPhone() :string;

    /**
     * @param string $phone
     */
    public function setPhone(string $phone) :void;
    /**
     * @return int
     */
    public function getLastLogin() :?int;

    /**
     * @return bool
     */
    public function isSendInvoice() :bool;

    /**
     * @param bool $sendInvoice
     */
    public function setSendInvoice(bool $sendInvoice) :void;
}
