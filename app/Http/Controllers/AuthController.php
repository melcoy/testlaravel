<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Transformers\UserTransformer;
use Auth;
class AuthController extends Controller
{
    public function register(Request $request,User $user)
    {
    	$this->validate($request,[
    		'name' => 'required',
    		'priority'=> 'required',
    		'location' => 'required',
    		'username' => 'required|unique:users',
    		'password' => 'required|min:6',



    		]);

    	$user=$user->create([
    		'name' => $request->name,
    		'priority'=> $request->priority,
    		'location' => $request->location,
    		'username' => $request->username,
    		'password' => bcrypt($request->password),
    		'api_token' =>bcrypt($request->username)


    		]);

    	$response = fractal()
    	->item($user)//pake item karena single 1 item
    	->transformWith(new UserTransformer)
    	->addMeta([
    			'token' => $user->api_token,
    			])
    	->toArray();

    	return response()->json($response,201);



    } 

    public function login(Request $request, User $user)
    {
    	if(!Auth::attempt(['username' => $request ->username, 'password'=> $request->password]))
    	{
    		return response()->json(['error'=>'Your credential is wrong'],401);
    	}

    	$user = $user->find(Auth::user()->id);

		// $userbaru = new History;
  //       $userbaru->id_user = Auth::user()->id;
  //       $userbaru->save();
    	
    	return fractal()
    		->item($user)
    		->transformWith(new UserTransformer)
    		->addMeta([
    			'token' => $user->api_token,
    			])//nambah meta buat nampilin token
    		->toArray();

    		// return response()->json(['action yg anda lakukan'=> 'Login' ]);

    }
}
