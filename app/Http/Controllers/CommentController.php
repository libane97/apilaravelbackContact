<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderByDesc('created_at')->get();
        return $comments->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $comment = Comment::create($request->all());
            return response()->json([
                'success' => 'le Post à ete crée avec success',
            ], 200);
        }catch (Exception $e){
             $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $comment = Comment::find($post_id);

        if($comment){
            return $comment;
        }elseif(!$comment){
            return response()->json([
                'success' => 'le command n\'existe pas',
            ], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {

           $comment->update($request->all());
           return  $comment;
            return response()->json([
                'success' => 'le Comment à ete modifier avec success',
            ], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        try {
            $comment->delete();
            return response()->json([
                'success' => 'le Post à ete supprime avec success',
            ], 200);
        }catch (Exception $e){
              $e->getMessage();
        }
    }
}
