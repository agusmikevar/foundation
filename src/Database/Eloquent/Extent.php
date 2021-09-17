<?php

namespace Gus\Foundation\Database\Eloquent;

trait Extent
{
    /**
     * Scope the multiple scope.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $scopes
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExtent($query, $scopes)
    {
        foreach ($scopes as $scope) $query = $query->{$scope}();
        return $query;
    }
}
