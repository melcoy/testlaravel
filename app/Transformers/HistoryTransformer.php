<?php

namespace App\Transformers;

use App\History;
use Leauge\Fractal\TransformerAbstract;

class HistoryTransformer extends TransformerAbstract
{
	public function transform(Post $post)
	{
		return[
			'id'		=>$post->id,
			'history' 	=>$post->history,
			'published' =>$post->created_at->diffForHumans(),
		];
	}
}