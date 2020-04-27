<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index()
    {
        $jam = 62;
        $greet = 'Selamat Tidur 2';
        // return view('hello', [
        //     'ucapan' => $greet
        // ]);
        return view('hello', compact('greet', 'jam'));
    }

    public function show($name)
    {
        // return 'Ini Halaman Detail: ' . $name;
        return view('hello-show', compact('name'));
    }
}
