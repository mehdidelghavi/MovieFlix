<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\Dashboard\ActivityController;
use App\Http\Controllers\Dashboard\ActorsController;
use App\Http\Controllers\Dashboard\ArticlesController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\CollectionsController;
use App\Http\Controllers\Dashboard\CommentsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\GenresController;
use App\Http\Controllers\Dashboard\ListsController;
use App\Http\Controllers\Dashboard\MoviesController;
use App\Http\Controllers\Dashboard\NewsletterController;
use App\Http\Controllers\Dashboard\PaymentsController;
use App\Http\Controllers\Dashboard\PermissionsController;
use App\Http\Controllers\Dashboard\PlansController;
use App\Http\Controllers\Dashboard\RequirementsController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\SubscriptionsController;
use App\Http\Controllers\Dashboard\TicketsController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Panel\ForgotPasswordController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Panel\ResetPasswordController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\ShareVarriableMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\DashboardMiddleware;
use Illuminate\Http\Request;
use UniSharp\LaravelFilemanager\Lfm;

// Dashboard Login
Route::group([] , function (){
    Route::get('/login', [LoginController::class , 'index'])->name('login');
    Route::post('/login', [LoginController::class , 'authLogin'])->name('login.auth');
    Route::get("/logout", [LoginController::class, 'logout'])->name('login.logout');
});

