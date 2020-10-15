<?php

namespace App\Http\Controllers;

use App\Post;
use http\Message;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Post = Post::orderByDesc('created_at')->get();
        return $Post->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post =  Post::create($this->validator());
        $post->picture = $this->storeImage(request('picture'));
        $post->save();
        return response()->json([
          'success' => 'le Post à ete crée avec success',
           ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post_id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $post = Post::find($post_id);

        if($post){
            return $post;
        }elseif(!$post){
            return response()->json([
                'success' => 'le post n\'existe pas',
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        try {
            $data = $this->validator();
            $post->fill($data);
            $post->picture = $this->storeImage(request('picture'));
            $post->save();
            return response()->json([
                'success' => 'le Post à ete modifier avec success',
            ], 200);
        }catch (Exception $e){
             $e->getMessage();
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'success' => 'le Post à ete supprime avec success',
        ], 200);
    }

    public function validator(){
       return request()->validate([
            'title' => 'required|min:5',
            'message' => 'required|min:5',
            'picture' => 'sometimes|image|max:5000'
        ]);
    }
    public function storeImage($image){
          if ($image){
               $imagepath = $image->store('avatar','public');
               return $imagepath;
          }
    }
}
