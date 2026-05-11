<?php

namespace App\Http\Middleware;

use App\Models\Announcements;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class DashboardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && auth()->user()->hasPermissionTo("dashboard.login")){
            $notifications = Announcements::where('user_id', auth()->user()->id)->with('subject')->get();
            View::share(['notifications' => $notifications]);
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
