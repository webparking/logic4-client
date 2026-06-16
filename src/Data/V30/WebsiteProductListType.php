<?php

declare(strict_types=1);

namespace Webparking\Logic4Client\Data\V30;

class WebsiteProductListType
{
    public function __construct()
    {
    }

    /** @param array<mixed> $data */
    public static function make(array $data): self
    {
        return new self(
        );
    }
}
