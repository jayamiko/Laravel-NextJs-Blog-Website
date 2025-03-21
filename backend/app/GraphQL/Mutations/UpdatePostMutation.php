<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UpdatePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updatePost',
    ];

    public function type(): Type
    {
        return GraphQL::type('Post');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()), 
            ],
            'title' => [
                'name' => 'title',
                'type' => Type::string(), 
            ],
            'content' => [
                'name' => 'content',
                'type' => Type::string(), 
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $post = Post::findOrFail($args['id']);

        if (isset($args['title'])) {
            $post->title = $args['title'];
        }
        if (isset($args['content'])) {
            $post->content = $args['content'];
        }

        $post->save();

        return $post;
    }
}