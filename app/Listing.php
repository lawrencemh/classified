<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Category;
use App\Area;
use App\Traits\Eloquent\OrderableTrait;
use App\Traits\Eloquent\PivotOrderableTrait;

class Listing extends Model
{
    /**
     * Enable soft deleting.
     */
    use SoftDeletes;

    /**
     * Enable ordering
     */
    use OrderableTrait;

    /**
     * Enable pivot ordering
     */
    use PivotOrderableTrait;

    /**
     * Return the user the listing belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the category the listing belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Return the area the listing belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * Returns the price of the listing.
     *
     * @return float
     */
    public function cost()
    {
        return (float) $this->category->price;
    }

    /**
     * Returns a listing's status.
     *
     * @return boolean
     */
    public function live()
    {
        return (boolean) $this->is_live;
    }

    /**
     * Determines if a listing is owned by a user.
     *
     * @param \App\User $user
     * @return bool
     */
    public function ownedByUser(User $user)
    {
        return $this->user->id === $user->id;
    }

    /**
     * Query all non-live listings.
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsNotLive($query)
    {
        return $query->where('is_live', false);
    }

    /**
     * Query all live listings.
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsLive($query)
    {
        return $query->where('is_live', true);
    }

    /**
     * Query where a particular category.
     *
     * @param $query
     * @param \App\Category $category
     * @return mixed
     */
    public function scopeFromCategory($query, Category $category)
    {
        return $query->where('category_id', $category->id);
    }

    /**
     * Query listings in a particular area.
     *
     * @param $query
     * @param \App\Area $area
     * @return mixed
     */
    public function scopeInArea($query, Area $area)
    {
        // get all descendants/children of $area
        $area_children = $area
            ->descendants()
            ->pluck('id')
            ->toArray();

        // merge the area_id with its children ids and query all listings with these area_ids
        return $query->whereIn('area_id', array_merge(
            [$area->id],
            $area_children
        ));
    }

    /**
     * Eager load area.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function scopeWithArea($query)
    {
        return $query->with(['area']);
    }

    /**
     * Eager load user.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function scopeWithUser($query)
    {
        return $query->with(['user']);
    }

    /**
     * Returns the Listing's users that have added this post to their favourites.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function favourites()
    {
        return $this->morphToMany(User::class, 'favouriteable');
    }

    /**
     * Returns true if user has added this listing to their favourites.
     *
     * @param \App\User $user
     * @return boolean
     */
    public function favouritedBy(User $user)
    {
        return $this->favourites->contains($user);
    }

    /**
     * Return the users that have viewed this listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function viewedUsers()
    {
        return $this->belongsToMany(User::class, 'user_listing_views')
            ->withTimestamps()
            ->withPivot(['count']);
    }

    /**
     * Returns the total user views for this listing.
     *
     * @return int
     */
    public function getViewedCount()
    {
        return $this->viewedUsers()->sum('count');
    }


}
