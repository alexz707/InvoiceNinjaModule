<?php
declare(strict_types=1);

namespace InvoiceNinjaModule\Options;

use InvoiceNinjaModule\Options\Interfaces\RequestOptionsInterface;

/**
 * Class RequestOptions
 */
final class RequestOptions implements RequestOptionsInterface
{
    private string $paramPageSize = 'per_page';
    private string $paramPage = 'page';
    private string $paramClientId='client_id';
    private string $paramUpdated='updated_at';
    private string $paramInclude='include';
    private array $additionalGetParams = [];
    private array $additionalPostParams = [];

/*
include: A comma-separated list of nested relationships to include.
updated_at: Timestamp used as a filter to only show recently updated records.
*/

    /**
     * @param array $params
     */
    public function addQueryParameters(array $params) :void
    {
        $this->additionalGetParams = \array_merge($params, $this->additionalGetParams);
    }

    /**
     * @param array $params
     */
    public function addPostParameters(array $params) :void
    {
        $this->additionalPostParams = \array_merge($params, $this->additionalPostParams);
    }

    /**
     * @return array
     */
    public function getQueryArray() :array
    {
        return $this->additionalGetParams;
    }

    /**
     * @return array
     */
    public function getPostArray() :array
    {
        return $this->additionalPostParams;
    }


    /**
     * @param int $pageSize
     */
    public function setPageSize(int $pageSize) :void
    {
        $this->additionalGetParams[$this->paramPageSize] = $pageSize;
    }


    /**
     * @param int $page
     */
    public function setPage(int $page) :void
    {
        $this->additionalGetParams[$this->paramPage] = $page;
    }

    /**
     * @param int $clientId
     */
    public function setClientId(int $clientId) :void
    {
        $this->additionalGetParams[$this->paramClientId] = $clientId;
    }

    /**
     * @param int $updated
     */
    public function setUpdated(int $updated) :void
    {
        $this->additionalGetParams[$this->paramUpdated] = $updated;
    }

    /**
     * @param string $include
     */
    public function setInclude(string $include) :void
    {
        $this->additionalGetParams[$this->paramInclude] = $include;
    }
}
