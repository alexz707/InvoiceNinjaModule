<?php

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\BaseInterface;

class Base implements BaseInterface
{
    /** @var  int */
    protected $id;
    /** @var  string */
    protected $accountKey;
    /** @var  bool */
    protected $isOwner;
    /** @var  int */
    protected $updatedAt;
    /** @var  int */
    protected $archivedAt;
    /** @var  bool */
    protected $isDeleted;

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
