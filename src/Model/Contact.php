<?php

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\ContactInterface;

class Contact implements ContactInterface
{
    /** @var  bool */
    private $is_owner;
    /** @var  int */
    private $id;
    /** @var  string */
    private $first_name;
    /** @var  string */
    private $last_name;
    /** @var  string */
    private $email;
    /** @var  \DateTime */
    private $updated_at;
    /** @var  \DateTime */
    private $archived_at;
    /** @var bool */
    private $is_primary;
    /** @var  string */
    private $phone;
    /** @var  \DateTime */
    private $last_login;
    /** @var  bool */
    private $send_invoice;

    public function __construct()
    {
    }

    /**
     * @return bool
     */
    public function isIsOwner()
    {
        return $this->is_owner;
    }

    /**
     * @param bool $is_owner
     */
    public function setIsOwner($is_owner)
    {
        $this->is_owner = $is_owner;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param \DateTime $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return \DateTime
     */
    public function getArchivedAt()
    {
        return $this->archived_at;
    }

    /**
     * @param \DateTime $archived_at
     */
    public function setArchivedAt($archived_at)
    {
        $this->archived_at = $archived_at;
    }

    /**
     * @return bool
     */
    public function isIsPrimary()
    {
        return $this->is_primary;
    }

    /**
     * @param bool $is_primary
     */
    public function setIsPrimary($is_primary)
    {
        $this->is_primary = $is_primary;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->last_login;
    }

    /**
     * @param \DateTime $last_login
     */
    public function setLastLogin($last_login)
    {
        $this->last_login = $last_login;
    }

    /**
     * @return bool
     */
    public function isSendInvoice()
    {
        return $this->send_invoice;
    }

    /**
     * @param bool $send_invoice
     */
    public function setSendInvoice($send_invoice)
    {
        $this->send_invoice = $send_invoice;
    }
}
