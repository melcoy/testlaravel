<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;
//use App\History;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'priority', 'location','username','password','api_token',
    ];

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

     public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function ownsPost(Post $post)
    {
        return auth()->id()==$post->user->id;
    }

    //  public function historys()
    // {
    //     return $this->hasMany(History::class);
    // }
}
