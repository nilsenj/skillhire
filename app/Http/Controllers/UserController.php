<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['name'] = $request->user()->name;
        $data['email'] = $request->user()->email;
        $data['roles'] = $request->user()->roles;
        dd();
        return response()->json([
            'data' => $data,
        ]);
    }
}
