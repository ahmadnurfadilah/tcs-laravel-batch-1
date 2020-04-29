<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request)
    {
        if ($request->search == '') {
            // menampilkan seluruh data
            // $blogs = Blog::get();

            // menampilkan paginate data
            $blogs = Blog::paginate(6);
            // $blog = Blog::where('id', 3)->first();
        } else {
            // $seach = 'testing';
            // '%testing' => 'ahsdjakshdasdtesting';
            // 'testing%' => 'testingkjdlksjdfklsdf';
            // '%testing%' => 'dfsfsfdftestingkjdlksjdfklsdf';
            $blogs = Blog::where('title', 'like', '%'. $request->search . '%')->paginate(6);
        }

        $recentBlogs = Blog::orderBy('created_at', 'desc')->take(3)->get();
        return view('blog.index', compact('blogs', 'recentBlogs'));
    }

    public function show($id)
    {
        $blog = Blog::find($id);
        return view('blog.show', compact('blog'));
    }
}
