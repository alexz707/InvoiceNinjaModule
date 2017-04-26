<?php

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\InvoiceInterface;

class Invoice extends Base implements InvoiceInterface
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

    /** @var double */
    private $amount;
    /** @var double */
    private $balance;
    /** @var int */
    private $clientId;
    /** @var int */
    private $invoiceStatusId;
    /** @var string */
    private $invoiceNumber;
    /** @var double */
    private $discount;
    /** @var string */
    private $poNumber;
    /** @var string */
    private $invoiceDate;
    /** @var string */
    private $dueDate;
    /** @var string */
    private $terms;
    /** @var string */
    private $publicNotes;
    /** @var int */
    private $invoiceTypeId;
    /** @var bool */
    private $isRecurring;
    /** @var  int */
    private $frequencyId;
    /** @var  string */
    private $startDate;
    /** @var  string */
    private $endDate;
    /** @var  string */
    private $lastSentDate;
    /** @var  int */
    private $recurringInvoiceId;
    /** @var  string */
    private $taxName1;
    /** @var  double */
    private $taxRate1;
    /** @var  string */
    private $taxName2;
    /** @var  double */
    private $taxRate2;
    /** @var  bool */
    private $isAmountDiscount;
    /** @var  string */
    private $invoiceFooter;
    /** @var  double */
    private $partial;
    /** @var  bool */
    private $hasTasks;
    /** @var  bool */
    private $autoBill;
    /** @var  int */
    private $customValue1;
    /** @var  int */
    private $customValue2;
    /** @var  bool */
    private $customTaxes1;
    /** @var  bool */
    private $customTaxes2;
    /** @var  bool */
    private $hasExpenses;
    /** @var  int */
    private $quoteInvoiceId;
    /** @var  string */
    private $customTextValue1;
    /** @var  string */
    private $customTextValue2;
    /** @var  bool */
    private $isQuote;
    /** @var  bool */
    private $isPublic;
    /** @var  InvoiceItem[] */
    private $invoiceItems;

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
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
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return int
     */
    public function getInvoiceStatusId()
    {
        return $this->invoiceStatusId;
    }

    /**
     * @param int $invoiceStatusId
     */
    public function setInvoiceStatusId($invoiceStatusId)
    {
        $this->invoiceStatusId = $invoiceStatusId;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * @param string $invoiceNumber
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @return float
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return string
     */
    public function getPoNumber()
    {
        return $this->poNumber;
    }

    /**
     * @param string $poNumber
     */
    public function setPoNumber($poNumber)
    {
        $this->poNumber = $poNumber;
    }

    /**
     * @return string
     */
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * @param string $invoiceDate
     */
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;
    }

    /**
     * @return string
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param string $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return string
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @param string $terms
     */
    public function setTerms($terms)
    {
        $this->terms = $terms;
    }

    /**
     * @return string
     */
    public function getPublicNotes()
    {
        return $this->publicNotes;
    }

    /**
     * @param string $publicNotes
     */
    public function setPublicNotes($publicNotes)
    {
        $this->publicNotes = $publicNotes;
    }

    /**
     * @return int
     */
    public function getInvoiceTypeId()
    {
        return $this->invoiceTypeId;
    }

    /**
     * @param int $invoiceTypeId
     */
    public function setInvoiceTypeId($invoiceTypeId)
    {
        $this->invoiceTypeId = $invoiceTypeId;
    }

    /**
     * @return bool
     */
    public function isRecurring()
    {
        return $this->isRecurring;
    }

    /**
     * @param bool $isRecurring
     */
    public function setRecurring($isRecurring)
    {
        $this->isRecurring = $isRecurring;
    }

    /**
     * @return int
     */
    public function getFrequencyId()
    {
        return $this->frequencyId;
    }

    /**
     * @param int $frequencyId
     */
    public function setFrequencyId($frequencyId)
    {
        $this->frequencyId = $frequencyId;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param string $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param string $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return string
     */
    public function getLastSentDate()
    {
        return $this->lastSentDate;
    }

    /**
     * @param string $lastSentDate
     */
    public function setLastSentDate($lastSentDate)
    {
        $this->lastSentDate = $lastSentDate;
    }

    /**
     * @return int
     */
    public function getRecurringInvoiceId()
    {
        return $this->recurringInvoiceId;
    }

    /**
     * @param int $recurringInvoiceId
     */
    public function setRecurringInvoiceId($recurringInvoiceId)
    {
        $this->recurringInvoiceId = $recurringInvoiceId;
    }

    /**
     * @return string
     */
    public function getTaxName1()
    {
        return $this->taxName1;
    }

    /**
     * @param string $taxName1
     */
    public function setTaxName1($taxName1)
    {
        $this->taxName1 = $taxName1;
    }

    /**
     * @return float
     */
    public function getTaxRate1()
    {
        return $this->taxRate1;
    }

    /**
     * @param float $taxRate1
     */
    public function setTaxRate1($taxRate1)
    {
        $this->taxRate1 = $taxRate1;
    }

    /**
     * @return string
     */
    public function getTaxName2()
    {
        return $this->taxName2;
    }

    /**
     * @param string $taxName2
     */
    public function setTaxName2($taxName2)
    {
        $this->taxName2 = $taxName2;
    }

    /**
     * @return float
     */
    public function getTaxRate2()
    {
        return $this->taxRate2;
    }

    /**
     * @param float $taxRate2
     */
    public function setTaxRate2($taxRate2)
    {
        $this->taxRate2 = $taxRate2;
    }

    /**
     * @return bool
     */
    public function isAmountDiscount()
    {
        return $this->isAmountDiscount;
    }

    /**
     * @param bool $isAmountDiscount
     */
    public function setAmountDiscount($isAmountDiscount)
    {
        $this->isAmountDiscount = $isAmountDiscount;
    }

    /**
     * @return string
     */
    public function getInvoiceFooter()
    {
        return $this->invoiceFooter;
    }

    /**
     * @param string $invoiceFooter
     */
    public function setInvoiceFooter($invoiceFooter)
    {
        $this->invoiceFooter = $invoiceFooter;
    }

    /**
     * @return float
     */
    public function getPartial()
    {
        return $this->partial;
    }

    /**
     * @param float $partial
     */
    public function setPartial($partial)
    {
        $this->partial = $partial;
    }

    /**
     * @return bool
     */
    public function hasTasks()
    {
        return $this->hasTasks;
    }

    /**
     * @param bool $hasTasks
     */
    public function setHasTasks($hasTasks)
    {
        $this->hasTasks = $hasTasks;
    }

    /**
     * @return bool
     */
    public function isAutoBill()
    {
        return $this->autoBill;
    }

    /**
     * @param bool $autoBill
     */
    public function setAutoBill($autoBill)
    {
        $this->autoBill = $autoBill;
    }

    /**
     * @return int
     */
    public function getCustomValue1()
    {
        return $this->customValue1;
    }

    /**
     * @param int $customValue1
     */
    public function setCustomValue1($customValue1)
    {
        $this->customValue1 = $customValue1;
    }

    /**
     * @return int
     */
    public function getCustomValue2()
    {
        return $this->customValue2;
    }

    /**
     * @param int $customValue2
     */
    public function setCustomValue2($customValue2)
    {
        $this->customValue2 = $customValue2;
    }

    /**
     * @return bool
     */
    public function isCustomTaxes1()
    {
        return $this->customTaxes1;
    }

    /**
     * @param bool $customTaxes1
     */
    public function setCustomTaxes1($customTaxes1)
    {
        $this->customTaxes1 = $customTaxes1;
    }

    /**
     * @return bool
     */
    public function isCustomTaxes2()
    {
        return $this->customTaxes2;
    }

    /**
     * @param bool $customTaxes2
     */
    public function setCustomTaxes2($customTaxes2)
    {
        $this->customTaxes2 = $customTaxes2;
    }

    /**
     * @return bool
     */
    public function hasExpenses()
    {
        return $this->hasExpenses;
    }

    /**
     * @param bool $hasExpenses
     */
    public function setHasExpenses($hasExpenses)
    {
        $this->hasExpenses = $hasExpenses;
    }

    /**
     * @return int
     */
    public function getQuoteInvoiceId()
    {
        return $this->quoteInvoiceId;
    }

    /**
     * @param int $quoteInvoiceId
     */
    public function setQuoteInvoiceId($quoteInvoiceId)
    {
        $this->quoteInvoiceId = $quoteInvoiceId;
    }

    /**
     * @return string
     */
    public function getCustomTextValue1()
    {
        return $this->customTextValue1;
    }

    /**
     * @param string $customTextValue1
     */
    public function setCustomTextValue1($customTextValue1)
    {
        $this->customTextValue1 = $customTextValue1;
    }

    /**
     * @return string
     */
    public function getCustomTextValue2()
    {
        return $this->customTextValue2;
    }

    /**
     * @param string $customTextValue2
     */
    public function setCustomTextValue2($customTextValue2)
    {
        $this->customTextValue2 = $customTextValue2;
    }

    /**
     * @return bool
     */
    public function isQuote()
    {
        return $this->isQuote;
    }

    /**
     * @param bool $isQuote
     */
    public function setQuote($isQuote)
    {
        $this->isQuote = $isQuote;
    }

    /**
     * @return bool
     */
    public function isPublic()
    {
        return $this->isPublic;
    }

    /**
     * @param bool $isPublic
     */
    public function setPublic($isPublic)
    {
        $this->isPublic = $isPublic;
    }

    /**
     * @return InvoiceItem[]
     */
    public function getInvoiceItems()
    {
        return $this->invoiceItems;
    }

    /**
     * @param InvoiceItem[] $invoiceItems
     */
    public function setInvoiceItems($invoiceItems)
    {
        $this->invoiceItems = $invoiceItems;
    }
}
