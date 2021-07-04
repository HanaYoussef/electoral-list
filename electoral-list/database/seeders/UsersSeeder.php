<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Link;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email'=>'admin@gmail.com',
            'name' =>'Admin',
            'password' => bcrypt('123456789')
        ]);
        $links = Link::all();
        foreach($links as $link){
            \DB::table('user_links')->insert([
                'link_id'=>$link->id,
                'user_id'=>$user->id,
                'created_at'=>new \DateTime(),
                'updated_at'=>new \DateTime(),
            ]);
        }
    }
}
