<?php

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\Contracts\HttpClient;

abstract class BaseResource
{
    protected HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    protected function getFilters(array $filters): array
    {
        $queryParams = [];

        if (! isset($this->listFilters)) {
            throw new \Exception('This resource does not define list filters');
        }

        foreach ($filters as $filterKey => $filterValue) {
            if (! in_array($filterKey, $this->listFilters)) {
                continue;
            }

            $queryParams[$filterKey] = $filterValue;
        }

        return $queryParams;
    }
}
