<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\Contracts\HttpClient;
use Lvandi\OmnisendSDK\Exceptions\UnimplementedFiltersException;

abstract class BaseResource
{
    protected HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Return an array of valid filters to include as query params
     *
     * @param array $filters
     * @return array
     * @throws UnimplementedFiltersException
     */
    protected function applyFilters(array $filters): array
    {
        $callee = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];
        $calleeFiltersVarName = $callee.'Filters';

        if (! isset($this->$calleeFiltersVarName)) {
            throw new UnimplementedFiltersException('Resource does not define '.$calleeFiltersVarName.' array');
        }

        $validFilters = [];
        foreach ($filters as $filterKey => $filterValue) {
            if (! in_array($filterKey, $this->$calleeFiltersVarName)) {
                continue;
            }

            $validFilters[$filterKey] = $filterValue;
        }

        return $validFilters;
    }
}
