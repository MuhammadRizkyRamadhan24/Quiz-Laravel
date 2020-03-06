<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class AuthController extends Controller
{


    public function register(Request $request)
    {
        $user = User::create([
             'name'    => $request->name,
             'email'    => $request->email,
             'password' => bcrypt($request->password),
         ]);

        $token = auth()->login($user);

        return $this->respondWithToken($token);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['status' => '200', 'data' => 'Success']);
    }
    
    public function show($id)
    {
        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        $article = User::findOrFail($id);
        $article->update($request->all());

        return $article;
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
    }
}