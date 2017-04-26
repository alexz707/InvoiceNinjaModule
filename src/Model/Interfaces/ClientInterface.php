<?php

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface ClientInterface
 *
 * @package InvoiceNinjaModule\Model\Interfaces
 */
interface ClientInterface extends BaseInterface
{
    /**
     * @return float
     */
    public function getBalance() :float;

    /**
     * @param float $balance
     */
    public function setBalance(float $balance) :void;

    /**
     * @return float
     */
    public function getPaidToDate() :float;

    /**
     * @param float $paidToDate
     */
    public function setPaidToDate(float $paidToDate) :void;

    /**
     * @return int
     */
    public function getUserId() :int;

    /**
     * @param int $userId
     */
    public function setUserId(int $userId) :void;

    /**
     * @return string
     */
    public function getAddress1() :string;

    /**
     * @param string $address1
     */
    public function setAddress1(string $address1) :void;
    /**
     * @return string
     */
    public function getAddress2() :string;

    /**
     * @param string $address2
     */
    public function setAddress2(string $address2) :void;
    /**
     * @return string
     */
    public function getCity() :string;
    /**
     * @param string $city
     */
    public function setCity(string $city) :void;

    /**
     * @return string
     */
    public function getState() :string;
    /**
     * @param string $state
     */
    public function setState(string $state) :void;

    /**
     * @return string
     */
    public function getPostalCode() :string;

    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode) :void;

    /**
     * @return int
     */
    public function getCountryId() :int;
    /**
     * @param int $countryId
     */
    public function setCountryId(int $countryId) :void;

    /**
     * @return string
     */
    public function getWorkPhone() :string;

    /**
     * @param string $workPhone
     */
    public function setWorkPhone(string $workPhone) :void;

    /**
     * @return string
     */
    public function getPrivateNotes() :string;

    /**
     * @param string $privateNotes
     */
    public function setPrivateNotes(string $privateNotes) :void;
    /**
     * @return int
     */
    public function getLastLogin() :?int;

    /**
     * @return string
     */
    public function getWebsite() :string;
    /**
     * @param string $website
     */
    public function setWebsite(string $website) :void;

    /**
     * @return int
     */
    public function getIndustryId() :int;
    /**
     * @param int $industryId
     */
    public function setIndustryId(int $industryId) :void;

    /**
     * @return int
     */
    public function getSizeId() :int;

    /**
     * @param int $sizeId
     */
    public function setSizeId(int $sizeId) :void;

    /**
     * @return int
     */
    public function getPaymentTerms() :int;

    /**
     * @param int $paymentTerms
     */
    public function setPaymentTerms(int $paymentTerms) :void;
    /**
     * @return string
     */
    public function getCustomValue1() :?string;
    /**
     * @param string $customValue1
     */
    public function setCustomValue1(string $customValue1) :void;
    /**
     * @return string
     */
    public function getCustomValue2() :?string;
    /**
     * @param string $customValue2
     */
    public function setCustomValue2(string $customValue2) :void;
    /**
     * @return string
     */
    public function getVatNumber() :string;
    /**
     * @param string $vatNumber
     */
    public function setVatNumber(string $vatNumber) :void;

    /**
     * @return string
     */
    public function getIdNumber() :string;
    /**
     * @param string $idNumber
     */
    public function setIdNumber(string $idNumber) :void;

    /**
     * @return int
     */
    public function getLanguageId() :int;

    /**
     * @param int $languageId
     */
    public function setLanguageId(int $languageId) :void;

    /**
     * @return ContactInterface[]
     */
    public function getContacts() :array;

    /**
     * @param ContactInterface[] $contacts
     */
    public function setContacts(array $contacts) :void;
    /**
     * @return string
     */
    public function getName() :string;

    /**
     * @param string $name
     */
    public function setName(string $name) :void;
    /**
     * @return int
     */
    public function getCurrencyId() :int;
    /**
     * @param int $currencyId
     */
    public function setCurrencyId(int $currencyId) :void;
}
