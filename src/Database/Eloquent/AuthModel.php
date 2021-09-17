<?php

namespace Gus\Foundation\Database\Eloquent;

interface AuthModel
{
    /**
     * @param  array  $refs
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function getAuthorization($refs);
}
