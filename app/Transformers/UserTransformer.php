<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;
use App\Transformers\PostTransformer;
use App\Transformers\HistoryTransformer;


class UserTransformer extends TransformerAbstract
{
	protected $availableIncludes =[
		'posts'
		//,'historys'
	];
	public function transform(User $user)
	{
		return[
			'name' 		=>$user->name,
			'priority'	=>$user->priority,
			'location' 	=>$user->location,
			'username' 	=>$user->username,
			'registered' => $user->created_at->diffForHumans(),
		];
	}

	public function includePosts(User $user)
	{

		$posts = $user->posts()->latestFirst()->get();

		return $this->collection($posts,new PostTransformer);
	}

	 public function includeHistorys(User $user)
	 {

	 	$historys= $user->historys()->LatestFirst()->get();

	 	return $this->collection($historys,new HistoryTransformer);
	 }
}