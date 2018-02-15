<?php namespace App\Http\Middleware;

use Alert;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle(
        $request,
        Closure $next
    ) {
        if (Auth::user()->level != User::ADMIN) {
            if (Auth::user()->level != User::SUPERADMIN) {
                Alert::error("Anda Tidak Punya Akses");
                return back();
            }
        }
        return $next($request);
    }
}
