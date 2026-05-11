<?php

namespace App\Http\Middleware;

use App\Models\Announcements;
use App\Models\Genres;
use App\Models\MovieList;
use App\Models\Requirements;
use App\Models\Setting;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\Response;

class ShareVarriableMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = Setting::where('id', 1)->firstOrFail();
        $requirements = Requirements::orderByDesc('id')->limit(3)->get();
        if (Str::startsWith(Route::currentRouteName(), 'panel.')) {
            $announcements = Announcements::orderByDesc('id')->where('user_id', auth()->user()->id)->where('seen', 0)->with('user', 'subject')->get();
            View::share(['announcements' => $announcements, 'requirements' => $requirements , 'settings' => $settings]);
        } else {
            $genres = Genres::select('id', 'title')->orderByDesc('id')->get();
            $lists = MovieList::select('id', 'title', 'slug')->orderByDesc('id')->get();
            View::share(['genres' => $genres, 'lists' => $lists, 'requirements' => $requirements, 'settings' => $settings]);
        }
        return $next($request);
    }
}
