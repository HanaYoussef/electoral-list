<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category ;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'details',
        'summary',
        'category_id',
        'published',
        'image',  
        'published_at',
        'count' 
    ];
   
    // protected guarded =[];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class,'post_tag','post_id','tag_id');
    }


    
    protected $appends = ['image'];

     public function getImageAttribute($image)
        { 
         return asset('storage/images/' . $image);
        // return asset('storage/images/' . $this->image);
        }


}
