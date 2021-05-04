<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\BlockModel;



class seller
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
        if  (Session::get("user") != null && Session::get("user")->type == 1) {
            $is_block = BlockModel::where("user_id", Session::get("user")->id)->count();
            if  ($is_block > 0) {
                return Redirect::to("/blocked");
            }
            return $next($request);
        }
        return Redirect::to("/");
    }
}
