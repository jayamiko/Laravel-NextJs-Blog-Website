<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Auth;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Log;

class Me extends Query
{
    protected $attributes = [
        'name' => 'me',
        'description' => 'Get the current authenticated user',
    ];

    public function type(): Type
    {
        return GraphQL::type('User'); 
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $token = request()->header('Authorization');
        Log::info($token);
        Log::info('Authorization Header: ' . $token);
        Log::info('auth: ' . json_encode(auth()));
        Log::info('Sanctum user: ' . json_encode(auth()->user()));
        
        return Auth::user();
    }
}