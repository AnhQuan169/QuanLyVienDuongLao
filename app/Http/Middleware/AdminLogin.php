<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            if(Auth::user()->loaiTaiKhoan==0 || Auth::user()->loaiTaiKhoan==1 || Auth::user()->loaiTaiKhoan==2){
                return $next($request);
            }
            return redirect()->back()->with('message','Bạn không có quyền thực hiện chức năng này');
        }
        return redirect()->back();
    }
}
