<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\ContactInterface;

/**
 * Class Contact
 * @codeCoverageIgnore
 */
final class Contact extends Base implements ContactInterface
{
    private string $firstName = '';
    private string $lastName = '';
    private string $email = '';
    private bool $isPrimary = false;
    private bool $isLocked = false;
    private string $phone  = '';
    private string $customValue1  = '';
    private string $customValue2  = '';
    private string $customValue3  = '';
    private string $customValue4  = '';
    private string $contactKey  = '';
    private bool $sendEmail = false;
    private int $lastLogin;

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
    public function getLastLogin() :int
    {
        return $this->lastLogin;
    }

    /**
     * @return bool
     */
    public function isLocked() : bool
    {
        return $this->isLocked;
    }

    /**
     * @param bool $isLocked
     */
    public function setIsLocked(bool $isLocked) : void
    {
        $this->isLocked = $isLocked;
    }

    /**
     * @return string
     */
    public function getCustomValue1() : string
    {
        return $this->customValue1;
    }

    /**
     * @param string $customValue1
     */
    public function setCustomValue1(string $customValue1) : void
    {
        $this->customValue1 = $customValue1;
    }

    /**
     * @return string
     */
    public function getCustomValue2() : string
    {
        return $this->customValue2;
    }

    /**
     * @param string $customValue2
     */
    public function setCustomValue2(string $customValue2) : void
    {
        $this->customValue2 = $customValue2;
    }

    /**
     * @return string
     */
    public function getCustomValue3() : string
    {
        return $this->customValue3;
    }

    /**
     * @param string $customValue3
     */
    public function setCustomValue3(string $customValue3) : void
    {
        $this->customValue3 = $customValue3;
    }

    /**
     * @return string
     */
    public function getCustomValue4() : string
    {
        return $this->customValue4;
    }

    /**
     * @param string $customValue4
     */
    public function setCustomValue4(string $customValue4) : void
    {
        $this->customValue4 = $customValue4;
    }

    /**
     * @return string
     */
    public function getContactKey() : string
    {
        return $this->contactKey;
    }

    /**
     * @param string $contactKey
     */
    public function setContactKey(string $contactKey) : void
    {
        $this->contactKey = $contactKey;
    }

    /**
     * @return bool
     */
    public function isSendEmail() : bool
    {
        return $this->sendEmail;
    }

    /**
     * @param bool $sendEmail
     */
    public function setSendEmail(bool $sendEmail) : void
    {
        $this->sendEmail = $sendEmail;
    }
}
