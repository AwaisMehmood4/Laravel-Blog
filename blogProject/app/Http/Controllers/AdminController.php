<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (isset($request->user()->id)) {

            $userId = $request->user()->id;
            if ($userId === 1) {

                return view('blog.admin')->with('posts', Post::orderBy('updated_at', 'DESC')->get());
            } else {

                $post = Post::where('user_id', $userId)->orderBy('updated_at', 'DESC')->get();
                return view('blog.index', ['posts' => $post]);
            }
        } else {
            return view('blog')->with('posts', Post::orderBy('updated_at', 'DESC')->get());
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = uniqid() . '-' . $request->title . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);



        Post::create([

            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id

        ]);

        return redirect('/blog')->with('message', 'Your post has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {

        // if (isset($request->user()->id)) {

        //     $userId = $request->user()->id;
        //     if ($userId === 1) {

        //         return view('blog.panel');
        //     } else {
        //         return view('blog.show')->with('posts', Post::where('slug', $slug)->first());
        //     }
        // } else {

        // }
        return view('blog.show')->with('posts', Post::where('slug', $slug)->first());
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('blog.edit')->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Post::where('slug', $slug)->update([

            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
            'user_id' => auth()->user()->id
        ]);

        return redirect('/blog')->with('message', 'Your post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug);
        $post->delete();
        return redirect('/blog')->with('message', 'Your post has been deleted');
    }


    public function blog(Request $request)
    {
        if (isset($request->user()->id)) {

            $userId = $request->user()->id;
            if ($userId === 1) {

                return view('blog.admin')->with('posts', Post::orderBy('updated_at', 'DESC')->get());
            } else {

                $post = Post::where('user_id', $userId)->orderBy('updated_at', 'DESC')->get();
                return view('blog.index', ['posts' => $post]);
            }
        } else {
            return view('blog')->with('posts', Post::orderBy('updated_at', 'DESC')->get());
        }
    }
}
