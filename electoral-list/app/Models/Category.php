<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Scope;

use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasApiTokens;
    use HasFactory;
   
 
    protected $table = 'categories';
    protected $guarded = array();
    protected $fillable=[
        'name',
        'active'
    ];

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function publishedPost(){
        // return $this->hasMany(Post::class)->where('published',1)->where('category_id',$category_id);
        return $this->countPublishedPost();
    }

    public function scopePublishedPost(){
        // return $this->hasMany(Post::class)->where('published',1)->where('category_id',$category_id);
        return  $this->post()->where(['published'=>1 , 'category_id'=>$this->id]);
    }

   

  

}
