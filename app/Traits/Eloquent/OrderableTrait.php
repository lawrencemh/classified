<?php

namespace app\Traits\Eloquent;


trait OrderableTrait
{
    /**
     * Order results by newest entities first.
     *
     * @param $query
     * @return mixed
     */
    public function scopeLatestFirst($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}