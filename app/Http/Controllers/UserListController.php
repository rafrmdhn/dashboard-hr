<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserListController extends Controller
{
    public function index()
    {
        return view('userlist.main', [
            'title' => 'Users List',
            'search' => 'users-list',
            'export' => 'exportUsersList'
        ]);
    }
}
