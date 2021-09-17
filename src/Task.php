<?php

namespace Gus\Foundation;

use Gus\Foundation\Database\{
    BuildWhere,
    Transaction,
};

abstract class Task
{
    use BuildWhere, Transaction;

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    abstract public function handle($request);
}
