<?php

namespace app\Traits\Eloquent;


trait PivotOrderableTrait
{
    /**
     * Order current query by pivot column.
     *
     * @param $query
     * @param string $column
     * @param string $order
     * @return mixed
     */
    public function scopeOrderByPivot($query, $column = 'created_at', $order = 'desc')
    {
        return $query->orderBy("pivot_$column", $order);
    }
}