Route::group(["prefix"=> "/dashboard/", "middleware" => DashboardMiddleware::class], function () { 
    // Ckfinder Upload Route
    Route::post('/ckeditor/upload', function (Request $request) {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/ckeditor'), $filename);
            $url = asset('uploads/ckeditor/'.$filename);
            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }
        return response()->json(['uploaded' => false, 'error' => ['message' => 'No file uploaded.']]);
    });
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
        Lfm::routes();
    });


    Route::get("/", [DashboardController::class,"index"])->name("dashboard.index");

    // Users Routes
    Route::get("/users/", [UsersController::class,"index"])->name("dashboard.users")->middleware(['permission:users.view']);
    Route::get("/users/create", [UsersController::class,"create"])->name("dashboard.users.create")->middleware(['permission:users.create']);
    Route::post("/users/store", [UsersController::class,"store"])->name("dashboard.users.store")->middleware(['permission:users.create']);
    Route::get("/users/edit/{user}", [UsersController::class,"edit"])->name("dashboard.users.edit")->middleware(['permission:users.update']);
    Route::post("/users/update/{user}", [UsersController::class,"update"])->name("dashboard.users.update")->middleware(['permission:users.update']);
    Route::get("/users/destroy/{user}", [UsersController::class,"destroy"])->name("dashboard.users.destroy")->middleware(['permission:users.delete']);
    Route::POST("/users/multidelete", [UsersController::class,"multiDelete"])->name("dashboard.users.multiDelete")->middleware(['permission:users.delete']);

    // Plans Routes
    Route::get("/plans/", [PlansController::class,"index"])->name("dashboard.plans")->middleware(['permission:plans.view']);
    Route::get("/plans/create", [PlansController::class,"create"])->name("dashboard.plans.create")->middleware(['permission:plans.create']);
    Route::post("/plans/store", [PlansController::class,"store"])->name("dashboard.plans.store")->middleware(['permission:plans.create']);
    Route::get("/plans/edit/{plan}", [PlansController::class,"edit"])->name("dashboard.plans.edit")->middleware(['permission:plans.update']);
    Route::post("/plans/update/{plan}", [PlansController::class,"update"])->name("dashboard.plans.update")->middleware(['permission:plans.update']);
    Route::get("/plans/destroy/{plan}", [PlansController::class,"destroy"])->name("dashboard.plans.destroy")->middleware(['permission:plans.delete']);
    Route::POST("/plans/multidelete", [PlansController::class,"multiDelete"])->name("dashboard.plans.multiDelete")->middleware(['permission:plans.delete']);

    // Genres Routes
    Route::get("/genres/", [GenresController::class,"index"])->name("dashboard.genres")->middleware(['permission:genres.view']);
    Route::get("/genres/create", [GenresController::class,"create"])->name("dashboard.genres.create")->middleware(['permission:genres.create']);
    Route::post("/genres/store", [GenresController::class,"store"])->name("dashboard.genres.store")->middleware(['permission:genres.create']);
    Route::get("/genres/edit/{genre}", [GenresController::class,"edit"])->name("dashboard.genres.edit")->middleware(['permission:genres.update']);
    Route::post("/genres/update/{genre}", [GenresController::class,"update"])->name("dashboard.genres.update")->middleware(['permission:genres.update']);
    Route::get("/genres/destroy/{genre}", [GenresController::class,"destroy"])->name("dashboard.genres.destroy")->middleware(['permission:genres.delete']);
    Route::POST("/genres/multidelete", [GenresController::class,"multiDelete"])->name("dashboard.genres.multiDelete")->middleware(['permission:genres.delete']);

    // Actors Routes
    Route::get("/actors/", [ActorsController::class,"index"])->name("dashboard.actors")->middleware(['permission:actors.view']);
    Route::get("/actors/create", [ActorsController::class,"create"])->name("dashboard.actors.create")->middleware(['permission:actors.create']);
    Route::post("/actors/store", [ActorsController::class,"store"])->name("dashboard.actors.store")->middleware(['permission:actors.create']);
    Route::get("/actors/edit/{actor}", [ActorsController::class,"edit"])->name("dashboard.actors.edit")->middleware(['permission:actors.update']);
    Route::post("/actors/update/{actor}", [ActorsController::class,"update"])->name("dashboard.actors.update")->middleware(['permission:actors.update']);
    Route::get("/actors/destroy/{actor}", [ActorsController::class,"destroy"])->name("dashboard.actors.destroy")->middleware(['permission:actors.delete']);
    Route::POST("/actors/multidelete", [ActorsController::class,"multiDelete"])->name("dashboard.actors.multiDelete")->middleware(['permission:actors.delete']);

    // Articles Routes
    Route::get("/articles/", [ArticlesController::class,"index"])->name("dashboard.articles")->middleware(['permission:articles.view']);
    Route::get("/articles/create", [ArticlesController::class,"create"])->name("dashboard.articles.create")->middleware(['permission:articles.create']);
    Route::post("/articles/store", [ArticlesController::class,"store"])->name("dashboard.articles.store")->middleware(['permission:articles.create']);
    Route::get("/articles/edit/{article}", [ArticlesController::class,"edit"])->name("dashboard.articles.edit")->middleware(['permission:articles.update']);
    Route::post("/articles/update/{article}", [ArticlesController::class,"update"])->name("dashboard.articles.update")->middleware(['permission:articles.update']);
    Route::get("/articles/destroy/{article}", [ArticlesController::class,"destroy"])->name("dashboard.articles.destroy")->middleware(['permission:articles.delete']);
    Route::POST("/articles/multidelete", [ArticlesController::class,"multiDelete"])->name("dashboard.articles.multiDelete")->middleware(['permission:articles.delete']);

    // Movies Routes
    Route::get("/movies/", [MoviesController::class,"index"])->name("dashboard.movies")->middleware(['permission:movies.view']);
    Route::get("/movies/create", [MoviesController::class,"create"])->name("dashboard.movies.create")->middleware(['permission:movies.create']);
    Route::post("/movies/store", [MoviesController::class,"store"])->name("dashboard.movies.store")->middleware(['permission:movies.create']);
    Route::get("/movies/{movie}/episodes", [MoviesController::class,'episodes'])->name('dashboard.movies.episodes')->middleware(['permission:movies.update']);
    Route::get("/movies/{movie}/episodes/edit", [MoviesController::class,'editEpisode'])->name('dashboard.movies.edit.episodes')->middleware(['permission:movies.update']);
    Route::post("/movies/{movie}/episodes/edit", [MoviesController::class,'updateEpisode'])->name('dashboard.movies.update.episodes')->middleware(['permission:movies.update']);
    Route::post("/movies/{movie}/episodes/season/store", [MoviesController::class,'seasonStore'])->name('dashboard.movies.episodes.season.store')->middleware(['permission:movies.update']);
    Route::post("/movies/{movie}/episodes/episode/store", [MoviesController::class,'episodeStore'])->name('dashboard.movies.episodes.episode.store')->middleware(['permission:movies.update']);
    Route::post("/movies/{movie}/episodes/quality/store", [MoviesController::class,'qualityStore'])->name('dashboard.movies.episodes.quality.store')->middleware(['permission:movies.update']);
    Route::post("/movies/{movie}/episodes/quality/upload", [MoviesController::class,'qualityUpload'])->name('dashboard.movies.episodes.quality.upload')->middleware(['permission:movies.update']);
    Route::get("/movies/edit/{movie}", [MoviesController::class,"edit"])->name("dashboard.movies.edit")->middleware(['permission:movies.update']);
    Route::post("/movies/update/{movie}", [MoviesController::class,"update"])->name("dashboard.movies.update")->middleware(['permission:movies.update']);
    Route::get("/movies/destroy/{movie}", [MoviesController::class,"destroy"])->name("dashboard.movies.destroy")->middleware(['permission:movies.delete']);
    Route::POST("/movies/multidelete", [MoviesController::class,"multiDelete"])->name("dashboard.movies.multiDelete")->middleware(['permission:movies.delete']);
    Route::get("/movies/search/actors", [MoviesController::class,"searchActors"])->name("dashboard.movies.search.actors")->middleware(['permission:movies.update']);
    Route::get("/movies/search/collections", [MoviesController::class,"searchCollections"])->name("dashboard.movies.search.collections")->middleware(['permission:movies.update']);

    // Collection Routes
    Route::get("/collections/", [CollectionsController::class,"index"])->name("dashboard.collections")->middleware(['permission:collections.view']);
    Route::get("/collections/create", [CollectionsController::class,"create"])->name("dashboard.collections.create")->middleware(['permission:movies.create']);
    Route::post("/collections/store", [CollectionsController::class,"store"])->name("dashboard.collections.store")->middleware(['permission:movies.create']);
    Route::get("/collections/edit/{collection}", [CollectionsController::class,"edit"])->name("dashboard.collections.edit")->middleware(['permission:movies.update']);
    Route::post("/collections/update/{collection}", [CollectionsController::class,"update"])->name("dashboard.collections.update")->middleware(['permission:movies.update']);
    Route::get("/collections/destroy/{collection}", [CollectionsController::class,"destroy"])->name("dashboard.collections.destroy")->middleware(['permission:movies.delete']);
    Route::POST("/collections/multidelete", [CollectionsController::class,"multiDelete"])->name("dashboard.collections.multiDelete")->middleware(['permission:movies.delete']);

    // Roles Route
    Route::get("/roles/", [RolesController::class,"index"])->name("dashboard.roles")->middleware(['permission:pr.view']);
    Route::get("/roles/create", [RolesController::class,"create"])->name("dashboard.roles.create")->middleware(['permission:pr.create']);
    Route::post("/roles/store", [RolesController::class,"store"])->name("dashboard.roles.store")->middleware(['permission:pr.create']);
    Route::get("/roles/edit/{role}", [RolesController::class,"edit"])->name("dashboard.roles.edit")->middleware(['permission:pr.update']);
    Route::post("/roles/update/{role}", [RolesController::class,"update"])->name("dashboard.roles.update")->middleware(['permission:pr.update']);
    Route::get("/roles/destroy/{role}", [RolesController::class,"destroy"])->name("dashboard.roles.destroy")->middleware(['permission:pr.delete']);
    Route::POST("/roles/multidelete", [RolesController::class,"multiDelete"])->name("dashboard.roles.multiDelete")->middleware(['permission:pr.delete']);

    // Permissions Route
    Route::get("/permissions/", [PermissionsController::class,"index"])->name("dashboard.permissions")->middleware(['permission:pr.view']);
    Route::get("/permissions/create", [PermissionsController::class,"create"])->name("dashboard.permissions.create")->middleware(['permission:pr.create']);
    Route::post("/permissions/store", [PermissionsController::class,"store"])->name("dashboard.permissions.store")->middleware(['permission:pr.create']);
    Route::get("/permissions/edit/{permission}", [PermissionsController::class,"edit"])->name("dashboard.permissions.edit")->middleware(['permission:pr.update']);
    Route::post("/permissions/update/{permission}", [PermissionsController::class, "update"])->name("dashboard.permissions.update")->middleware(['permission:pr.update']);
    Route::get("/permissions/destroy/{permission}", [PermissionsController::class,"destroy"])->name("dashboard.permissions.destroy")->middleware(['permission:pr.delete']);
    Route::POST("/permissions/multidelete", [PermissionsController::class,"multiDelete"])->name("dashboard.permissions.multiDelete")->middleware(['permission:pr.delete']);

    // Lists Route
    Route::get("/lists/", [ListsController::class,"index"])->name("dashboard.lists")->middleware(['permission:lists.view']);
    Route::get("/lists/create", [ListsController::class,"create"])->name("dashboard.lists.create")->middleware(['permission:lists.create']);
    Route::post("/lists/store", [ListsController::class,"store"])->name("dashboard.lists.store")->middleware(['permission:lists.create']);
    Route::get("/lists/edit/{list}", [ListsController::class,"edit"])->name("dashboard.lists.edit")->middleware(['permission:lists.update']);
    Route::post("/lists/update/{list}", [ListsController::class,"update"])->name("dashboard.lists.update")->middleware(['permission:lists.update']);
    Route::get("/lists/destroy/{list}", [ListsController::class,"destroy"])->name("dashboard.lists.destroy")->middleware(['permission:lists.delete']);
    Route::POST("/lists/multidelete", [ListsController::class,"multiDelete"])->name("dashboard.lists.multiDelete")->middleware(['permission:lists.delete']);

    // Settings Route
    Route::get("/settings", [SettingsController::class,"edit"])->name("dashboard.settings.edit")->middleware(['role:super|admin']);
    Route::post("/settings/update/", [SettingsController::class,"update"])->name("dashboard.settings.update")->middleware(['role:super|admin']);

    // Payments Route
    Route::get('/payments', [PaymentsController::class, 'index'])->name('dashboard.payments')->middleware(['permission:payments.view']);

    // Subscriptions Route
    Route::get('/subscriptions', [SubscriptionsController::class, 'index'])->name('dashboard.subscriptions')->middleware(['permission:subscriptions.view']);
    Route::get('/subscriptions/disable/{subscription}', [SubscriptionsController::class, 'disable'])->name('dashboard.subscriptions.disable')->middleware(['permission:subscriptions.update']);
    Route::get('/subscriptions/enable/{subscription}', [SubscriptionsController::class, 'enable'])->name('dashboard.subscriptions.enable')->middleware(['permission:subscriptions.update']);

    // Comments Route
    Route::get('/comments', [CommentsController::class, 'index'])->name('dashboard.comments')->middleware(['permission:comments.view']);
    Route::get('/comments/show/{comment}', [CommentsController::class, 'show'])->name('dashboard.comments.show')->middleware(['permission:comments.view']);
    Route::get("/comments/destroy/{comment}/{reply?}", [CommentsController::class,"destroy"])->name("dashboard.comments.destroy")->middleware(['permission:comments.delete']);
    Route::get('/comments/verify/{comment}/{reply?}', [CommentsController::class, 'verify'])->name('dashboard.comments.verify')->middleware(['permission:comments.view']);

    Route::get("/tickets", [TicketsController::class, "index"])->name('dashboard.tickets')->middleware(['permission:tickets.view']);
    Route::get('/tickets/show/{ticket}', [TicketsController::class, 'show'])->name('dashboard.tickets.show')->middleware(['permission:tickets.view']);
    Route::get('/tickets/close/{ticket}', [TicketsController::class, 'close'])->name('dashboard.tickets.close')->middleware(['permission:tickets.update']);
    Route::post('/tickets/answer/{ticket}', [TicketsController::class, 'answer'])->name('dashboard.tickets.answer')->middleware(['permission:tickets.update']);

    // Activity Log Routes
    Route::get('/activity', [ActivityController::class, 'index'])->name('dashboard.activity')->middleware(['permission:activity.view']);

    // Requirement Routes
    Route::get('/requirements', [RequirementsController::class, 'index'])->name('dashboard.requirements')->middleware(['permission:requirements.view']);
    Route::get('/requirements/create', [RequirementsController::class, 'create'])->name('dashboard.requirements.create')->middleware(['permission:requirements.create']);
    Route::post('/requirements/store', [RequirementsController::class, 'store'])->name('dashboard.requirements.store')->middleware(['permission:requirements.create']);
    Route::get('/requirements/edit/{requirement}', [RequirementsController::class, 'edit'])->name('dashboard.requirements.edit')->middleware(['permission:requirements.update']);
    Route::post('/requirements/update/{requirement}', [RequirementsController::class, 'update'])->name('dashboard.requirements.update')->middleware(['permission:requirements.update']);
    Route::get('/requirements/destroy/{requirement}', [RequirementsController::class, 'destroy'])->name('dashboard.requirements.destroy')->middleware(['permission:requirements.delete']);
    Route::post('/requirements/multidelete', [RequirementsController::class, 'multiDelete'])->name('dashboard.requirements.multiDelete')->middleware(['permission:requirements.delete']);

    // Newletter Routes
    Route::get('/newsletter', [NewsletterController::class, 'index'])->name('dashboard.newsletter');
    Route::get('/newsletter/create', [NewsletterController::class, 'create'])->name('dashboard.newsletter.create');
    Route::post('/newsletter/send', [NewsletterController::class, 'send'])->name('dashboard.newsletter.send');
    Route::get('/newsletter/destroy/{newsletter}', [NewsletterController::class, 'destroy'])->name('dashboard.newsletter.destroy');
    Route::post('/newsletter/multidelete', [NewsletterController::class, 'multiDelete'])->name('dashboard.newsletter.multiDelete');

    // Notification Routes
    Route::get('/announcements/{announcement}', [DashboardController::class, 'handleAnnouncements'])->name('dashboard.announcements');
});

