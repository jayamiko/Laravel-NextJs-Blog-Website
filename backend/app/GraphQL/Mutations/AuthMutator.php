<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthMutator
{
    public function register($_, array $args)
    {
        $user = User::create([
            'name' => $args['name'],
            'email' => $args['email'],
            'password' => Hash::make($args['password']),
        ]);

        return $user;
    }

    public function login($_, array $args)
    {
        return "hello";
    }
}
