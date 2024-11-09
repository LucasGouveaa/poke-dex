<?php

namespace App\Modules\Users\DTO;

use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;

readonly class UserDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
    )
    {
    }

    public static function fromUser(User $user): self
    {
        return new self(
            $user->id,
            $user->name,
            $user->email
        );
    }
}
