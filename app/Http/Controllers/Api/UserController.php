<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Auth::user()->cant('viewAny', Auth::user()), 403);
        return UserResource::collection(User::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        abort_if(Auth::user()->cant('store', Auth::user()), 403);
        $user = User::create($request->validated());
        $roleId = $request->input('role', null);
        if ($roleId) {
            $user->syncRoles(Role::findOrFail($roleId)->name);
        }

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_if(Auth::user()->cant('view', $user), 403);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserUpdateRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        abort_if(Auth::user()->cant('update', Auth::user(), $user), 403);

        $attributes = $request->validated();

        if(isset($attributes["password"])){
            $attributes["password"] = bcrypt($attributes["password"]);
        }

        $role = $request->input('role', null);
        if ($role["id"]) {
            $user->syncRoles(Role::findOrFail($role["id"])->name);
        }

        $user->update($attributes);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        abort_if(Auth::user()->cant('delete', Auth::user(),  $user), 403);
        $user->delete();
        return response()->noContent();
    }
}
