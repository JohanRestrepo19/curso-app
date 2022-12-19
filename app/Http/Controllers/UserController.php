<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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

  public function getAllRoles()
  {
    $roles = Role::all()->pluck('name');
    return response()->json(['roles' => $roles], 200);
  }

  public function getAnUser(User $user)
  {
    return response()->json(['user' => $user]);
  }

  public function showCreateUser()
  {
    $roles = $this->getAllRoles()->original['roles'];
    return view('users.create-user', compact('roles'));
  }

  public function createUser(CreateUserRequest $request)
  {
    try {
      // Las transacciones se utilizan cuando se quiere hacer el guardado de varios modelos
      DB::beginTransaction();
      $user = new User($request->all());
      $user->save();
      $user->assignRole($request->role);
      DB::commit();
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }

    if ($request->ajax()) return response()->json(['user' => $user], 201);
    return back()->with('success',  'Usuario creado');
  }

  public function showUpdateUser(User $user)
  {
    $roles = $this->getAllRoles()->original['roles'];
    $user->load('roles');
    return view('users.edit-user', compact('user', 'roles'));
  }

  public function updateUser(User $user, UpdateUserRequest $request)
  {

    try {
      DB::beginTransaction();

      $allRequestInfo = $request->all();
      if (isset($allRequestInfo['password']))
        if (!$allRequestInfo['password']) unset($allRequestInfo['password']);
      $user->update($allRequestInfo);
      $user->syncRoles($request->role);

      DB::commit();

      if ($request->ajax()) return response()->json(['user' => $user->refresh()], 201);
      return back()->with('success', 'Usuario editado');
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
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
