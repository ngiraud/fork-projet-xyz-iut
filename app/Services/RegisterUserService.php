<?php

namespace App\Services;

use App\Models\Code;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class RegisterUserService
{
    public function execute(array $data, Code $code)
    {
        $user = User::create([
            'name' => Arr::get($data, 'name'),
            'email' => Arr::get($data, 'email'),
            'password' => Hash::make(Arr::get($data, 'password')),
        ]);

        $code->markAsUsed($user);

        return $user;
    }
}
