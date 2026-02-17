<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use League\CommonMark\CommonMarkConverter;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'title', 'images', 'post_content', 'user_id', 'category_id'];

    protected $casts =["images" => "array"];

    public function getHtmlDescriptionAttribute()
{
    $converter = new CommonMarkConverter();

    return $converter->convert($this->post_content);
}

   public function category(): BelongsTo{
       return $this->belongsTo(Category::class);
   }

   public function user(): BelongsTo{
      return $this->belongsTo(User::class);
   }

   public function tags(){
      return $this->hasMany(Tag::class);
   }

}
