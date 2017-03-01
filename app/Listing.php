<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Category;
use App\Area;
use app\Traits\Eloquent\OrderableTrait;

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
    public function isLive()
    {
        return (boolean) $this->is_live;
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
            [$area_id],
            $area_children
        ));
    }


}