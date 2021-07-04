<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Link;
class LinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { //Posts
        $link = Link::create([
            'title'=>'Posts',
            'route'=>'',
            'parent_id'=>0,
            'show_in_menu'=>1,
            'active'=>1,
            'order'=>1,            
        ]);
        Link::create([
            'title'=>'Post List',
            'route'=>'posts.index',
            'parent_id'=>$link->id,
            'show_in_menu'=>1,
            'active'=>1,
            'order'=>1,            
        ]);
      

        //users
        $link = Link::create([
            'title'=>'Users',
            'route'=>'',
            'parent_id'=>0,
            'show_in_menu'=>1,
            'active'=>1,
            'order'=>1,            
        ]);
        Link::create([
            'title'=>'User List',
            'route'=>'users.index',
            'parent_id'=>$link->id,
            'show_in_menu'=>1,
            'active'=>1,
            'order'=>1,            
        ]);
       

         //Category
         $link = Link::create([
            'title'=>'Category',
            'route'=>'',
            'parent_id'=>0,
            'show_in_menu'=>1,
            'active'=>1,
            'order'=>1,            
        ]);
        Link::create([
            'title'=>'Category List',
            'route'=>'categories.index',
            'parent_id'=>$link->id,
            'show_in_menu'=>1,
            'active'=>1,
            'order'=>1,            
        ]);
        Link::create([
            'title'=>'Category create',
            'route'=>'categories.create',
            'parent_id'=>$link->id,
            'show_in_menu'=>0,
            'active'=>1,
            'order'=>1,            
        ]);
       
    }
}
