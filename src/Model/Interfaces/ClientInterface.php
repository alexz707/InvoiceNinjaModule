<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface ClientInterface
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
     * @return string
     */
    public function getUserId() :string;

    /**
     * @param string $userId
     */
    public function setUserId(string $userId) :void;

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
     * @return string
     */
    public function getCountryId() :string;

    /**
     * @param string $countryId
     */
    public function setCountryId(string $countryId) :void;

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
    public function getLastLogin() :int;

    /**
     * @return string
     */
    public function getWebsite() :string;

    /**
     * @param string $website
     */
    public function setWebsite(string $website) :void;

    /**
     * @return string
     */
    public function getIndustryId() :string;

    /**
     * @param string $industryId
     */
    public function setIndustryId(string $industryId) :void;

    /**
     * @return string
     */
    public function getSizeId() :string;

    /**
     * @param string $sizeId
     */
    public function setSizeId(string $sizeId) :void;

    /**
     * @return string
     */
    public function getCustomValue1() :string;

    /**
     * @param string $customValue
     */
    public function setCustomValue1(string $customValue) :void;

    /**
     * @return string
     */
    public function getCustomValue2() :string;

    /**
     * @param string $customValue
     */
    public function setCustomValue2(string $customValue) :void;

    /**
     * @return string
     */
    public function getCustomValue3() :string;

    /**
     * @param string $customValue
     */
    public function setCustomValue3(string $customValue) :void;

    /**
     * @return string
     */
    public function getCustomValue4() :string;

    /**
     * @param string $customValue
     */
    public function setCustomValue4(string $customValue) :void;

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
     * @return string
     */
    public function getShippingAddress1() : string;

    /**
     * @param string $shippingAddress1
     */
    public function setShippingAddress1(string $shippingAddress1) : void;

    /**
     * @return string
     */
    public function getShippingAddress2() : string;

    /**
     * @param string $shippingAddress2
     */
    public function setShippingAddress2(string $shippingAddress2) : void;

    /**
     * @return string
     */
    public function getShippingCity() : string;

    /**
     * @param string $shippingCity
     */
    public function setShippingCity(string $shippingCity) : void;

    /**
     * @return string
     */
    public function getShippingState() : string;

    /**
     * @param string $shippingState
     */
    public function setShippingState(string $shippingState) : void;

    /**
     * @return string
     */
    public function getShippingPostalCode() : string;

    /**
     * @param string $shippingPostalCode
     */
    public function setShippingPostalCode(string $shippingPostalCode) : void;

    /**
     * @return string
     */
    public function getShippingCountryId() : string;

    /**
     * @param string $shippingCountryId
     */
    public function setShippingCountryId(string $shippingCountryId) : void;

    /**
     * @return float|int
     */
    public function getCreditBalance() : float|int;

    /**
     * @param float|int $creditBalance
     */
    public function setCreditBalance(float|int $creditBalance) : void;

    /**
     * @return array
     */
    public function getDocuments() : array;

    /**
     * @param array $documents
     */
    public function setDocuments(array $documents) : void;

    /**
     * @return array
     */
    public function getGatewayTokens() : array;

    /**
     * @param array $gatewayTokens
     */
    public function setGatewayTokens(array $gatewayTokens) : void;
}
