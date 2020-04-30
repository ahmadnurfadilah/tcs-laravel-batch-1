<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Mail;
use Excel;
use Storage;
use Validator;
use Illuminate\Http\Request;
use App\Blog;
use App\Mail\SendBlogToAdmin;
use App\Exports\BlogsExport;

class AdminController extends Controller
{
    public function index()
    {
        // $blogs = Blog::where('id', 1)->first();
        // $blogs = Blog::find(3);

        // Menampilkan seluruh data
        // $blogs = Blog::where('id', '>', 0)->orderBy('id', 'desc')->get();

        // Paginate
        
        // Eloquent
        // $blogs = Blog::where('id', '>', 0)->orderBy('id', 'desc')->paginate(6);

        // Query Builder
        $blogs = DB::table('blogs')
        ->select('blogs.id', 'blogs.title', 'blogs.content', 'users.name', 'blog_categories.name as category')
        ->join('users', 'users.id', 'blogs.user_id')
        ->join('blog_categories', 'blog_categories.id', 'blogs.category_id')
        ->orderBy('blogs.id', 'desc')->paginate(6);
        // dd($blogs);
        return view('admin.index', compact('blogs'));
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        // $blog = Blog::where('id', $id)->first();
        $categories = DB::table('blog_categories')->get();
        return view('admin.edit-blog', compact('blog', 'categories'));
    }

    public function createBlog()
    {
        $categories = DB::table('blog_categories')->get();
        return view('admin.create-blog', compact('categories'));
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
            'category_id' => $request->category,
        ]);
        notify()->success('Blog: '. $request->title .'  berhasil diedit!');
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
            'category_id' => $request->category,
            'title' => $request->title,
            'content' => $request->content,
            'image' => $thumbnail,
        ]);

        // $admins = DB::table('users')->where('role', 'admin')->get();
        // foreach ($admins as $admin) {
        //     Mail::to($admin->email)->send(new SendBlogToAdmin());
        // }

        notify()->success('Blog berhasil dibuat!');

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

    public function export()
    {
        return Excel::download(new BlogsExport, 'blogs.xlsx');
    }
}
