<?php

namespace App\Providers;

use App\Services\ActivityLogger;
use App\Services\ActivityService;
use App\Services\ActorService;
use App\Services\ArticleService;
use App\Services\CollectionService;
use App\Services\CommentService;
use App\Services\Contracts\ActivityServiceInterface;
use App\Services\Contracts\ActorServiceInterface;
use App\Services\Contracts\ArticleServiceInterface;
use App\Services\Contracts\CollectionServiceInterface;
use App\Services\Contracts\CommentServiceInterface;
use App\Services\Contracts\DashboardServiceInterface;
use App\Services\Contracts\FileServiceInterface;
use App\Services\Contracts\GenreServiceInterface;
use App\Services\Contracts\ListServiceInterface;
use App\Services\Contracts\MovieServiceInterface;
use App\Services\Contracts\NewsletterServiceInterface;
use App\Services\Contracts\PermissionServiceInterface;
use App\Services\Contracts\PlanServiceInterface;
use App\Services\Contracts\RequirementServiceInterface;
use App\Services\Contracts\RoleServiceInterface;
use App\Services\Contracts\SettingServiceInterface;
use App\Services\Contracts\SubscriptionServiceInterface;
use App\Services\Contracts\TicketServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\DashboardService;
use App\Services\FileService;
use App\Services\GenreService;
use App\Services\ListService;
use App\Services\MovieService;
use App\Services\NewsletterService;
use App\Services\PermissionService;
use App\Services\PlanService;
use App\Services\RequirementService;
use App\Services\RoleService;
use App\Services\SettingService;
use App\Services\SubscriptionService;
use App\Services\TicketService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ActorServiceInterface::class, ActorService::class);
        $this->app->bind(ArticleServiceInterface::class, ArticleService::class);
        $this->app->bind(CollectionServiceInterface::class, CollectionService::class);
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
        $this->app->bind(GenreServiceInterface::class, GenreService::class);
        $this->app->bind(ListServiceInterface::class, ListService::class);
        $this->app->bind(MovieServiceInterface::class, MovieService::class);
        $this->app->bind(PermissionServiceInterface::class, PermissionService::class);
        $this->app->bind(PlanServiceInterface::class, PlanService::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        $this->app->bind(SettingServiceInterface::class, SettingService::class);
        $this->app->bind(SubscriptionServiceInterface::class, SubscriptionService::class);
        $this->app->bind(TicketServiceInterface::class, TicketService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(DashboardServiceInterface::class, DashboardService::class);
        $this->app->bind(ActivityServiceInterface::class, ActivityService::class);
        $this->app->bind(RequirementServiceInterface::class, RequirementService::class);
        $this->app->bind(NewsletterServiceInterface::class, NewsletterService::class);
        $this->app->bind(FileServiceInterface::class, FileService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $activity = null;
        View::composer('Dashboard.*', function ($view) use ($activity){
            if (Auth::check() && Auth::user()->hasPermissionTo('activity.view')){
                $activity = Activity::with('subject', 'causer')->latest()->limit(20)->get();
            }
            $view->with(['user' => Auth::user(), 'activity' => $activity]);
        });
    }
}
