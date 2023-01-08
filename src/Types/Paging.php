<?php

declare(strict_types=1);

namespace Lvandi\OmnisendSDK\Types;

use stdClass;

class Paging
{
    private ?string $previous;

    private ?string $next;

    private int $offset;

    private int $limit;

    public function __construct(stdClass $paging)
    {
        $this->previous = $paging->previous ?? null;
        $this->next = $paging->next ?? null;
        $this->offset = $paging->offset ?? 0;
        $this->limit = $paging->limit ?? 0;
    }

    /**
     * @return string|null
     */
    public function getPrevious(): ?string
    {
        return $this->previous;
    }

    /**
     * @return string|null
     */
    public function getNext(): ?string
    {
        return $this->next;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }
}
