<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Website;
use App\Jobs\SendEmailJob;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($website_id)
    {
        return response()->json([
            'posts' => Website::find($website_id)->posts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {   
        $request->validate([
            'title' => 'required|max:150',
            'description' => 'required|max:500',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;

        $website = Website::find($id);
        $website->posts()->save($post);

        foreach($website->subcriptions as $subscription) {
            dispatch(new SendEmailJob($post, $subscription->email));
        }

        return response()->json([
            'post_id' => $post->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
