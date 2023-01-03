<?php

namespace Lvandi\OmnisendSDK\Resources;

use Lvandi\OmnisendSDK\DTO\Cart;
use Lvandi\OmnisendSDK\DTO\CartProduct;
use Lvandi\OmnisendSDK\Responses\CartResponse;
use Lvandi\OmnisendSDK\Responses\CartListResponse;
use Lvandi\OmnisendSDK\Responses\CartProductResponse;

class Campaigns extends BaseResource
{
    private string $endpoint = 'campaigns';

    protected array $listFilters = [
        'email',
        'phone',
        'contactID',
        'segmentID',
        'dateFrom',
        'dateTo',
        'updatedFrom',
        'updatedTo',
    ];

}
