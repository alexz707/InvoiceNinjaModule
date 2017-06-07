<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\InvoiceInterface;

/**
 * Class Invoice
 * @codeCoverageIgnore
 */
final class Invoice extends Base implements InvoiceInterface
{
    /** @var float */
    private $amount = 0;
    /** @var float */
    private $balance = 0;
    /** @var int */
    private $clientId = 0;
    /** @var int */
    private $invoiceStatusId = InvoiceInterface::STATUS_DRAFT;
    /** @var string */
    private $invoiceNumber = '';
    /** @var float */
    private $discount = 0;
    /** @var string */
    private $poNumber = '';
    /** @var string */
    private $invoiceDate = '';
    /** @var string */
    private $dueDate = '';
    /** @var string */
    private $terms = '';
    /** @var string */
    private $publicNotes = '';
    /** @var int */
    private $invoiceTypeId = 0;
    /** @var bool */
    private $isRecurring = false;
    /** @var  int */
    private $frequencyId = 0;
    /** @var  string */
    private $startDate;
    /** @var  string */
    private $endDate;
    /** @var  string */
    private $lastSentDate;
    /** @var  int */
    private $recurringInvoiceId = 0;
    /** @var  string */
    private $taxName1 = '';
    /** @var  float */
    private $taxRate1 = 0;
    /** @var  string */
    private $taxName2 = '';
    /** @var  float */
    private $taxRate2 = 0;
    /** @var  bool */
    private $isAmountDiscount;
    /** @var  string */
    private $invoiceFooter = '';
    /** @var  float */
    private $partial = 0;
    /** @var  bool */
    private $hasTasks = false;
    /** @var  bool */
    private $autoBill = false;
    /** @var  int */
    private $customValue1;
    /** @var  int */
    private $customValue2;
    /** @var  bool */
    private $customTaxes1 = false;
    /** @var  bool */
    private $customTaxes2 = false;
    /** @var  bool */
    private $hasExpenses = false;
    /** @var  int */
    private $quoteInvoiceId = 0;
    /** @var  string */
    private $customTextValue1;
    /** @var  string */
    private $customTextValue2;
    /** @var  bool */
    private $isQuote = false;
    /** @var  bool */
    private $isPublic = false;
    /** @var  InvoiceItem[] */
    private $invoiceItems;

    /**
     * @return float
     */
    public function getAmount() : float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount(float $amount) : void
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function getBalance() : float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance(float $balance) : void
    {
        $this->balance = $balance;
    }

    /**
     * @return int
     */
    public function getClientId() : int
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     */
    public function setClientId(int $clientId) : void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return int
     */
    public function getInvoiceStatusId() : int
    {
        return $this->invoiceStatusId;
    }

    /**
     * @param int $invoiceStatusId
     */
    public function setInvoiceStatusId(int $invoiceStatusId) : void
    {
        $this->invoiceStatusId = $invoiceStatusId;
    }

    /**
     * @return string
     */
    public function getInvoiceNumber() : string
    {
        return $this->invoiceNumber;
    }

    /**
     * @param string $invoiceNumber
     */
    public function setInvoiceNumber(string $invoiceNumber) : void
    {
        $this->invoiceNumber = $invoiceNumber;
    }

