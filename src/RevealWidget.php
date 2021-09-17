<?php

namespace Gus\Foundation;

trait RevealWidget
{
    /**
     * @param  \Gus\Foundation\Widget  $widget
     * @param  \Illuminate\Http\Request  $request
     * @param  ...$args
     * @return void
     */
    public function reveal(Widget $widget, $request, ...$args)
    {
        return $widget->touch($request, ...$args);
    }
}
