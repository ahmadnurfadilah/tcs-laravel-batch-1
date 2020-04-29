<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $table = 'blogs';

    protected $fillable = [
        'user_id', 'title', 'content', 'image'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}