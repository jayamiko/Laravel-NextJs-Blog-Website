<?php

namespace App\GraphQL\Mutations;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Facades\Log;

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
        Log::info('UpdatePost called', ['args' => $args]);

        $post = Post::findOrFail($args['id']);
        Log::info('Post found', ['post_id' => $post->id, 'post_user_id' => $post->id_user]);

        $currentUserId = auth()->id();
        Log::info('Current Auth User ID', ['auth_user_id' => $currentUserId]);

        // Cek apakah user yang login adalah pembuat post
        if ($post->id_user !== $currentUserId) {
            Log::warning('Access denied on update', [
                'post_user_id' => $post->id_user,
                'auth_user_id' => $currentUserId
            ]);
            throw new \Exception('Access denied: You are not allowed to update this post');
        }

        if (isset($args['title'])) {
            Log::info('Updating title', ['new_title' => $args['title']]);
            $post->title = $args['title'];
        }
        if (isset($args['content'])) {
            Log::info('Updating content', ['new_content' => $args['content']]);
            $post->content = $args['content'];
        }

        $post->save();
        Log::info('Post updated successfully', ['post_id' => $post->id]);

        return $post;
    }
}