<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

trait JsonSerializeTrait
{
    public function jsonSerialize(): array
    {
        $vars = get_object_vars($this);

        return array_filter($vars, function ($value) {
            return null !== $value;
        });
    }
}
