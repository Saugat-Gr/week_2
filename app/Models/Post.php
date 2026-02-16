<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\CommonMark\CommonMarkConverter;

class Post extends Model
{
    protected $fillable = [ 'title', 'images', 'post_content', 'user_id'];

    protected $casts =["images" => "array"];

    public function getHtmlDescriptionAttribute()
{
    $converter = new CommonMarkConverter();

    return $converter->convert($this->post_content);
}

}
