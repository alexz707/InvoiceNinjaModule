<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\BaseInterface;

/**
 * Class Base
 */
class Base implements BaseInterface
{
    protected string $id = '';
    protected int $updatedAt = 0;
    protected int $archivedAt = 0;
    protected int $createdAt = 0;
    /** @var  bool */
    protected $isDeleted = false;

    /**
     * @return string
     */
    public function getId() :string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUpdatedAt() :int
    {
        return $this->updatedAt;
    }

    /**
     * @return int
     */
    public function getArchivedAt() :int
    {
        return $this->archivedAt;
    }

    /**
     * @return int
     */
    public function getCreatedAt() :int
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
