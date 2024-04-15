<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.main', [
            'title' => 'Edit Profile',
            'profile' => User::findOrFail(Auth::user()->id),
        ]);
    }

    public function update(Request $request, User $user)
    {
        
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'sometimes|nullable',
            'photo' => 'image|file|max:1024'
        ]);
        // dd($validatedData);

        if ($request->password != ''){
            $validatedData['password'] = bcrypt($request->password);
        }
        else {
            unset($validatedData['password']);
        }

        if($request->file('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('images/users');
        } 
        else {
            $validatedData['photo'] = $user->photo;
        }

        $user = auth()->user();
        $user->fill($validatedData);
        $user->save();

        return redirect('/edit-profile')->with('success', 'Data has been updated!');
    }
}
