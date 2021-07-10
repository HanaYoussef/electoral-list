<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use DB;
use Illuminate\Support\Carbon;

class ChartController extends Controller
{
    public function numUser()
    {
    // $user=User::select(DB::raw("(COUNT(*)) as count"),DB::raw("YEAR(created_at) as year"))
    // ->groupBy('year')
    // ->get();
    //dd($user);to print number of user in Year

// $item=Post::all('created_at');

// $item->diffForHumans();
// dd($item);
    $x=Carbon::now();
    dd($x);
    $popularTime= Carbon::now()->subMinute(5)->diffForHumans();
     dd($popularTime);

    $current = Carbon::now();
    dd($current);
   // return view ('chart.barChart');
    }


}    
