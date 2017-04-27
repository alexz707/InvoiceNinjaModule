<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\BaseInterface;

/**
 * Class Base
 */
class Base implements BaseInterface
{
    /** @var  int */
    protected $id = 0;
    /** @var  string */
    protected $accountKey = '';
    /** @var  bool */
    protected $isOwner = false;
    /** @var  int */
    protected $updatedAt;
    /** @var  int */
    protected $archivedAt;
    /** @var  bool */
    protected $isDeleted = false;

    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAccountKey() :string
    {
        return $this->accountKey;
    }

    /**
     * @return bool
     */
    public function isOwner() :bool
    {
        return $this->isOwner;
    }

    /**
     * @return int
     */
    public function getUpdatedAt() :?int
    {
        return $this->updatedAt;
    }

    /**
     * @return int
     */
    public function getArchivedAt() :?int
    {
        return $this->archivedAt;
    }

    /**
     * @return bool
     */
    public function isDeleted() : bool
    {
        return $this->isDeleted;
    }
}
