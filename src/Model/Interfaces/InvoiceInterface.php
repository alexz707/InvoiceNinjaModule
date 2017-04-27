<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model\Interfaces;

use InvoiceNinjaModule\Model\InvoiceItem;

/**
 * Interface InvoiceInterface
 */
interface InvoiceInterface extends BaseInterface
{
    const STATUS_DRAFT = 1;
    const STATUS_SENT = 2;
    const STATUS_VIEWED = 3;
    const STATUS_APPROVED = 4;
    const STATUS_PARTIAL = 5;
    const STATUS_PAID = 6;
    const STATUS_OVERDUE = -1;
    const STATUS_UNPAID = -2;

    const TYPE_STANDARD = 1;
    const TYPE_QUOTE = 2;

    const FREQUENCY_WEEKLY = 1;
    const FREQUENCY_TWO_WEEKS = 2;
    const FREQUENCY_FOUR_WEEKS = 3;
    const FREQUENCY_MONTHLY = 4;
    const FREQUENCY_TWO_MONTHS = 5;
    const FREQUENCY_THREE_MONTHS = 6;
    const FREQUENCY_SIX_MONTHS = 7;
    const FREQUENCY_ANNUALLY = 8;

    const INVOICE_NR = 'invoice_number';

    /**
     * @return float
     */
    public function getAmount() : float;

    /**
     * @param float $amount
     */
    public function setAmount(float $amount) : void;

    /**
     * @return float
     */
    public function getBalance() : float;

    /**
     * @param float $balance
     */
    public function setBalance(float $balance) : void;

    /**
     * @return int
     */
    public function getClientId() : int;

    /**
     * @param int $clientId
     */
    public function setClientId(int $clientId) : void;

    /**
     * @return int
     */
    public function getInvoiceStatusId() : int;

    /**
     * @param int $invoiceStatusId
     */
    public function setInvoiceStatusId(int $invoiceStatusId) : void;

    /**
     * @return string
     */
    public function getInvoiceNumber() : string;

    /**
     * @param string $invoiceNumber
     */
    public function setInvoiceNumber(string $invoiceNumber) : void;

    /**
     * @return float
     */
    public function getDiscount() : float;

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount) : void;

    /**
     * @return string
     */
    public function getPoNumber() : string;

    /**
     * @param string $poNumber
     */
    public function setPoNumber(string $poNumber) : void;

    /**
     * @return string
     */
    public function getInvoiceDate() : string;

    /**
     * @param string $invoiceDate
     */
    public function setInvoiceDate(string $invoiceDate) : void;

    /**
     * @return string
     */
    public function getDueDate() : string;

    /**
     * @param string $dueDate
     */
    public function setDueDate(string $dueDate) : void;

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
     * @return int
     */
    public function getInvoiceTypeId() : int;

    /**
     * @param int $invoiceTypeId
     */
    public function setInvoiceTypeId(int $invoiceTypeId) : void;

    /**
     * @return bool
     */
    public function isRecurring() : bool;

    /**
     * @param bool $isRecurring
     */
    public function setRecurring(bool $isRecurring) : void;

    /**
     * @return int
     */
    public function getFrequencyId() : int;

    /**
     * @param int $frequencyId
     */
    public function setFrequencyId(int $frequencyId) : void;

    /**
     * @return string
     */
    public function getStartDate() : string;

    /**
     * @param string $startDate
     */
    public function setStartDate(string $startDate) : void;

    /**
     * @return string
     */
    public function getEndDate() : string;

    /**
     * @param string $endDate
     */
    public function setEndDate(string $endDate) : void;

    /**
     * @return string
     */
    public function getLastSentDate() : string;

    /**
     * @param string $lastSentDate
     */
    public function setLastSentDate(string $lastSentDate) : void;

    /**
     * @return int
     */
    public function getRecurringInvoiceId() : int;
    /**
     * @param int $recurringInvoiceId
     */
    public function setRecurringInvoiceId(int $recurringInvoiceId) : void;

    /**
     * @return string
     */
    public function getTaxName1() : string;

    /**
     * @param string $taxName1
     */
    public function setTaxName1(string $taxName1) : void;

    /**
     * @return float
     */
    public function getTaxRate1() : float;

    /**
     * @param float $taxRate1
     */
    public function setTaxRate1(float $taxRate1) : void;
    /**
     * @return string
     */
    public function getTaxName2() : string;

    /**
     * @param string $taxName2
     */
    public function setTaxName2(string $taxName2) : void;

    /**
     * @return float
     */
    public function getTaxRate2() : float;

    /**
     * @param float $taxRate2
     */
    public function setTaxRate2(float $taxRate2) : void;

    /**
     * @return bool
     */
    public function isAmountDiscount() : bool;

    /**
     * @param bool $isAmountDiscount
     */
    public function setAmountDiscount(bool $isAmountDiscount) : void;

    /**
     * @return string
     */
    public function getInvoiceFooter() : string;

    /**
     * @param string $invoiceFooter
     */
    public function setInvoiceFooter(string $invoiceFooter) : void;

    /**
     * @return float
     */
    public function getPartial() : float;

    /**
     * @param float $partial
     */
    public function setPartial(float $partial) : void;

    /**
     * @return bool
     */
    public function hasTasks() : bool;

    /**
     * @param bool $hasTasks
     */
    public function setHasTasks(bool $hasTasks) : void;

    /**
     * @return bool
     */
    public function isAutoBill() : bool;

    /**
     * @param bool $autoBill
     */
    public function setAutoBill(bool $autoBill) : void;

    /**
     * @return int
     */
    public function getCustomValue1() : int;

    /**
     * @param int $customValue1
     */
    public function setCustomValue1(int $customValue1) : void;

    /**
     * @return int
     */
    public function getCustomValue2() : int;

    /**
     * @param int $customValue2
     */
    public function setCustomValue2(int $customValue2) : void;

    /**
     * @return bool
     */
    public function isCustomTaxes1() : bool;

    /**
     * @param bool $customTaxes1
     */
    public function setCustomTaxes1(bool $customTaxes1) : void;

    /**
     * @return bool
     */
    public function isCustomTaxes2() : bool;

    /**
     * @param bool $customTaxes2
     */
    public function setCustomTaxes2(bool $customTaxes2) : void;

    /**
     * @return bool
     */
    public function hasExpenses() : bool;

    /**
     * @param bool $hasExpenses
     */
    public function setHasExpenses(bool $hasExpenses) : void;

    /**
     * @return int
     */
    public function getQuoteInvoiceId() : int;

    /**
     * @param int $quoteInvoiceId
     */
    public function setQuoteInvoiceId(int $quoteInvoiceId) : void;

    /**
     * @return string
     */
    public function getCustomTextValue1() : string;

    /**
     * @param string $customTextValue1
     */
    public function setCustomTextValue1(string $customTextValue1) : void;

    /**
     * @return string
     */
    public function getCustomTextValue2() : string;

    /**
     * @param string $customTextValue2
     */
    public function setCustomTextValue2(string $customTextValue2) : void;

    /**
     * @return bool
     */
    public function isQuote() : bool;

    /**
     * @param bool $isQuote
     */
    public function setQuote(bool $isQuote) : void;

    /**
     * @return bool
     */
    public function isPublic() : bool;
    /**
     * @param bool $isPublic
     */
    public function setPublic(bool $isPublic) : void;

    /**
     * @return InvoiceItem[]
     */
    public function getInvoiceItems() : array;
    /**
     * @param InvoiceItem[] $invoiceItems
     */
    public function setInvoiceItems(array $invoiceItems) : void;
}
