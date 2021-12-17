<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use DateTime;
use DateTimeInterface;
use InvoiceNinjaModule\Model\Interfaces\InvoiceInterface;

/**
 * Class Invoice
 * @codeCoverageIgnore
 */
final class Invoice extends Base implements InvoiceInterface
{
    private string $projectId = '';
    private float $amount = 0;
    private float $balance = 0;
    private string $clientId = '';
    private string $vendorId = '';
    private int $statusId = InvoiceInterface::STATUS_DRAFT;
    private string $designId = '';
    private string $recurringId = '';
    private string $number = '';
    private float $discount = 0;
    private string $poNumber = '';
    private string $date = '';
    private string $lastSentDate = '';
    private string $nextSendDate = '';
    private string $dueDate = '';
    private string $terms = '';
    private string $publicNotes = '';
    private string $privateNotes = '';
    private bool $usesInclusiveTaxes = false;
    private string $taxName1 = '';
    private float $taxRate1 = 0;
    private string $taxName2 = '';
    private float $taxRate2 = 0;
    private string $taxName3 = '';
    private float $taxRate3 = 0;
    private float $totalTaxes = 0;
    private bool $isAmountDiscount = false;
    private string $footer = '';
    private int $partial = 0;
    private string $partialDueDate = '';
    private string $customValue1 = '';
    private string $customValue2 = '';
    private string $customValue3 = '';
    private string $customValue4 = '';
    private bool $hasTasks = false;
    private bool $hasExpenses = false;
    private float $customSurcharge1 = 0;
    private float $customSurcharge2 = 0;
    private float $customSurcharge3 = 0;
    private float $customSurcharge4 = 0;
    private float $exchangeRate = 0;
    private bool $customSurchargeTax1 = false;
    private bool $customSurchargeTax2 = false;
    private bool $customSurchargeTax3 = false;
    private bool $customSurchargeTax4 = false;
    /** @var  InvoiceItem[] */
    private array $lineItems = [];
    private string $entityType = ''; //invoice?
    private string $reminder1Sent = '';
    private string $reminder2Sent = '';
    private string $reminder3Sent = '';
    private string $reminderLastSent = '';
    private float $paidToDate = 0;
    private string $subscriptionId = '';
    private bool $autoBillEnabled = false;
    private array $invitations = [];
    private array $documents = [];

    /**
     * @return string
     */
    public function getProjectId(): string
    {
        return $this->projectId;
    }

    /**
     * @param string $projectId
     */
    public function setProjectId(string $projectId): void
    {
        $this->projectId = $projectId;
    }

    /**
     * @return float|int
     */
    public function getAmount(): float|int
    {
        return $this->amount;
    }

