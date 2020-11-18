<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Post;
use App\Models\User;
use App\Http\Resources\Post as PostResource;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','store']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    public function profile($token) {
        $profile = User::find($token);
        $post = Post::where('user_id', $profile->id)->get();
        $render_post = PostResource::collection($post);
        
        return response()->json([
            'author' => $profile,
            'post'=> $render_post
        ]);
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);
        $unique_email = User::where('email',$request->get('email'))->first();
        $unique_name = User::where('name', $request->get('name'))->first();
        if($unique_name) {
            return response()->json([
                'message' => 'Name already exists'
            ], 400);
        }
        if($unique_email) {
            return response()->json([
                'message' => 'Email already exists'
            ],400);
        }
        if($request->get('password') != $request->get('confirm_password')) {
            return response()->json([
                'message' => "Password don't match"
            ],400);
        }
        if($validation->fails()){
            return response()->json($validation->errors());
        }

        $path = $request->file('image')->store('public');

        $create_user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'profile' => 'http://localhost:8000/'. $path,
            'password' => bcrypt($request->get('password')),
        ]);
        $create_user->save();
        return response()->json([
            'message' => 'Successfully create new account'
        ]);
    }
}
