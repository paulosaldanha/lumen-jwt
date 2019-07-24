<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
	//return response()->json(\md5($request->get('password')));exit;
      $user = new User([
	'name' => $request->get('name'),
        'email' => $request->get('email'),
        'password' => \md5($request->get('password')),
      ]);
      $user->save();
      return response()->json('success');
    }

    public function index()
    {
	$users = User::all();
	return response()->json($users);
      //return new UserCollection(User::all());
    }

    public function edit($id)
    {
      $user = User::find($id);
      return response()->json($user);
    }

    public function update($id, Request $request)
    {
      $user = User::find($id);
      $user->update($request->all());
      return response()->json('successfully updated');
    }

    public function delete($id)
    {
      $user = User::find($id);
      $user->delete();
      return response()->json('successfully deleted');
    }

}
