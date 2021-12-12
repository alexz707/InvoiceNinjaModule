<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use DateTime;
use DateTimeInterface;
use InvoiceNinjaModule\Model\Interfaces\InvitationInterface;

class Invitation extends Base implements InvitationInterface
{
    private string $clientContactId = '';
    private string $key = '';
    private string $link = '';
    private string $sentDate = '';
    private string $viewedDate = '';
    private string $openedDate = '';
    private string $emailStatus = '';
    private string $emailError = '';

    /**
     * @return string
     */
    public function getClientContactId() : string
    {
        return $this->clientContactId;
    }

    /**
     * @param string $clientContactId
     */
    public function setClientContactId(string $clientContactId) : void
    {
        $this->clientContactId = $clientContactId;
    }

    /**
     * @return string
     */
    public function getKey() : string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key) : void
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getLink() : string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link) : void
    {
        $this->link = $link;
    }

    /**
     * @return DateTimeInterface
     */
    public function getSentDate() : DateTimeInterface
    {
        return DateTime::createFromFormat('Y-m-d H:i:s', $this->sentDate);
    }

    /**
     * @param DateTimeInterface $sentDate
     */
    public function setSentDate(DateTimeInterface $sentDate) : void
    {
        $this->sentDate = $sentDate->format('Y-m-d H:i:s');
    }

    /**
     * @return DateTimeInterface
     */
    public function getViewedDate() : DateTimeInterface
    {
        return DateTime::createFromFormat('Y-m-d H:i:s', $this->viewedDate);
    }

    /**
     * @param DateTimeInterface $viewedDate
     */
    public function setViewedDate(DateTimeInterface $viewedDate) : void
    {
        $this->viewedDate = $viewedDate->format('Y-m-d H:i:s');
    }

    /**
     * @return DateTimeInterface
     */
    public function getOpenedDate() : DateTimeInterface
    {
        return DateTime::createFromFormat('Y-m-d H:i:s', $this->openedDate);
    }

    /**
     * @param DateTimeInterface $openedDate
     */
    public function setOpenedDate(DateTimeInterface $openedDate) : void
    {
        $this->openedDate = $openedDate->format('Y-m-d H:i:s');
    }

    /**
     * @return string
     */
    public function getEmailStatus() : string
    {
        return $this->emailStatus;
    }

    /**
     * @param string $emailStatus
     */
    public function setEmailStatus(string $emailStatus) : void
    {
        $this->emailStatus = $emailStatus;
    }

    /**
     * @return string
     */
    public function getEmailError() : string
    {
        return $this->emailError;
    }

    /**
     * @param string $emailError
     */
    public function setEmailError(string $emailError) : void
    {
        $this->emailError = $emailError;
    }
}