<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class AuthPayloadType extends GraphQLType
{
    protected $attributes = [
        'name' => 'AuthPayload',
        'description' => 'Authentication payload containing a token',
    ];

    public function fields(): array
    {
        return [
            'token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The authentication token',
            ],
        ];
    }
}