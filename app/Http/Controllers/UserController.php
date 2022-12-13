<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	//
	public function getAllUsers()
	{
		$users = User::all();
		return response()->json(['users' => $users]);
	}

	public function getAnUser(User $user)
	{
		return response()->json(['user' => $user]);
	}

	public function createUser(Request $request)
	{
		$user = new User($request->all());
		$user->save();
		return response()->json(['user' => $user], 201);
	}

	public function updateUser(User $user, Request $request)
	{
		$user->update($request->all());
		return response()->json(['user' => $user->refresh()], 201);
	}
	public function deleteUser(User $user)
	{
		$user = $user->delete();
		return response()->json(['deleted' => $user], 204);
	}
}
