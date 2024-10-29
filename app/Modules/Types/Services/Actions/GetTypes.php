<?php

namespace App\Modules\Types\Services\Actions;

use App\Models\Type;
use App\Modules\Types\DTO\FilterDTO;

readonly class GetTypes
{
    /**
     * @return FilterDTO[]
     */
    public function execute(): array
    {
        return Type::query()
            ->orderBy('name')
            ->get()
            ->map(function (Type $type) {
                return new FilterDTO($type->name, $type->id);
            })
            ->toArray();
    }
}
