<?php

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\ClientInterface;
use InvoiceNinjaModule\Model\Interfaces\ContactInterface;

class Client implements ClientInterface
{
    /** @var  int */
    private $id;
    /** @var  string */
    private $name;
    /** @var  float */
    private $balance;
    /** @var float */
    private $paidToDate;
    /** @var  int */
    private $userId;
    /** @var  string */
    private $accountKey;
    /** @var  \DateTime */
    private $updatedAt;
    /** @var  \DateTime */
    private $archivedAt;
    /** @var  string */
    private $address1;
    /** @var  string */
    private $address2;
    /** @var  string */
    private $city;
    /** @var  string */
    private $state;
    /** @var  string */
    private $postalCode;
    /** @var  int */
    private $countryId;
    /** @var  string */
    private $workPhone;
    /** @var  string */
    private $privateNotes;
    /** @var  \DateTime */
    private $lastLogin;
    /** @var  string */
    private $website;
    /** @var  int */
    private $industryId;
    /** @var  int */
    private $sizeId;
    /** @var  bool */
    private $isDeleted;
    /** @var int  */
    private $paymentTerms;
    /** @var  string */
    private $customValue1;
    /** @var  string */
    private $customValue2;
    /** @var  string */
    private $vatNumber;
    /** @var  string */
    private $idNumber;
    /** @var  int */
    private $languageId;
    /** @var  int */
    private $currencyId;
    /** @var ContactInterface[]  */
    private $contacts;

    public function __construct()
    {
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
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return float
     */
    public function getPaidToDate()
    {
        return $this->paidToDate;
    }

    /**
     * @param float $paidToDate
     */
    public function setPaidToDate($paidToDate)
    {
        $this->paidToDate = $paidToDate;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getAccountKey()
    {
        return $this->accountKey;
    }

    /**
     * @param string $accountKey
     */
    public function setAccountKey($accountKey)
    {
        $this->accountKey = $accountKey;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \DateTime
     */
    public function getArchivedAt()
    {
        return $this->archivedAt;
    }

    /**
     * @param \DateTime $archivedAt
     */
    public function setArchivedAt($archivedAt)
    {
        $this->archivedAt = $archivedAt;
    }

    /**
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return int
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;
    }

    /**
     * @return string
     */
    public function getWorkPhone()
    {
        return $this->workPhone;
    }

    /**
     * @param string $workPhone
     */
    public function setWorkPhone($workPhone)
    {
        $this->workPhone = $workPhone;
    }

    /**
     * @return string
     */
    public function getPrivateNotes()
    {
        return $this->privateNotes;
    }

    /**
     * @param string $privateNotes
     */
    public function setPrivateNotes($privateNotes)
    {
        $this->privateNotes = $privateNotes;
    }

    /**
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @param \DateTime $lastLogin
     */
    public function setLastLogin($lastLogin)
    {
        $this->lastLogin = $lastLogin;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return int
     */
    public function getIndustryId()
    {
        return $this->industryId;
    }

    /**
     * @param int $industryId
     */
    public function setIndustryId($industryId)
    {
        $this->industryId = $industryId;
    }

    /**
     * @return int
     */
    public function getSizeId()
    {
        return $this->sizeId;
    }

    /**
     * @param int $sizeId
     */
    public function setSizeId($sizeId)
    {
        $this->sizeId = $sizeId;
    }

    /**
     * @return bool
     */
    public function isIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    }

    /**
     * @return int
     */
    public function getPaymentTerms()
    {
        return $this->paymentTerms;
    }

    /**
     * @param int $paymentTerms
     */
    public function setPaymentTerms($paymentTerms)
    {
        $this->paymentTerms = $paymentTerms;
    }

    /**
     * @return string
     */
    public function getCustomValue1()
    {
        return $this->customValue1;
    }

    /**
     * @param string $customValue1
     */
    public function setCustomValue1($customValue1)
    {
        $this->customValue1 = $customValue1;
    }

    /**
     * @return string
     */
    public function getCustomValue2()
    {
        return $this->customValue2;
    }

    /**
     * @param string $customValue2
     */
    public function setCustomValue2($customValue2)
    {
        $this->customValue2 = $customValue2;
    }

    /**
     * @return string
     */
    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    /**
     * @param string $vatNumber
     */
    public function setVatNumber($vatNumber)
    {
        $this->vatNumber = $vatNumber;
    }

    /**
     * @return string
     */
    public function getIdNumber()
    {
        return $this->idNumber;
    }

    /**
     * @param string $idNumber
     */
    public function setIdNumber($idNumber)
    {
        $this->idNumber = $idNumber;
    }

    /**
     * @return int
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;
    }

    /**
     * @return ContactInterface[]
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param ContactInterface[] $contacts
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    /**
     * @param int $currencyId
     */
    public function setCurrencyId($currencyId)
    {
        $this->currencyId = $currencyId;
    }
}
