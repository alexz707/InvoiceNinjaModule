<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model\Interfaces;

use DateTimeInterface;
use InvoiceNinjaModule\Model\Invitation;
use InvoiceNinjaModule\Model\InvoiceItem;

/**
 * Interface InvoiceInterface
 */
interface InvoiceInterface extends BaseInterface
{
    public const STATUS_DRAFT = '1';
    public const STATUS_SENT = '2';
    public const STATUS_VIEWED = '3';
    public const STATUS_APPROVED = '4';
    public const STATUS_PARTIAL = '5';
    public const STATUS_PAID = '6';
    public const STATUS_OVERDUE = '-1';
    public const STATUS_UNPAID = '-2';

    public const TYPE_STANDARD = 1;
    public const TYPE_QUOTE = 2;

    public const FREQUENCY_WEEKLY = 1;
    public const FREQUENCY_TWO_WEEKS = 2;
    public const FREQUENCY_FOUR_WEEKS = 3;
    public const FREQUENCY_MONTHLY = 4;
    public const FREQUENCY_TWO_MONTHS = 5;
    public const FREQUENCY_THREE_MONTHS = 6;
    public const FREQUENCY_FOUR_MONTHS = 7;
    public const FREQUENCY_SIX_MONTHS = 8;
    public const FREQUENCY_ANNUALLY = 9;
    public const FREQUENCY_TWO_YEARS = 10;

    public const INVOICE_NR = 'invoice_number';

    /**
     * @return string
     */
    public function getProjectId() : string;

    /**
     * @param string $projectId
     */
    public function setProjectId(string $projectId) : void;

    /**
     * @return float|int
     */
    public function getAmount() : float|int;

    /**
     * @param float|int $amount
     */
    public function setAmount(float|int $amount) : void;

    /**
     * @return float|int
     */
    public function getBalance() : float|int;

    /**
     * @param float|int $balance
     */
    public function setBalance(float|int $balance) : void;

