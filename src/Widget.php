<?php

namespace Gus\Foundation;

use Gus\Foundation\Database\{
    BuildWhere,
    Transaction,
};

abstract class Widget
{
    use BuildWhere, Transaction;

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    abstract public function touch($request);
}
