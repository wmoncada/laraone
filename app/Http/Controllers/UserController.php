<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view("user.index", [
            "users" => $users
        ]);
    }

    public function store(Request $request)
    {
        // validaciones
        $request->validate([
            "name" => "required",
            "email" => ["required", "email", "unique:users"],
            "password" => ["required", "min:8"],
        ]);

        // creacion del user
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        return back();
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
