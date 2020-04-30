<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Storage;
use Validator;
use Illuminate\Http\Request;
use App\Blog;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            // $blogs = Blog::where('id', 1)->first();
            // $blogs = Blog::find(3);

            // Menampilkan seluruh data
            // $blogs = Blog::where('id', '>', 0)->orderBy('id', 'desc')->get();

            // Paginate
            
            // Eloquent
            // $blogs = Blog::where('id', '>', 0)->orderBy('id', 'desc')->paginate(6);

            // Query Builder
            $blogs = DB::table('blogs')
            ->select('blogs.id', 'blogs.title', 'blogs.content', 'users.name')
            ->join('users', 'users.id', 'blogs.user_id')
            ->orderBy('blogs.id', 'desc')->paginate(6);
            // dd($blogs);
            return view('admin.index', compact('blogs'));
        } else {
            return 'Halaman ini khusu admin';
        }
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        // $blog = Blog::where('id', $id)->first();
        return view('admin.edit-blog', compact('blog'));
    }

    public function createBlog()
    {
        if (Auth::user()->role == 'admin') {
            return view('admin.create-blog');
        } else {
            return 'Halaman ini khusu admin';
        }
    }

    public function updateBlog($id, Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required|max:100',
            'content' => 'required',
        ])->validate();

        // Ini eloquent
        // Blog::where('id', $id)->update([
        //     'title' => $request->title,
        //     'content' => $request->content,
        // ]);

        // $blog = Blog::where('id', $id)->first();
        // $blog = Blog::find($id);
        // $blog->title = $request->title;
        // $blog->content = $request->content;
        // $blog->save();

        // Ini query builder
        DB::table('blogs')->where('id', $id)->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);
        return redirect('/admin');
    }

    public function storeBlog(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required|max:100',
            'content' => 'required',
        ])->validate();


        if ($request->image) {
            $thumbnail = Storage::put('thumbnail', $request->image);
            // $request->file('image')->store('thumbnail');
        } else {
            $thumbnail = null;
        }

        // Eloquent
        // $blog = new Blog();
        // $blog->user_id = Auth::id();
        // $blog->title = $request->title;
        // $blog->content = $request->content;
        // $blog->image = $thumbnail;
        // $blog->save();

        // Blog::create([
        //     'user_id' => Auth::id(),
        //     'title' => $request->title,
        //     'content' => $request->content,
        // ]);

        // Query Builder
        DB::table('blogs')->insert([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'image' => $thumbnail,
        ]);

        return redirect('/admin');
    }

    public function deleteBlog($id)
    {
        $blog = Blog::find($id);
        Storage::delete($blog);

        // Ini Eloquent
        // Blog::where('id', $id)->delete();

        // Ini Query builder
        DB::table('blogs')->where('id', $id)->delete();
        
        return redirect('/admin');
    }
}
