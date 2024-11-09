<?php

namespace App\Modules\Users\Services\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

readonly class RegisterUser
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    )
    {
    }

    public function execute(): array
    {
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return [
            'success' => true,
            'message' => 'Usuário cadastrado com sucesso!',
            'token' => $token
        ];
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->get('name'),
            $request->get('email'),
            $request->get('password')
        );
    }
}
