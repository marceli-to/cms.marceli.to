<?php

namespace App\Http\Controllers\Api;

use App\Actions\Post\DeletePostAction;
use App\Actions\Post\StorePostAction;
use App\Actions\Post\UpdatePostAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
	public function index()
	{
		$posts = Post::orderBy('created_at', 'desc')->get();

		return PostResource::collection($posts);
	}

	public function store(StorePostRequest $request, StorePostAction $action)
	{
		$post = $action->execute($request->validated());

		return new PostResource($post);
	}

	public function show(Post $post)
	{
		return new PostResource($post);
	}

	public function update(UpdatePostRequest $request, Post $post, UpdatePostAction $action)
	{
		$post = $action->execute($post, $request->validated());

		return new PostResource($post);
	}

	public function destroy(Post $post, DeletePostAction $action)
	{
		$action->execute($post);

		return response()->json(null, 204);
	}
}
