<?php

namespace InvoiceNinjaModule\Model;

use InvoiceNinjaModule\Model\Interfaces\RequestOptionsInterface;

/**
 * Class RequestOptions
 *
 * @package InvoiceNinjaModule\Model
 */
final class RequestOptions implements RequestOptionsInterface
{
    /** @var string  */
    private $paramPageSize = 'per_page';
    /** @var string  */
    private $paramPage = 'page';
    /** @var string  */
    private $paramClientId='client_id';
    /** @var string  */
    private $paramUpdated='updated_at';
    /** @var string  */
    private $paramInclude='include';
    /** @var array  */
    private $additionalGetParams;
    /** @var array  */
    private $additionalPostParams;

/*
include: A comma-separated list of nested relationships to include.
updated_at: Timestamp used as a filter to only show recently updated records.
*/
    public function __construct()
    {
        $this->additionalPostParams = [];
        $this->additionalGetParams = [];
    }

    /**
     * @param array $params
     */
    public function addQueryParameters(array $params)
    {
        $this->additionalGetParams = \array_merge($params, $this->additionalGetParams);
    }

    /**
     * @param array $params
     */
    public function addPostParameters(array $params)
    {
        $this->additionalPostParams = \array_merge($params, $this->additionalPostParams);
    }

    /**
     * @return array
     */
    public function getQueryArray()
    {
        return $this->additionalGetParams;
    }

    /**
     * @return array
     */
    public function getPostArray()
    {
        return $this->additionalPostParams;
    }


    /**
     * @param int $pageSize
     */
    public function setPageSize($pageSize)
    {
        $this->additionalGetParams[$this->paramPageSize] = $pageSize;
    }


    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->additionalGetParams[$this->paramPage] = $page;
    }

    /**
     * @param int $clientId
     */
    public function setClientId($clientId)
    {
        $this->additionalGetParams[$this->paramClientId] = $clientId;
    }

    /**
     * @param int $updated
     */
    public function setUpdated($updated)
    {
        $this->additionalGetParams[$this->paramUpdated] = $updated;
    }

    /**
     * @param array $include
     */
    public function setInclude($include)
    {
        $this->additionalGetParams[$this->paramInclude] = $include;
    }
}
