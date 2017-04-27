<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model\Interfaces;

/**
 * Interface BaseInterface
 */
interface BaseInterface
{
    /**
     * @return int
     */
    public function getId() :int;

    /**
     * @return string
     */
    public function getAccountKey() :string;

    /**
     * @return bool
     */
    public function isOwner() :bool;

    /**
     * @return int
     */
    public function getUpdatedAt() :?int;

    /**
     * @return int
     */
    public function getArchivedAt() :?int;

    /**
     * @return bool
     */
    public function isDeleted() :bool;
}
