<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Blog;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $blogs = Blog::get();
            return view('admin.index', compact('blogs'));
        } else {
            return 'Halaman ini khusu admin';
        }
    }

    public function createBlog()
    {
        if (Auth::user()->role == 'admin') {
            return view('admin.create-blog');
        } else {
            return 'Halaman ini khusu admin';
        }
    }

    public function storeBlog(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required|max:4',
            'content' => 'required',
        ])->validate();

        Blog::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/admin');
    }
}
