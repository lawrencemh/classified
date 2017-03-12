<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the user's favourite listings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphByMany
     */
    public function favouriteListings()
    {
        return $this->morphedByMany(Listing::class, 'favouriteable')
            ->withPivot('created_at')
            ->orderByPivot('created_at', 'desc');
    }
}
