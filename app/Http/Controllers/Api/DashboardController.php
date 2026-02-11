<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
	public function index()
	{
		$posts = Post::all();
		$media = Media::all();

		$totalSize = $media->sum('size');

		$recentMedia = Media::orderByDesc('created_at')
			->limit(8)
			->get()
			->map(fn ($m) => [
				'uuid' => $m->uuid,
				'original_name' => $m->original_name,
				'thumbnail_url' => '/img/uploads/' . $m->file . '?w=200&h=200&fit=crop',
				'created_at' => $m->created_at,
			]);

		$recentPosts = Post::orderByDesc('created_at')
			->limit(5)
			->get()
			->map(fn ($p) => [
				'id' => $p->id,
				'title' => $p->title,
				'publish' => $p->publish,
				'created_at' => $p->created_at,
				'updated_at' => $p->updated_at,
			]);

		return response()->json([
			'stats' => [
				'posts_total' => $posts->count(),
				'posts_published' => $posts->where('publish', true)->count(),
				'posts_draft' => $posts->where('publish', false)->count(),
				'media_total' => $media->count(),
				'media_size' => $totalSize,
			],
			'recent_posts' => $recentPosts,
			'recent_media' => $recentMedia,
		]);
	}
}
