<?php

declare(strict_types=1);

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface ContactInterface
 */
interface ContactInterface extends BaseInterface
{
    /**
     * @return string
     */
    public function getFirstName(): string;

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void;

    /**
     * @return string
     */
    public function getLastName(): string;
    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void;

    /**
     * @return string
     */
    public function getEmail(): string;
    /**
     * @param string $email
     */
    public function setEmail(string $email): void;

    /**
     * @return bool
     */
    public function isPrimary(): bool;

    /**
     * @param bool $isPrimary
     */
    public function setPrimary(bool $isPrimary): void;

    /**
     * @return string
     */
    public function getPhone(): string;

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void;

    /**
     * @return int
     */
    public function getLastLogin(): int;

    /**
     * @return bool
     */
    public function isLocked(): bool;

    /**
     * @param bool $isLocked
     */
    public function setIsLocked(bool $isLocked): void;

    /**
     * @return string
     */
    public function getCustomValue1(): string;

    /**
     * @param string $customValue1
     */
    public function setCustomValue1(string $customValue1): void;
    /**
     * @return string
     */
    public function getCustomValue2(): string;
    /**
     * @param string $customValue2
     */
    public function setCustomValue2(string $customValue2): void;
    /**
     * @return string
     */
    public function getCustomValue3(): string;
    /**
     * @param string $customValue3
     */
    public function setCustomValue3(string $customValue3): void;
    /**
     * @return string
     */
    public function getCustomValue4(): string;

    /**
     * @param string $customValue4
     */
    public function setCustomValue4(string $customValue4): void;

    /**
     * @return string
     */
    public function getContactKey(): string;

    /**
     * @param string $contactKey
     */
    public function setContactKey(string $contactKey): void;

    /**
     * @return bool
     */
    public function isSendEmail(): bool;

    /**
     * @param bool $sendEmail
     */
    public function setSendEmail(bool $sendEmail): void;
}
