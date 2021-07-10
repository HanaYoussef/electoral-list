<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    { 
        // dd('dddd');
        $user = auth()->user();
        $routeName = request()->route()->getName();
        $link = Link::where('route', $routeName)->first();
        if($link){
            $hasUserLink = $user->links()->where('links.id', $link->id)->count();
             if(!$hasUserLink){
                return redirect(route('home'))->with('msg','you  Are Authorization');
            }
        }
        return $next($request);
    }


}
