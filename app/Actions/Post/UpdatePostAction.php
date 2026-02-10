<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Str;

class UpdatePostAction
{
	public function execute(Post $post, array $data): Post
	{
		$data['slug'] = Str::slug($data['title']);

		$post->update($data);

		return $post;
	}
}
