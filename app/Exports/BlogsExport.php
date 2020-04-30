<?php

namespace App\Exports;

use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BlogsExport implements FromView
{
    public function view(): View
    {
        return view('exports.blogs', [
            'blogs' => DB::table('blogs')->get(),
        ]);
    }
}
