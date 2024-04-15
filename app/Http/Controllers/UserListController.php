<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'role' => 'required',
        ]);

        if ($request->password == 'password'){
            $validatedData['password'] = bcrypt($request->password);
        }

        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/users');
        } 

        User::create($validatedData);

        return redirect('/users-list')->with('success', 'Data has been added!');
    }
}
