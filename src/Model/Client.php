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
    private string $userId = '';
    private string $assignedUserId = '';
    private string $groupSettingsId = '';
    private string $displayName = '';
    private string $number = '';
    private string $companyId = '';
    private string $name = '';
    private string $website = '';
    private string $privateNotes = '';
    private string $clientHash = '';
    private string $industryId = '';
    private string $sizeId = '';
    private string $address1 = '';
    private string $address2 = '';
    private string $city = '';
    private string $state = '';
    private string $postalCode = '';
    private string $phone = '';
    private string $countryId = '';
    private string $customValue1 = '';
    private string $customValue2 = '';
    private string $customValue3 = '';
    private string $customValue4 = '';
    private string $vatNumber = '';
    private string $idNumber = '';
    private string $shippingAddress1 = '';
    private string $shippingAddress2 = '';
    private string $shippingCity = '';
    private string $shippingState = '';
    private string $shippingPostalCode = '';
    private string $shippingCountryId = '';
    private float $balance = 0;
    private float $paidToDate = 0;
    private float $creditBalance = 0;
    private int $lastLogin = 0;
    /** @var ContactInterface[]  */
    private array $contacts = [];
    private array $documents = [];
    private array $gatewayTokens = [];

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return float
     */
    public function getPaidToDate(): float
    {
        return $this->paidToDate;
    }

    /**
     * @param float $paidToDate
     */
    public function setPaidToDate(float $paidToDate): void
    {
        $this->paidToDate = $paidToDate;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @param string $userId
     */
    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     */
    public function setAddress1(string $address1): void
    {
        $this->address1 = $address1;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     */
    public function setAddress2(string $address2): void
    {
        $this->address2 = $address2;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string
     */
    public function getCountryId(): string
    {
        return $this->countryId;
    }

    /**
     * @param string $countryId
     */
    public function setCountryId(string $countryId): void
    {
        $this->countryId = $countryId;
    }

    /**
     * @return string
     */
    public function getPrivateNotes(): string
    {
        return $this->privateNotes;
    }

    /**
     * @param string $privateNotes
     */
    public function setPrivateNotes(string $privateNotes): void
    {
        $this->privateNotes = $privateNotes;
    }

    /**
     * @return int
     */
    public function getLastLogin(): int
    {
        return $this->lastLogin;
    }

    /**
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getIndustryId(): string
    {
        return $this->industryId;
    }

    /**
     * @param string $industryId
     */
    public function setIndustryId(string $industryId): void
    {
        $this->industryId = $industryId;
    }

    /**
     * @return string
     */
    public function getSizeId(): string
    {
        return $this->sizeId;
    }

    /**
     * @param string $sizeId
     */
    public function setSizeId(string $sizeId): void
    {
        $this->sizeId = $sizeId;
    }

    /**
     * @return string
     */
    public function getCustomValue1(): string
    {
        return $this->customValue1;
    }

    /**
     * @param string $customValue
     */
    public function setCustomValue1(string $customValue): void
    {
        $this->customValue1 = $customValue;
    }

    /**
     * @return string
     */
    public function getCustomValue2(): string
    {
        return $this->customValue2;
    }

    /**
     * @param string $customValue
     */
    public function setCustomValue2(string $customValue): void
    {
        $this->customValue2 = $customValue;
    }

    /**
     * @return string
     */
    public function getVatNumber(): string
    {
        return $this->vatNumber;
    }

    /**
     * @param string $vatNumber
     */
    public function setVatNumber(string $vatNumber): void
    {
        $this->vatNumber = $vatNumber;
    }

    /**
     * @return string
     */
    public function getIdNumber(): string
    {
        return $this->idNumber;
    }

    /**
     * @param string $idNumber
     */
    public function setIdNumber(string $idNumber): void
    {
        $this->idNumber = $idNumber;
    }

    /**
     * @return ContactInterface[]
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    /**
     * @param ContactInterface[] $contacts
     */
    public function setContacts(array $contacts): void
    {
        $this->contacts = $contacts;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAssignedUserId(): string
    {
        return $this->assignedUserId;
    }

    /**
     * @param string $assignedUserId
     */
    public function setAssignedUserId(string $assignedUserId): void
    {
        $this->assignedUserId = $assignedUserId;
    }

    /**
     * @return string
     */
    public function getGroupSettingsId(): string
    {
        return $this->groupSettingsId;
    }

    /**
     * @param string $groupSettingsId
     */
    public function setGroupSettingsId(string $groupSettingsId): void
    {
        $this->groupSettingsId = $groupSettingsId;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     */
    public function setDisplayName(string $displayName): void
    {
        $this->displayName = $displayName;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * @param string $companyId
     */
    public function setCompanyId(string $companyId): void
    {
        $this->companyId = $companyId;
    }

    /**
     * @return string
     */
    public function getClientHash(): string
    {
        return $this->clientHash;
    }

    /**
     * @param string $clientHash
     */
    public function setClientHash(string $clientHash): void
    {
        $this->clientHash = $clientHash;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getCustomValue3(): string
    {
        return $this->customValue3;
    }

    /**
     * @param string $customValue
     */
    public function setCustomValue3(string $customValue): void
    {
        $this->customValue3 = $customValue;
    }

    /**
     * @return string
     */
    public function getCustomValue4(): string
    {
        return $this->customValue4;
    }

    /**
     * @param string $customValue
     */
    public function setCustomValue4(string $customValue): void
    {
        $this->customValue4 = $customValue;
    }

    /**
     * @return string
     */
    public function getShippingAddress1(): string
    {
        return $this->shippingAddress1;
    }

    /**
     * @param string $shippingAddress1
     */
    public function setShippingAddress1(string $shippingAddress1): void
    {
        $this->shippingAddress1 = $shippingAddress1;
    }

    /**
     * @return string
     */
    public function getShippingAddress2(): string
    {
        return $this->shippingAddress2;
    }

    /**
     * @param string $shippingAddress2
     */
    public function setShippingAddress2(string $shippingAddress2): void
    {
        $this->shippingAddress2 = $shippingAddress2;
    }

    /**
     * @return string
     */
    public function getShippingCity(): string
    {
        return $this->shippingCity;
    }

    /**
     * @param string $shippingCity
     */
    public function setShippingCity(string $shippingCity): void
    {
        $this->shippingCity = $shippingCity;
    }

    /**
     * @return string
     */
    public function getShippingState(): string
    {
        return $this->shippingState;
    }

    /**
     * @param string $shippingState
     */
    public function setShippingState(string $shippingState): void
    {
        $this->shippingState = $shippingState;
    }

    /**
     * @return string
     */
    public function getShippingPostalCode(): string
    {
        return $this->shippingPostalCode;
    }

    /**
     * @param string $shippingPostalCode
     */
    public function setShippingPostalCode(string $shippingPostalCode): void
    {
        $this->shippingPostalCode = $shippingPostalCode;
    }

    /**
     * @return string
     */
    public function getShippingCountryId(): string
    {
        return $this->shippingCountryId;
    }

    /**
     * @param string $shippingCountryId
     */
    public function setShippingCountryId(string $shippingCountryId): void
    {
        $this->shippingCountryId = $shippingCountryId;
    }

    /**
     * @return float|int
     */
    public function getCreditBalance(): float|int
    {
        return $this->creditBalance;
    }

    /**
     * @param float|int $creditBalance
     */
    public function setCreditBalance(float|int $creditBalance): void
    {
        $this->creditBalance = $creditBalance;
    }

    /**
     * @return array
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }

    /**
     * @param array $documents
     */
    public function setDocuments(array $documents): void
    {
        $this->documents = $documents;
    }

    /**
     * @return array
     */
    public function getGatewayTokens(): array
    {
        return $this->gatewayTokens;
    }

    /**
     * @param array $gatewayTokens
     */
    public function setGatewayTokens(array $gatewayTokens): void
    {
        $this->gatewayTokens = $gatewayTokens;
    }
}
