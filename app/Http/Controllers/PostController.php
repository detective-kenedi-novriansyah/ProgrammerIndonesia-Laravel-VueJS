<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api', ['except' => 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getAll = Post::paginate(15);

        return PostResource::collection($getAll);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = Validator::make($request->all(),[
            'content' => 'required'
        ]);
        if($data->fails()) {
            return response()->json($data->errors());
        }

        $create = Post::create([
            'content' => $request->get('content'),
            'user_id' => auth()->user()->id,
        ]);
        $create->save();

        $newPost = array(
            'id' => $create->id,
            'content' => $create->content,
            'user_id' => User::find($create->user_id),
        );
        return response()->json([
            'message' => 'Post has been created',
            'result' => $newPost
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(!$post) {
            return response()->json([
                'message' => 'Not Found'
            ]);
        }
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $retrieve_post = Post::find($id);
        if(!$retrieve_post) {
            return response()->json([
                'message' => 'Not Found'
            ]);
        }
        $retrieve_post->content = $request->get('content');
        $retrieve_post->save();
        $newPost = array(
            'id' => $retrieve_post->id,
            'content' => $retrieve_post->content,
            'user_id' => User::find($retrieve_post->user_id),
        );
        return response()->json([
            'message' => 'Post has been updated',
            'result' => $newPost
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $retrieve_post = Post::find($id);
        if(!$retrieve_post) {
            return response()->json([
                'message' => 'Not Found'
            ]);
        }
        $retrieve_post->delete();
        return response([
            'message' => 'Postingan tersebut sudah saya musnahkan',
            'post' => $retrieve_post
        ]);
    }
}
