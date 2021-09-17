<?php

namespace Gus\Foundation\Exception;

use Illuminate\Support\Str;

trait Problem
{
    /**
     * @var array
     */
    public array $replacers = [];

    /**
     * @param  mixed  $problem
     * @param  array  $replacers
     * @return void
     */
    public function problem($problem, $replacers = [])
    {
        $message = $this->messages[$problem];
        foreach ($replacers as $index => $replace) {
            $index = ':'.$index;
            $message = Str::replaceFirst($index, $replace, $message);
        }
        $this->message = $message;
        $this->replacers = $replacers;
    }
}