    /**
     * @return float
     */
    public function getDiscount() : float
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount) : void
    {
        $this->discount = $discount;
    }

    /**
     * @return string
     */
    public function getPoNumber() : string
    {
        return $this->poNumber;
    }

    /**
     * @param string $poNumber
     */
    public function setPoNumber(string $poNumber) : void
    {
        $this->poNumber = $poNumber;
    }

    /**
     * @return \DateTime
     */
    public function getInvoiceDate() : \DateTime
    {
        return \DateTime::createFromFormat('Y-m-d', $this->invoiceDate);
    }

    /**
     * @param \DateTime $invoiceDate
     */
    public function setInvoiceDate(\DateTime $invoiceDate) : void
    {
        $this->invoiceDate = $invoiceDate->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getDueDate() : string
    {
        return $this->dueDate;
    }

    /**
     * @param string $dueDate
     */
    public function setDueDate(string $dueDate) : void
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return string
     */
    public function getTerms() : string
    {
        return $this->terms;
    }

    /**
     * @param string $terms
     */
    public function setTerms(string $terms) : void
    {
        $this->terms = $terms;
    }

    /**
     * @return string
     */
    public function getPublicNotes() : string
    {
        return $this->publicNotes;
    }

    /**
     * @param string $publicNotes
     */
    public function setPublicNotes(string $publicNotes) : void
    {
        $this->publicNotes = $publicNotes;
    }

    /**
     * @return int
     */
    public function getInvoiceTypeId() : int
    {
        return $this->invoiceTypeId;
    }

    /**
     * @param int $invoiceTypeId
     */
    public function setInvoiceTypeId(int $invoiceTypeId) : void
    {
        $this->invoiceTypeId = $invoiceTypeId;
    }

    /**
     * @return bool
     */
    public function isRecurring() : bool
    {
        return $this->isRecurring;
    }

    /**
     * @param bool $isRecurring
     */
    public function setRecurring(bool $isRecurring) : void
    {
        $this->isRecurring = $isRecurring;
    }

    /**
     * @return int
     */
    public function getFrequencyId() : int
    {
        return $this->frequencyId;
    }

    /**
     * @param int $frequencyId
     */
    public function setFrequencyId(int $frequencyId) : void
    {
        $this->frequencyId = $frequencyId;
    }

    /**
     * @return string
     */
    public function getStartDate() : string
    {
        return $this->startDate;
    }

    /**
     * @param string $startDate
     */
    public function setStartDate(string $startDate) : void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return string
     */
    public function getEndDate() : string
    {
        return $this->endDate;
    }

    /**
     * @param string $endDate
     */
    public function setEndDate(string $endDate) : void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return string
     */
    public function getLastSentDate() : string
    {
        return $this->lastSentDate;
    }

    /**
     * @param string $lastSentDate
     */
    public function setLastSentDate(string $lastSentDate) : void
    {
        $this->lastSentDate = $lastSentDate;
    }

    /**
     * @return int
     */
    public function getRecurringInvoiceId() : int
    {
        return $this->recurringInvoiceId;
    }

    /**
     * @param int $recurringInvoiceId
     */
    public function setRecurringInvoiceId(int $recurringInvoiceId) : void
    {
        $this->recurringInvoiceId = $recurringInvoiceId;
    }

    /**
     * @return string
     */
    public function getTaxName1() : string
    {
        return $this->taxName1;
    }

    /**
     * @param string $taxName1
     */
    public function setTaxName1(string $taxName1) : void
    {
        $this->taxName1 = $taxName1;
    }

    /**
     * @return float
     */
    public function getTaxRate1() : float
    {
        return $this->taxRate1;
    }

    /**
     * @param float $taxRate1
     */
    public function setTaxRate1(float $taxRate1) : void
    {
        $this->taxRate1 = $taxRate1;
    }

    /**
     * @return string
     */
    public function getTaxName2() : string
    {
        return $this->taxName2;
    }

    /**
     * @param string $taxName2
     */
    public function setTaxName2(string $taxName2) : void
    {
        $this->taxName2 = $taxName2;
    }

    /**
     * @return float
     */
    public function getTaxRate2() : float
    {
        return $this->taxRate2;
    }

    /**
     * @param float $taxRate2
     */
    public function setTaxRate2(float $taxRate2) : void
    {
        $this->taxRate2 = $taxRate2;
    }

    /**
     * @return bool
     */
    public function isAmountDiscount() : bool
    {
        return $this->isAmountDiscount;
    }

    /**
     * @param bool $isAmountDiscount
     */
    public function setAmountDiscount(bool $isAmountDiscount) : void
    {
        $this->isAmountDiscount = $isAmountDiscount;
    }

    /**
     * @return string
     */
    public function getInvoiceFooter() : string
    {
        return $this->invoiceFooter;
    }

    /**
     * @param string $invoiceFooter
     */
    public function setInvoiceFooter(string $invoiceFooter) : void
    {
        $this->invoiceFooter = $invoiceFooter;
    }

    /**
     * @return float
     */
    public function getPartial() : float
    {
        return $this->partial;
    }

    /**
     * @param float $partial
     */
    public function setPartial(float $partial) : void
    {
        $this->partial = $partial;
    }

    /**
     * @return bool
     */
    public function hasTasks() : bool
    {
        return $this->hasTasks;
    }

    /**
     * @param bool $hasTasks
     */
    public function setHasTasks(bool $hasTasks) : void
    {
        $this->hasTasks = $hasTasks;
    }

    /**
     * @return bool
     */
    public function isAutoBill() : bool
    {
        return $this->autoBill;
    }

    /**
     * @param bool $autoBill
     */
    public function setAutoBill(bool $autoBill) : void
    {
        $this->autoBill = $autoBill;
    }

    /**
     * @return int
     */
    public function getCustomValue1() : int
    {
        return $this->customValue1;
    }

    /**
     * @param int $customValue1
     */
    public function setCustomValue1(int $customValue1) : void
    {
        $this->customValue1 = $customValue1;
    }

    /**
     * @return int
     */
    public function getCustomValue2() : int
    {
        return $this->customValue2;
    }

    /**
     * @param int $customValue2
     */
    public function setCustomValue2(int $customValue2) : void
    {
        $this->customValue2 = $customValue2;
    }

    /**
     * @return bool
     */
    public function isCustomTaxes1() : bool
    {
        return $this->customTaxes1;
    }

    /**
     * @param bool $customTaxes1
     */
    public function setCustomTaxes1(bool $customTaxes1) : void
    {
        $this->customTaxes1 = $customTaxes1;
    }

    /**
     * @return bool
     */
    public function isCustomTaxes2() : bool
    {
        return $this->customTaxes2;
    }

    /**
     * @param bool $customTaxes2
     */
    public function setCustomTaxes2(bool $customTaxes2) : void
    {
        $this->customTaxes2 = $customTaxes2;
    }

    /**
     * @return bool
     */
    public function hasExpenses() : bool
    {
        return $this->hasExpenses;
    }

    /**
     * @param bool $hasExpenses
     */
    public function setHasExpenses(bool $hasExpenses) : void
    {
        $this->hasExpenses = $hasExpenses;
    }

    /**
     * @return int
     */
    public function getQuoteInvoiceId() : int
    {
        return $this->quoteInvoiceId;
    }

    /**
     * @param int $quoteInvoiceId
     */
    public function setQuoteInvoiceId(int $quoteInvoiceId) : void
    {
        $this->quoteInvoiceId = $quoteInvoiceId;
    }

    /**
     * @return string
     */
    public function getCustomTextValue1() : string
    {
        return $this->customTextValue1;
    }

    /**
     * @param string $customTextValue1
     */
    public function setCustomTextValue1(string $customTextValue1) : void
    {
        $this->customTextValue1 = $customTextValue1;
    }

    /**
     * @return string
     */
    public function getCustomTextValue2() : string
    {
        return $this->customTextValue2;
    }

    /**
     * @param string $customTextValue2
     */
    public function setCustomTextValue2(string $customTextValue2) : void
    {
        $this->customTextValue2 = $customTextValue2;
    }

    /**
     * @return bool
     */
    public function isQuote() : bool
    {
        return $this->isQuote;
    }

    /**
     * @param bool $isQuote
     */
    public function setQuote(bool $isQuote) : void
    {
        $this->isQuote = $isQuote;
    }

    /**
     * @return bool
     */
    public function isPublic() : bool
    {
        return $this->isPublic;
    }

    /**
     * @param bool $isPublic
     */
    public function setPublic(bool $isPublic) : void
    {
        $this->isPublic = $isPublic;
    }

    /**
     * @return InvoiceItem[]
     */
    public function getInvoiceItems() : array
    {
        return $this->invoiceItems;
    }

    /**
     * @param InvoiceItem[] $invoiceItems
     */
    public function setInvoiceItems(array $invoiceItems) : void
    {
        $this->invoiceItems = $invoiceItems;
    }
}
