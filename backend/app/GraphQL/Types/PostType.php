<?php

namespace App\GraphQL\Types;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'A post',
        'model' => Post::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the post',
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of the post',
            ],
            'content' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The content of the post',
            ],
            'id_user' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id_user of the post',
            ],
            'created_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The created at of the post',
            ],
            'updated_at' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The updated at of the post',
            ],
        ];
    }
}