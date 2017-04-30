<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\ClientInterface;
use InvoiceNinjaModule\Model\Interfaces\ContactInterface;

/**
 * Class Client
 */
final class Client extends Base implements ClientInterface
{
    /** @var  string */
    private $name = '';
    /** @var  float */
    private $balance = 0;
    /** @var float */
    private $paidToDate = 0;
    /** @var  int */
    private $userId = 0;
    /** @var  string */
    private $address1 = '';
    /** @var  string */
    private $address2 = '';
    /** @var  string */
    private $city = '';
    /** @var  string */
    private $state = '';
    /** @var  string */
    private $postalCode = '';
    /** @var  int */
    private $countryId = 0;
    /** @var  string */
    private $workPhone = '';
    /** @var  string */
    private $privateNotes = '';
    /** @var  int */
    private $lastLogin;
    /** @var  string */
    private $website = '';
    /** @var  int */
    private $industryId = 0;
    /** @var  int */
    private $sizeId = 0;
    /** @var int  */
    private $paymentTerms = 0;
    /** @var  string */
    private $customValue1;
    /** @var  string */
    private $customValue2;
    /** @var  string */
    private $vatNumber = '';
    /** @var  string */
    private $idNumber = '';
    /** @var  int */
    private $languageId = 0;
    /** @var  int */
    private $currencyId = 0;
    /** @var ContactInterface[]  */
    private $contacts;

    /**
     * Client constructor.
     */
    public function __construct()
    {
        $this->contacts = [];
    }

    /**
     * @return float
     */
    public function getBalance() :float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance(float $balance) :void
    {
        $this->balance = $balance;
    }

    /**
     * @return float
     */
    public function getPaidToDate() :float
    {
        return $this->paidToDate;
    }

    /**
     * @param float $paidToDate
     */
    public function setPaidToDate(float $paidToDate) :void
    {
        $this->paidToDate = $paidToDate;
    }

    /**
     * @return int
     */
    public function getUserId() :int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId) :void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getAddress1() :string
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     */
    public function setAddress1(string $address1) :void
    {
        $this->address1 = $address1;
    }

    /**
     * @return string
     */
    public function getAddress2() :string
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     */
    public function setAddress2(string $address2) :void
    {
        $this->address2 = $address2;
    }

    /**
     * @return string
     */
    public function getCity() :string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city) :void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getState() :string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state) :void
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getPostalCode() :string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode) :void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return int
     */
    public function getCountryId() :int
    {
        return $this->countryId;
    }

    /**
     * @param int $countryId
     */
    public function setCountryId(int $countryId) :void
    {
        $this->countryId = $countryId;
    }

    /**
     * @return string
     */
    public function getWorkPhone() :string
    {
        return $this->workPhone;
    }

    /**
     * @param string $workPhone
     */
    public function setWorkPhone(string $workPhone) :void
    {
        $this->workPhone = $workPhone;
    }

    /**
     * @return string
     */
    public function getPrivateNotes() :string
    {
        return $this->privateNotes;
    }

    /**
     * @param string $privateNotes
     */
    public function setPrivateNotes(string $privateNotes) :void
    {
        $this->privateNotes = $privateNotes;
    }

    /**
     * @return int
     */
    public function getLastLogin() :?int
    {
        return $this->lastLogin;
    }

    /**
     * @return string
     */
    public function getWebsite() :string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website) :void
    {
        $this->website = $website;
    }

    /**
     * @return int
     */
    public function getIndustryId() :int
    {
        return $this->industryId;
    }

    /**
     * @param int $industryId
     */
    public function setIndustryId(int $industryId) :void
    {
        $this->industryId = $industryId;
    }

    /**
     * @return int
     */
    public function getSizeId() :int
    {
        return $this->sizeId;
    }

    /**
     * @param int $sizeId
     */
    public function setSizeId(int $sizeId) :void
    {
        $this->sizeId = $sizeId;
    }

    /**
     * @return int
     */
    public function getPaymentTerms() :int
    {
        return $this->paymentTerms;
    }

    /**
     * @param int $paymentTerms
     */
    public function setPaymentTerms(int $paymentTerms) :void
    {
        $this->paymentTerms = $paymentTerms;
    }

    /**
     * @return string
     */
    public function getCustomValue1() :?string
    {
        return $this->customValue1;
    }

    /**
     * @param string $customValue1
     */
    public function setCustomValue1(string $customValue1) :void
    {
        $this->customValue1 = $customValue1;
    }

    /**
     * @return string
     */
    public function getCustomValue2() :?string
    {
        return $this->customValue2;
    }

    /**
     * @param string $customValue2
     */
    public function setCustomValue2(string $customValue2) :void
    {
        $this->customValue2 = $customValue2;
    }

    /**
     * @return string
     */
    public function getVatNumber() :string
    {
        return $this->vatNumber;
    }

    /**
     * @param string $vatNumber
     */
    public function setVatNumber(string $vatNumber) :void
    {
        $this->vatNumber = $vatNumber;
    }

    /**
     * @return string
     */
    public function getIdNumber() :string
    {
        return $this->idNumber;
    }

    /**
     * @param string $idNumber
     */
    public function setIdNumber(string $idNumber) :void
    {
        $this->idNumber = $idNumber;
    }

    /**
     * @return int
     */
    public function getLanguageId() :int
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     */
    public function setLanguageId(int $languageId) :void
    {
        $this->languageId = $languageId;
    }

    /**
     * @return ContactInterface[]
     */
    public function getContacts() :array
    {
        return $this->contacts;
    }

    /**
     * @param ContactInterface[] $contacts
     */
    public function setContacts(array $contacts) :void
    {
        $this->contacts = $contacts;
    }

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) :void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getCurrencyId() :int
    {
        return $this->currencyId;
    }

    /**
     * @param int $currencyId
     */
    public function setCurrencyId(int $currencyId) :void
    {
        $this->currencyId = $currencyId;
    }
}
