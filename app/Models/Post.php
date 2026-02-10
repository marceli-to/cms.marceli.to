<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillable = ['title', 'slug', 'content', 'publish'];

	protected $casts = [
		'publish' => 'boolean',
	];
}
