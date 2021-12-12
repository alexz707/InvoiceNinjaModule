<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Model\Interfaces;

use DateTimeInterface;

interface InvitationInterface extends BaseInterface
{
    /**
     * @return string
     */
    public function getClientContactId() : string;

    /**
     * @param string $clientContactId
     */
    public function setClientContactId(string $clientContactId) : void;

    /**
     * @return string
     */
    public function getKey() : string;

    /**
     * @param string $key
     */
    public function setKey(string $key) : void;

    /**
     * @return string
     */
    public function getLink() : string;

    /**
     * @param string $link
     */
    public function setLink(string $link) : void;

    /**
     * @return DateTimeInterface
     */
    public function getSentDate() : DateTimeInterface;

    /**
     * @param DateTimeInterface $sentDate
     */
    public function setSentDate(DateTimeInterface $sentDate) : void;

    /**
     * @return DateTimeInterface
     */
    public function getViewedDate() : DateTimeInterface;

    /**
     * @param DateTimeInterface $viewedDate
     */
    public function setViewedDate(DateTimeInterface $viewedDate) : void;

    /**
     * @return DateTimeInterface
     */
    public function getOpenedDate() : DateTimeInterface;

    /**
     * @param DateTimeInterface $openedDate
     */
    public function setOpenedDate(DateTimeInterface $openedDate) : void;

    /**
     * @return string
     */
    public function getEmailStatus() : string;

    /**
     * @param string $emailStatus
     */
    public function setEmailStatus(string $emailStatus) : void;

    /**
     * @return string
     */
    public function getEmailError() : string;

    /**
     * @param string $emailError
     */
    public function setEmailError(string $emailError) : void;
}
