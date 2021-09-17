<?php

namespace Gus\Foundation\Macro;

use Closure;

interface BlueprintContract
{
    /**
     * @var string
     */
    const MAIN_METHOD = 'register';

    /**
     * @return \Closure
     */
    public static function register() : Closure;
}