    /**
     * @param float|int $amount
     */
    public function setAmount(float|int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return float|int
     */
    public function getBalance(): float|int
    {
        return $this->balance;
    }

    /**
     * @param float|int $balance
     */
    public function setBalance(float|int $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getVendorId(): string
    {
        return $this->vendorId;
    }

    /**
     * @param string $vendorId
     */
    public function setVendorId(string $vendorId): void
    {
        $this->vendorId = $vendorId;
    }

    /**
     * @return int
     */
    public function getStatusId(): int
    {
        return $this->statusId;
    }

    /**
     * @param int $statusId
     */
    public function setStatusId(int $statusId): void
    {
        $this->statusId = $statusId;
    }

    /**
     * @return string
     */
    public function getDesignId(): string
    {
        return $this->designId;
    }

    /**
     * @param string $designId
     */
    public function setDesignId(string $designId): void
    {
        $this->designId = $designId;
    }

    /**
     * @return string
     */
    public function getRecurringId(): string
    {
        return $this->recurringId;
    }

    /**
     * @param string $recurringId
     */
    public function setRecurringId(string $recurringId): void
    {
        $this->recurringId = $recurringId;
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
     * @return float|int
     */
    public function getDiscount(): float|int
    {
        return $this->discount;
    }

    /**
     * @param float|int $discount
     */
    public function setDiscount(float|int $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return string
     */
    public function getPoNumber(): string
    {
        return $this->poNumber;
    }

    /**
     * @param string $poNumber
     */
    public function setPoNumber(string $poNumber): void
    {
        $this->poNumber = $poNumber;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDate(): DateTimeInterface
    {
        return DateTime::createFromFormat('Y-m-d', $this->date);
    }

    /**
     * @param DateTimeInterface $date
     */
    public function setDate(DateTimeInterface $date): void
    {
        $this->date = $date->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getLastSentDate(): string
    {
        return $this->lastSentDate;
    }

    /**
     * @param string $lastSentDate
     */
    public function setLastSentDate(string $lastSentDate): void
    {
        $this->lastSentDate = $lastSentDate;
    }

    /**
     * @return string
     */
    public function getNextSendDate(): string
    {
        return $this->nextSendDate;
    }

    /**
     * @param string $nextSendDate
     */
    public function setNextSendDate(string $nextSendDate): void
    {
        $this->nextSendDate = $nextSendDate;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDueDate(): DateTimeInterface
    {
        return DateTime::createFromFormat('Y-m-d', $this->dueDate);
    }

    /**
     * @param DateTimeInterface $dueDate
     */
    public function setDueDate(DateTimeInterface $dueDate): void
    {
        $this->dueDate = $dueDate->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getTerms(): string
    {
        return $this->terms;
    }

    /**
     * @param string $terms
     */
    public function setTerms(string $terms): void
    {
        $this->terms = $terms;
    }

    /**
     * @return string
     */
    public function getPublicNotes(): string
    {
        return $this->publicNotes;
    }

    /**
     * @param string $publicNotes
     */
    public function setPublicNotes(string $publicNotes): void
    {
        $this->publicNotes = $publicNotes;
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
     * @return bool
     */
    public function isUsesInclusiveTaxes(): bool
    {
        return $this->usesInclusiveTaxes;
    }

    /**
     * @param bool $usesInclusiveTaxes
     */
    public function setUsesInclusiveTaxes(bool $usesInclusiveTaxes): void
    {
        $this->usesInclusiveTaxes = $usesInclusiveTaxes;
    }

    /**
     * @return string
     */
    public function getTaxName1(): string
    {
        return $this->taxName1;
    }

    /**
     * @param string $taxName1
     */
    public function setTaxName1(string $taxName1): void
    {
        $this->taxName1 = $taxName1;
    }

    /**
     * @return float|int
     */
    public function getTaxRate1(): float|int
    {
        return $this->taxRate1;
    }

    /**
     * @param float|int $taxRate1
     */
    public function setTaxRate1(float|int $taxRate1): void
    {
        $this->taxRate1 = $taxRate1;
    }

    /**
     * @return string
     */
    public function getTaxName2(): string
    {
        return $this->taxName2;
    }

    /**
     * @param string $taxName2
     */
    public function setTaxName2(string $taxName2): void
    {
        $this->taxName2 = $taxName2;
    }

    /**
     * @return float|int
     */
    public function getTaxRate2(): float|int
    {
        return $this->taxRate2;
    }

    /**
     * @param float|int $taxRate2
     */
    public function setTaxRate2(float|int $taxRate2): void
    {
        $this->taxRate2 = $taxRate2;
    }

    /**
     * @return string
     */
    public function getTaxName3(): string
    {
        return $this->taxName3;
    }

    /**
     * @param string $taxName3
     */
    public function setTaxName3(string $taxName3): void
    {
        $this->taxName3 = $taxName3;
    }

    /**
     * @return float|int
     */
    public function getTaxRate3(): float|int
    {
        return $this->taxRate3;
    }

    /**
     * @param float|int $taxRate3
     */
    public function setTaxRate3(float|int $taxRate3): void
    {
        $this->taxRate3 = $taxRate3;
    }

    /**
     * @return float|int
     */
    public function getTotalTaxes(): float|int
    {
        return $this->totalTaxes;
    }

    /**
     * @param float|int $totalTaxes
     */
    public function setTotalTaxes(float|int $totalTaxes): void
    {
        $this->totalTaxes = $totalTaxes;
    }

    /**
     * @return bool
     */
    public function isAmountDiscount(): bool
    {
        return $this->isAmountDiscount;
    }

    /**
     * @param bool $isAmountDiscount
     */
    public function setIsAmountDiscount(bool $isAmountDiscount): void
    {
        $this->isAmountDiscount = $isAmountDiscount;
    }

    /**
     * @return string
     */
    public function getFooter(): string
    {
        return $this->footer;
    }

    /**
     * @param string $footer
     */
    public function setFooter(string $footer): void
    {
        $this->footer = $footer;
    }

    /**
     * @return int
     */
    public function getPartial(): int
    {
        return $this->partial;
    }

    /**
     * @param int $partial
     */
    public function setPartial(int $partial): void
    {
        $this->partial = $partial;
    }

    /**
     * @return string
     */
    public function getPartialDueDate(): string
    {
        return $this->partialDueDate;
    }

    /**
     * @param string $partialDueDate
     */
    public function setPartialDueDate(string $partialDueDate): void
    {
        $this->partialDueDate = $partialDueDate;
    }

    /**
     * @return string
     */
    public function getCustomValue1(): string
    {
        return $this->customValue1;
    }

    /**
     * @param string $customValue1
     */
    public function setCustomValue1(string $customValue1): void
    {
        $this->customValue1 = $customValue1;
    }

    /**
     * @return string
     */
    public function getCustomValue2(): string
    {
        return $this->customValue2;
    }

    /**
     * @param string $customValue2
     */
    public function setCustomValue2(string $customValue2): void
    {
        $this->customValue2 = $customValue2;
    }

    /**
     * @return string
     */
    public function getCustomValue3(): string
    {
        return $this->customValue3;
    }

    /**
     * @param string $customValue3
     */
    public function setCustomValue3(string $customValue3): void
    {
        $this->customValue3 = $customValue3;
    }

    /**
     * @return string
     */
    public function getCustomValue4(): string
    {
        return $this->customValue4;
    }

    /**
     * @param string $customValue4
     */
    public function setCustomValue4(string $customValue4): void
    {
        $this->customValue4 = $customValue4;
    }

    /**
     * @return bool
     */
    public function isHasTasks(): bool
    {
        return $this->hasTasks;
    }

    /**
     * @param bool $hasTasks
     */
    public function setHasTasks(bool $hasTasks): void
    {
        $this->hasTasks = $hasTasks;
    }

    /**
     * @return bool
     */
    public function isHasExpenses(): bool
    {
        return $this->hasExpenses;
    }

    /**
     * @param bool $hasExpenses
     */
    public function setHasExpenses(bool $hasExpenses): void
    {
        $this->hasExpenses = $hasExpenses;
    }

    /**
     * @return float|int
     */
    public function getCustomSurcharge1(): float|int
    {
        return $this->customSurcharge1;
    }

    /**
     * @param float|int $customSurcharge1
     */
    public function setCustomSurcharge1(float|int $customSurcharge1): void
    {
        $this->customSurcharge1 = $customSurcharge1;
    }

    /**
     * @return float|int
     */
    public function getCustomSurcharge2(): float|int
    {
        return $this->customSurcharge2;
    }

    /**
     * @param float|int $customSurcharge2
     */
    public function setCustomSurcharge2(float|int $customSurcharge2): void
    {
        $this->customSurcharge2 = $customSurcharge2;
    }

    /**
     * @return float|int
     */
    public function getCustomSurcharge3(): float|int
    {
        return $this->customSurcharge3;
    }

    /**
     * @param float|int $customSurcharge3
     */
    public function setCustomSurcharge3(float|int $customSurcharge3): void
    {
        $this->customSurcharge3 = $customSurcharge3;
    }

    /**
     * @return float|int
     */
    public function getCustomSurcharge4(): float|int
    {
        return $this->customSurcharge4;
    }

    /**
     * @param float|int $customSurcharge4
     */
    public function setCustomSurcharge4(float|int $customSurcharge4): void
    {
        $this->customSurcharge4 = $customSurcharge4;
    }

    /**
     * @return float|int
     */
    public function getExchangeRate(): float|int
    {
        return $this->exchangeRate;
    }

    /**
     * @param float|int $exchangeRate
     */
    public function setExchangeRate(float|int $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * @return bool
     */
    public function isCustomSurchargeTax1(): bool
    {
        return $this->customSurchargeTax1;
    }

    /**
     * @param bool $customSurchargeTax1
     */
    public function setCustomSurchargeTax1(bool $customSurchargeTax1): void
    {
        $this->customSurchargeTax1 = $customSurchargeTax1;
    }

    /**
     * @return bool
     */
    public function isCustomSurchargeTax2(): bool
    {
        return $this->customSurchargeTax2;
    }

    /**
     * @param bool $customSurchargeTax2
     */
    public function setCustomSurchargeTax2(bool $customSurchargeTax2): void
    {
        $this->customSurchargeTax2 = $customSurchargeTax2;
    }

    /**
     * @return bool
     */
    public function isCustomSurchargeTax3(): bool
    {
        return $this->customSurchargeTax3;
    }

    /**
     * @param bool $customSurchargeTax3
     */
    public function setCustomSurchargeTax3(bool $customSurchargeTax3): void
    {
        $this->customSurchargeTax3 = $customSurchargeTax3;
    }

    /**
     * @return bool
     */
    public function isCustomSurchargeTax4(): bool
    {
        return $this->customSurchargeTax4;
    }

    /**
     * @param bool $customSurchargeTax4
     */
    public function setCustomSurchargeTax4(bool $customSurchargeTax4): void
    {
        $this->customSurchargeTax4 = $customSurchargeTax4;
    }

    /**
     * @return InvoiceItem[]
     */
    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    /**
     * @param InvoiceItem[] $lineItems
     */
    public function setLineItems(array $lineItems): void
    {
        $this->lineItems = $lineItems;
    }

    /**
     * @return string
     */
    public function getEntityType(): string
    {
        return $this->entityType;
    }

    /**
     * @param string $entityType
     */
    public function setEntityType(string $entityType): void
    {
        $this->entityType = $entityType;
    }

    /**
     * @return string
     */
    public function getReminder1Sent(): string
    {
        return $this->reminder1Sent;
    }

    /**
     * @param string $reminder1Sent
     */
    public function setReminder1Sent(string $reminder1Sent): void
    {
        $this->reminder1Sent = $reminder1Sent;
    }

    /**
     * @return string
     */
    public function getReminder2Sent(): string
    {
        return $this->reminder2Sent;
    }

    /**
     * @param string $reminder2Sent
     */
    public function setReminder2Sent(string $reminder2Sent): void
    {
        $this->reminder2Sent = $reminder2Sent;
    }

    /**
     * @return string
     */
    public function getReminder3Sent(): string
    {
        return $this->reminder3Sent;
    }

    /**
     * @param string $reminder3Sent
     */
    public function setReminder3Sent(string $reminder3Sent): void
    {
        $this->reminder3Sent = $reminder3Sent;
    }

    /**
     * @return string
     */
    public function getReminderLastSent(): string
    {
        return $this->reminderLastSent;
    }

    /**
     * @param string $reminderLastSent
     */
    public function setReminderLastSent(string $reminderLastSent): void
    {
        $this->reminderLastSent = $reminderLastSent;
    }

    /**
     * @return float|int
     */
    public function getPaidToDate(): float|int
    {
        return $this->paidToDate;
    }

    /**
     * @param float|int $paidToDate
     */
    public function setPaidToDate(float|int $paidToDate): void
    {
        $this->paidToDate = $paidToDate;
    }

    /**
     * @return string
     */
    public function getSubscriptionId(): string
    {
        return $this->subscriptionId;
    }

    /**
     * @param string $subscriptionId
     */
    public function setSubscriptionId(string $subscriptionId): void
    {
        $this->subscriptionId = $subscriptionId;
    }

    /**
     * @return bool
     */
    public function isAutoBillEnabled(): bool
    {
        return $this->autoBillEnabled;
    }

    /**
     * @param bool $autoBillEnabled
     */
    public function setAutoBillEnabled(bool $autoBillEnabled): void
    {
        $this->autoBillEnabled = $autoBillEnabled;
    }

    /**
     * @return Invitation[]
     */
    public function getInvitations(): array
    {
        return $this->invitations;
    }

    /**
     * @param Invitation[] $invitations
     */
    public function setInvitations(array $invitations): void
    {
        $this->invitations = $invitations;
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
}
