<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [ 'title', 'images', 'post_content', 'user_id'];

    protected $casts =["images" => "array"];
}
