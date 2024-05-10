<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserListController extends Controller
{
    public function index()
    {
        return view('userlist.main', [
            'title' => 'Users List',
            'search' => 'users-list',
            'export' => 'exportUsersList',
            'users' => User::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',
            'password' => 'required',
            'photo' => 'required',
            'role' => 'required'
        ]);

        if ($request->password == 'password'){
            $validatedData['password'] = bcrypt($request->password);
        }

        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/users');
        } 

        $user = User::create($validatedData);
        $user->assignRole($request->role);

        $role = Role::findByName($request->role);
        $permissions = $role->permissions;
        foreach ($permissions as $permission) {
            $user->givePermissionTo($permission);
        }

        return redirect('/users-list')->with('success', 'Data has been added!');
    }

    public function destroy(User $user)
    {
        try {
            User::destroy($user->id);

            return redirect('/users-list')->with('success', 'Data has been deleted!');
        } catch (\Throwable $th) {
            return redirect('/users-list')->with('error', 'Data cannot Delete');
        }
    }
}
