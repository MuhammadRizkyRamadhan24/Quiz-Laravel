<?php
namespace App\Http\Controllers;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
             'email'    => $request->email,
             'password' =>  bcrypt($request->password),
         ]);
        $token = auth()->login($user);
        return $this->respondWithToken($token);
    }
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }
    
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->factory()->getTTL() * 60
        ]);
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
}