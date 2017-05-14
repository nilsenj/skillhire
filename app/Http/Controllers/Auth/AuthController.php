<?php
/**
 * Created by PhpStorm.
 * User: nilsenj
 * Date: 14.05.17
 * Time: 0:15
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterFormRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
    {
        $user = User::create([
            'name' => $request->json('name'),
            'email' => $request->json('email'),
            'password' => bcrypt($request->json('password')),
        ]);

        $user->attachRole(2);
    }


    public function signin(Request $request)
    {
        try {
            $token = JWTAuth::attempt($request->only('email', 'password'), [
                'exp' => Carbon::now()->addWeek()->timestamp,
            ]);
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not authenticate',
            ], 500);
        }

        if (!$token) {
            return response()->json([
                'error' => 'Could not authenticate',
            ], 401);
        } else {
            $data = [];
            $meta = [];

            $data['name'] = $request->user()->name;
            $meta['token'] = $token;

            return response()->json([
                'data' => $data,
                'meta' => $meta
            ]);
        }
    }
}