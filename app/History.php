<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class History extends Model
{
    protected $fillable = [
    	'user_id','history',

    ];

    public function user()
    {
    	return $this->belongsTo(User::class);	
    }
}