Route::group(["middleware" => ShareVarriableMiddleware::class], function (){
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/movie/{slug}', [IndexController::class, 'movie'])->name('index.movie');
    Route::get('/movie/{slug}/download/{quality}', [IndexController::class, 'download'])->name('index.movie.download')->middleware(AuthMiddleware::class);
    Route::get('/movie/{slug}/watch/{episode}', [IndexController::class, 'watch'])->name('index.movie.watch')->middleware(AuthMiddleware::class);
    Route::post('/watch/progress/',[IndexController::class, 'watchProgress'])->name('index.movie.watch.progress')->middleware(AuthMiddleware::class);
    Route::get('/stream/', [IndexController::class, 'stream'])->name('index.movie.stream')->middleware(AuthMiddleware::class);
    Route::get('/search', [IndexController::class, 'search'])->name('index.search');
    Route::get('/category/{category}/{category_value?}', [IndexController::class, "category"])->name('index.category');
    Route::get('plans', [IndexController::class, 'plans'])->name('index.plans');
    Route::get('/checkout/{plan}',[IndexController::class, 'checkout'])->name('index.checkout');
    Route::post('/checkout/{plan}',[IndexController::class, 'checkoutSubmit'])->name('index.checkout.submit');
    Route::any('/checkout/callback/{plan}/{transaction_id}', [IndexController::class, 'callback'])->name('index.checkout.callback');
    Route::post('/likes/{slug}', [IndexController::class,'likes'])->name('index.likes');
    Route::post('/cmlikes/{slug}', [IndexController::class,'cmLikes'])->name('index.cm.likes');
    Route::get('/contact-us', [IndexController::class, 'contactus'])->name('index.contactus');
    Route::post('/contact-us', [IndexController::class, 'contactusSend'])->name('index.contactus.send');
    Route::get('/requirements/{slug}', [IndexController::class, 'requirements'])->name('index.requirements');
    Route::post('/newsletter', [IndexController::class,'newsletter'])->name('index.newsletter');
});

