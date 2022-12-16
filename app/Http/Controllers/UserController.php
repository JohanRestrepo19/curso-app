<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

	public function showAllUsers()
	{
		$users = $this->getAllUsers()->original['users'];
		return view('users.index', compact('users'));
	}

	public function getAllUsers()
	{
		$users = User::all();
		return response()->json(['users' => $users]);
	}

	public function getAnUser(User $user)
	{
		return response()->json(['user' => $user]);
	}

	public function showCreateUser()
	{
		return view('users.create-user');
	}

	public function createUser(CreateUserRequest $request)
	{
		$user = new User($request->all());
		$user->save();
		if ($request->ajax()) return response()->json(['user' => $user], 201);
		return back()->with('success',  'Usuario creado');
	}

	public function showUpdateUser(User $user)
	{
		return view('users.edit-user', compact('user'));
	}

	public function updateUser(User $user, UpdateUserRequest $request)
	{
		$allRequestInfo = $request->all();

		if (isset($allRequestInfo['password']))
			if (!$allRequestInfo['password']) unset($allRequestInfo['password']);

		$user->update($allRequestInfo);

		if ($request->ajax()) return response()->json(['user' => $user->refresh()], 201);
		return back()->with('success', 'Usuario editado');
	}

	public function deleteUser(User $user, Request $request)
	{
		$user = $user->delete();
		if ($request->ajax()) return response()->json(['deleted' => $user], 204);
		return back()->with('success', 'Usuario eliminado');
	}

	public function getAllLendsByUser(User $user)
	{
		$customerLends = $user->load([
			'customerLends' => ['book' => ['category', 'author']],
		])->customerLends;
		return response()->json(['customer_lends' => $customerLends], 200);
	}

	public function getAllUsersWithLends()
	{
		$usersWithLends = User::with(['customerLends' => ['book']])
			->has('customerLends')
			->get();
		return response()->json(['users_with_lends' => $usersWithLends], 200);
	}
}
