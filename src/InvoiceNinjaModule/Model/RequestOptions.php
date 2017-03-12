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
    /** @var  int */
    private $pageSize = 0;
    /** @var string  */
    private $paramPageSize = 'per_page';

    /** @var  int */
    private $page = 0;
    /** @var string  */
    private $paramPage = 'page';

    /** @var  int */
    private $clientId;
    /** @var string  */
    private $paramClientId='client_id';

    /** @var  int */
    private $updated;
    /** @var string  */
    private $paramUpdated='updated_at';

    /** @var array */
    private $include;
    /** @var string  */
    private $paramInclude='include';
    /** @var array  */
    private $additionalParams = [];


/*
include: A comma-separated list of nested relationships to include.
updated_at: Timestamp used as a filter to only show recently updated records.
*/

    public function addQueryParameter($name, $value)
    {
        $this->additionalParams[$name] = $value;
    }

    public function getQueryString()
    {
        $result = array_merge(
            $this->buildPageArr(),
            $this->additionalParams
        );
        return http_build_query($result);
    }

    private function buildPageArr()
    {
        $result = [];
        $result[$this->paramPage] = $this->getPage();
        $result[$this->paramPageSize] = $this->getPageSize();
        return $result;
    }




    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * @param int $pageSize
     */
    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage($page)
    {
        $this->page = $page;
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
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param int $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * @return array
     */
    public function getInclude()
    {
        return $this->include;
    }

    /**
     * @param array $include
     */
    public function setInclude($include)
    {
        $this->include = $include;
    }
}
