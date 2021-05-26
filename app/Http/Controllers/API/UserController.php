<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function hidden(Request $request)
    {
        return User::where('id', Auth::user()->id)->get();
    }
}