    /**
     * @return string
     */
    public function getClientId() : string;

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId) : void;

    /**
     * @return string
     */
    public function getVendorId() : string;

    /**
     * @param string $vendorId
     */
    public function setVendorId(string $vendorId) : void;

    /**
     * @return string
     */
    public function getStatusId() : string;

    /**
     * @param string $statusId
     */
    public function setStatusId(string $statusId) : void;

    /**
     * @return string
     */
    public function getDesignId() : string;

    /**
     * @param string $designId
     */
    public function setDesignId(string $designId) : void;

    /**
     * @return string
     */
    public function getRecurringId() : string;

    /**
     * @param string $recurringId
     */
    public function setRecurringId(string $recurringId) : void;

    /**
     * @return string
     */
    public function getNumber() : string;

    /**
     * @param string $number
     */
    public function setNumber(string $number) : void;

    /**
     * @return float|int
     */
    public function getDiscount() : float|int;

    /**
     * @param float|int $discount
     */
    public function setDiscount(float|int $discount) : void;

    /**
     * @return string
     */
    public function getPoNumber() : string;

    /**
     * @param string $poNumber
     */
    public function setPoNumber(string $poNumber) : void;

    /**
     * @return DateTimeInterface
     */
    public function getDate() : DateTimeInterface;

    /**
     * @param DateTimeInterface $date
     */
    public function setDate(DateTimeInterface $date) : void;

    /**
     * @return string
     */
    public function getLastSentDate() : string;

    /**
     * @param string $lastSentDate
     */
    public function setLastSentDate(string $lastSentDate) : void;

    /**
     * @return string
     */
    public function getNextSendDate() : string;

    /**
     * @param string $nextSendDate
     */
    public function setNextSendDate(string $nextSendDate) : void;

    /**
     * @return DateTimeInterface
     */
    public function getDueDate() : DateTimeInterface;

    /**
     * @param DateTimeInterface $dueDate
     */
    public function setDueDate(DateTimeInterface $dueDate) : void;

    /**
     * @return string
     */
    public function getTerms() : string;

    /**
     * @param string $terms
     */
    public function setTerms(string $terms) : void;

    /**
     * @return string
     */
    public function getPublicNotes() : string;

    /**
     * @param string $publicNotes
     */
    public function setPublicNotes(string $publicNotes) : void;

    /**
     * @return string
     */
    public function getPrivateNotes() : string;

    /**
     * @param string $privateNotes
     */
    public function setPrivateNotes(string $privateNotes) : void;

    /**
     * @return bool
     */
    public function isUsesInclusiveTaxes() : bool;

    /**
     * @param bool $usesInclusiveTaxes
     */
    public function setUsesInclusiveTaxes(bool $usesInclusiveTaxes) : void;

    /**
     * @return string
     */
    public function getTaxName1() : string;

    /**
     * @param string $taxName1
     */
    public function setTaxName1(string $taxName1) : void;

    /**
     * @return float|int
     */
    public function getTaxRate1() : float|int;

    /**
     * @param float|int $taxRate1
     */
    public function setTaxRate1(float|int $taxRate1) : void;

    /**
     * @return string
     */
    public function getTaxName2() : string;

    /**
     * @param string $taxName2
     */
    public function setTaxName2(string $taxName2) : void;

    /**
     * @return float|int
     */
    public function getTaxRate2() : float|int;

    /**
     * @param float|int $taxRate2
     */
    public function setTaxRate2(float|int $taxRate2) : void;

    /**
     * @return string
     */
    public function getTaxName3() : string;

    /**
     * @param string $taxName3
     */
    public function setTaxName3(string $taxName3) : void;

    /**
     * @return float|int
     */
    public function getTaxRate3() : float|int;

    /**
     * @param float|int $taxRate3
     */
    public function setTaxRate3(float|int $taxRate3) : void;

    /**
     * @return float|int
     */
    public function getTotalTaxes() : float|int;

    /**
     * @param float|int $totalTaxes
     */
    public function setTotalTaxes(float|int $totalTaxes) : void;

    /**
     * @return bool
     */
    public function isAmountDiscount() : bool;

    /**
     * @param bool $isAmountDiscount
     */
    public function setIsAmountDiscount(bool $isAmountDiscount) : void;

    /**
     * @return string
     */
    public function getFooter() : string;

    /**
     * @param string $footer
     */
    public function setFooter(string $footer) : void;

    /**
     * @return int
     */
    public function getPartial() : int;

    /**
     * @param int $partial
     */
    public function setPartial(int $partial) : void;

    /**
     * @return string
     */
    public function getPartialDueDate() : string;

    /**
     * @param string $partialDueDate
     */
    public function setPartialDueDate(string $partialDueDate) : void;

    /**
     * @return string
     */
    public function getCustomValue1() : string;

    /**
     * @param string $customValue1
     */
    public function setCustomValue1(string $customValue1) : void;

    /**
     * @return string
     */
    public function getCustomValue2() : string;

    /**
     * @param string $customValue2
     */
    public function setCustomValue2(string $customValue2) : void;

    /**
     * @return string
     */
    public function getCustomValue3() : string;

    /**
     * @param string $customValue3
     */
    public function setCustomValue3(string $customValue3) : void;

    /**
     * @return string
     */
    public function getCustomValue4() : string;

    /**
     * @param string $customValue4
     */
    public function setCustomValue4(string $customValue4) : void;

    /**
     * @return bool
     */
    public function isHasTasks() : bool;

    /**
     * @param bool $hasTasks
     */
    public function setHasTasks(bool $hasTasks) : void;

    /**
     * @return bool
     */
    public function isHasExpenses() : bool;

    /**
     * @param bool $hasExpenses
     */
    public function setHasExpenses(bool $hasExpenses) : void;

    /**
     * @return float|int
     */
    public function getCustomSurcharge1() : float|int;

    /**
     * @param float|int $customSurcharge1
     */
    public function setCustomSurcharge1(float|int $customSurcharge1) : void;

    /**
     * @return float|int
     */
    public function getCustomSurcharge2() : float|int;

    /**
     * @param float|int $customSurcharge2
     */
    public function setCustomSurcharge2(float|int $customSurcharge2) : void;

    /**
     * @return float|int
     */
    public function getCustomSurcharge3() : float|int;

    /**
     * @param float|int $customSurcharge3
     */
    public function setCustomSurcharge3(float|int $customSurcharge3) : void;

    /**
     * @return float|int
     */
    public function getCustomSurcharge4() : float|int;

    /**
     * @param float|int $customSurcharge4
     */
    public function setCustomSurcharge4(float|int $customSurcharge4) : void;

    /**
     * @return float|int
     */
    public function getExchangeRate() : float|int;

    /**
     * @param float|int $exchangeRate
     */
    public function setExchangeRate(float|int $exchangeRate) : void;

    /**
     * @return bool
     */
    public function isCustomSurchargeTax1() : bool;

    /**
     * @param bool $customSurchargeTax1
     */
    public function setCustomSurchargeTax1(bool $customSurchargeTax1) : void;

    /**
     * @return bool
     */
    public function isCustomSurchargeTax2() : bool;

    /**
     * @param bool $customSurchargeTax2
     */
    public function setCustomSurchargeTax2(bool $customSurchargeTax2) : void;

    /**
     * @return bool
     */
    public function isCustomSurchargeTax3() : bool;

    /**
     * @param bool $customSurchargeTax3
     */
    public function setCustomSurchargeTax3(bool $customSurchargeTax3) : void;

    /**
     * @return bool
     */
    public function isCustomSurchargeTax4() : bool;

    /**
     * @param bool $customSurchargeTax4
     */
    public function setCustomSurchargeTax4(bool $customSurchargeTax4) : void;

    /**
     * @return InvoiceItem[]
     */
    public function getLineItems() : array;

    /**
     * @param InvoiceItem[] $lineItems
     */
    public function setLineItems(array $lineItems) : void;

    /**
     * @return string
     */
    public function getEntityType() : string;

    /**
     * @param string $entityType
     */
    public function setEntityType(string $entityType) : void;

    /**
     * @return string
     */
    public function getReminder1Sent() : string;

    /**
     * @param string $reminder1Sent
     */
    public function setReminder1Sent(string $reminder1Sent) : void;

    /**
     * @return string
     */
    public function getReminder2Sent() : string;

    /**
     * @param string $reminder2Sent
     */
    public function setReminder2Sent(string $reminder2Sent) : void;

    /**
     * @return string
     */
    public function getReminder3Sent() : string;

    /**
     * @param string $reminder3Sent
     */
    public function setReminder3Sent(string $reminder3Sent) : void;

    /**
     * @return string
     */
    public function getReminderLastSent() : string;

    /**
     * @param string $reminderLastSent
     */
    public function setReminderLastSent(string $reminderLastSent) : void;

    /**
     * @return float|int
     */
    public function getPaidToDate() : float|int;

    /**
     * @param float|int $paidToDate
     */
    public function setPaidToDate(float|int $paidToDate) : void;

    /**
     * @return string
     */
    public function getSubscriptionId() : string;

    /**
     * @param string $subscriptionId
     */
    public function setSubscriptionId(string $subscriptionId) : void;

    /**
     * @return bool
     */
    public function isAutoBillEnabled() : bool;

    /**
     * @param bool $autoBillEnabled
     */
    public function setAutoBillEnabled(bool $autoBillEnabled) : void;

    /**
     * @return Invitation[]
     */
    public function getInvitations() : array;

    /**
     * @param Invitation[] $invitations
     */
    public function setInvitations(array $invitations) : void;

    /**
     * @return array
     */
    public function getDocuments() : array;

    /**
     * @param array $documents
     */
    public function setDocuments(array $documents) : void;
}
