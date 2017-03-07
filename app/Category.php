<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Listing;
use App\Area;

class Category extends Model
{
    /**
     * Enable NestedSet functionality.
     */
    use NodeTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'price',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the listings for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    /**
     * Get listings for an area and its children.
     *
     * @param $query
     * @param \App\Area $area
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithListingsInArea($query, Area $area)
    {
        return $query->with(['listings' => function($q) use($area) {
            $q->isLive()->inArea($area);
        }]);
    }
}
