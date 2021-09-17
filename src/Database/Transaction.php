<?php

namespace Gus\Foundation\Database;

use Closure;

trait Transaction
{
    /**
     * @param  \Closure  $closure
     * @return mixed
     */
    public function transaction(Closure $closure)
    {
        return \DB::transaction($closure);
    }
}
