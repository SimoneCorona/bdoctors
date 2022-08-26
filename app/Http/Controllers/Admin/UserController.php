<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Specialty;
use App\Sponsorship;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::all();
        // $tags = Tag::all();
        // return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate($this->getValidationRules());
        // $data = $request->all();
        // $image_path = Storage::put('image_path', 'data');
        // $post = new Post();
        // $user->fill($data);
        // $user->slug = $this->generatePostSlugFromTitle($user->title);
        // $post->save();
        // if(isset($data['tags'])) {
        //     $post->tags()->sync($data['tags']);
        // }
        // return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $messages = $user->message;
        $reviews = $user->review;
        $sponsorships = $user->sponsorship;

        return view('admin.users.show', compact('user', 'messages', 'reviews', 'sponsorships'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $messages = $user->message;
        $reviews = $user->review;
        $sponsorships = $user->sponsorship;
        $specialties = Specialty::all()->sortBy('specialty_name');
        return view('admin.users.edit', compact('user', 'messages', 'reviews', 'sponsorships', 'specialties'));
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
        // $data = $request->all();
        // $post = Post::findOrFail($id);        
        // $post->update($data);
        // if(isset($data['tags'])) {
        //     $post->tags()->sync($data['tags']);
        // } else {
        //     $post->tags()->sync([]);
        // }
        // return redirect()->route('admin.posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $post = Post::findOrFail($id);
        // $post->tags()->sync([]);
        // $post->delete();
        // return redirect()->route('admin.posts.index');
    }
}
