<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Str;

class StorePostAction
{
	public function execute(array $data): Post
	{
		$data['slug'] = Str::slug($data['title']);

		return Post::create($data);
	}
}
