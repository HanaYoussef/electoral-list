<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post ;

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

     public function post()
    {
        return $this->hasMany(Post::class);
    }
}
