<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class XSS
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

       // dd($request);
        $input = $request->all();
        array_walk_recursive($input, function(&$input) {
            $input = strip_tags($input);

        });
        $request->merge($input);

        $is_keywords  = is_keywords($request->all());
        if($is_keywords){        
            return abort(404);   
        }
        $is_keywords  = is_keywords($request->route()->parameters());
        if($is_keywords){       
            return abort(404);   
        }
        
        return $next($request);
    }
}
