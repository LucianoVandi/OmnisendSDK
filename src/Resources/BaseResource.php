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

    /**
     * Return an array of valid filters to include as query params for list operations
     *
     * @param array $filters
     * @return array
     * @throws \Exception
     */
    protected function applyListFilters(array $filters): array
    {
        $validFilters = [];

        if (! isset($this->listFilters)) {
            throw new \Exception('This resource does not implement list filters');
        }

        foreach ($filters as $filterKey => $filterValue) {
            if (! in_array($filterKey, $this->listFilters)) {
                continue;
            }

            $validFilters[$filterKey] = $filterValue;
        }

        return $validFilters;
    }
}
