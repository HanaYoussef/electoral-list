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
    ];
    public function getData()
    {
        return static::orderBy('created_at','desc')->get();
    }
 
    public function storeData($input)
    {
        return static::create($input);
    }
 
    public function findData($id)
    {
        return static::find($id);
    }
 
    public function updateData($id, $input)
    {
        return static::find($id)->update($input);
    }
 
    public function deleteData($id)
    {
        return static::find($id)->delete();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
