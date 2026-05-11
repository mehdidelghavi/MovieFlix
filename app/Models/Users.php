<?php

namespace App\Models;

use App\Notifications\CustomResetPassword;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles,HasPermissions, LogsActivity;
    protected $guarded = ['id'];

    protected $guard_name = 'web';

    protected function password(): Attribute{
        return Attribute::make(
            set: fn($value) => Hash::make($value),
        );
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }

    public function comments(){
        return $this->hasMany(Comments::class, 'user_id', 'id')->orderByDesc('updated_at');
    }

    public function subscription(){
        return $this->hasMany(Subescriptions::class, 'user_id', 'id');
    }

    public function subs(){
        return $this->subscription
        ->where('expireDate', '>', Carbon::now());
    }

    public function hasActiveSub(){
        return $this->subscription
        ->where('expireDate', '>', Carbon::now())
        ->isNotEmpty();
    }

    public function reactions()
    {
        return $this->hasMany(MovieReaction::class);
    }

    public function watched()
    {
        return $this->belongsToMany(Movies::class, 'watch_histories', 'user_id', 'movie_id')
            ->withPivot('watched_at')
            ->withTimestamps();
    }

    public function movieLiked(){
        return $this->belongsToMany(Movies::class, 'movie_reactions', 'user_id', 'movie_id')->where('reaction', 1);
    }

    
}
