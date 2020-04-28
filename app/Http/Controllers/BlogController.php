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

    public function index()
    {
        // menampilkan seluruh data
        $blogs = Blog::get();
        // $blog = Blog::where('id', 3)->first();
        return view('blog.index', compact('blogs'));
    }
}
