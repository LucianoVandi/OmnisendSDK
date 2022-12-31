<?php

namespace Lvandi\OmnisendSDK\DTO;

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