Route::group(['prefix' => 'blog', 'middleware' => ShareVarriableMiddleware::class], function (){
    Route::get("/", [BlogController::class, "index"])->name('blog.index');
    Route::get('/article/{slug}', [BlogController::class, 'article'])->name('blog.article');
    Route::post('article/sendComment/{type}/{id}', [BlogController::class, 'sendComment'])->name('blog.article.sendcomment');
    Route::get('articles/tag/{tag}',[BlogController::class, 'tag'])->name('blog.articles.tag');
    Route::get('search', [BlogController::class, 'search'])->name('blog.search');
    Route::get('/author/{user}', [BlogController::class, 'author'])->name('blog.article.author');
    
});

// User Panel Login - Register - Reset Password
Route::get('panel/login', [\App\Http\Controllers\Panel\LoginController::class, 'login'])->name('panel.login');
Route::get('panel/register', [\App\Http\Controllers\Panel\LoginController::class, 'register'])->name('panel.register');
Route::post('panel/register', [\App\Http\Controllers\Panel\LoginController::class, 'doRegister'])->name('panel.register.do');
Route::post('panel/login', [\App\Http\Controllers\Panel\LoginController::class, 'doLogin'])->name('panel.login.do');
Route::get('panel/logout', [\App\Http\Controllers\Panel\LoginController::class, 'logout'])->name('panel.logout');
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('panel.password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('panel.password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('panel.password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('panel.password.update');

Route::group( ['prefix' => 'panel', 'middleware' => [AuthMiddleware::class, 'permission:panel.login', ShareVarriableMiddleware::class]],function (){
    Route::get('/', [PanelController::class, 'index'])->name('panel.index');

    // Tickets Route
    Route::get('/ticket', [PanelController::class, 'tickets'])->name('panel.tickets');
    Route::get('/ticket/send', [PanelController::class, 'sendTicket'])->name('panel.tickets.send');
    Route::post('/ticket/send/{ticket?}', [PanelController::class, 'sendTicketDo'])->name('panel.tickets.send.do');
    Route::get('/ticket/show/{ticket}',[PanelController::class, 'showTicket'])->name('panel.tickets.show');

    // Comments Route
    Route::get('/comments', [PanelController::class, 'comments'])->name('panel.comments');
    
    //Liked Movies Route
    Route::get('/liked', [PanelController::class, 'likedMovies'])->name('panel.likedMovies');

    // Watch Movies Route
    Route::get('/watched', [PanelController::class, 'watched'])->name('panel.watched');

    Route::get('/account', [PanelController::class, 'account'])->name('panel.account');
    Route::post('/account', [PanelController::class, 'accountUpdate'])->name('panel.account.update');
    Route::post('/account/avatar/upload', [PanelController::class, 'avatarUpload'])->name('panel.account.avatar.upload');
});