<?php

namespace App\Modules\Types\DTO;

readonly class FilterDTO
{
    public function __construct(
        public string     $label,
        public string|int $value,
    )
    {
    }

}
