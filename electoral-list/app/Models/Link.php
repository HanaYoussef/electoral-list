<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'route',
        'parent_id',
        'order',
        'active',
        'show_in_menu'
    ];

    function users(){
        return $this->belongsToMany(User::class,'user_links');
    }
}
