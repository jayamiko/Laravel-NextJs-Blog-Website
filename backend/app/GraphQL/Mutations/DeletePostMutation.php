<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class DeletePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deletePost',
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::boolean()); 
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()), 
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $post = Post::findOrFail($args['id']);

        $post->delete();

        return true;
    }
}