<?php

namespace Gus\Foundation\Database;

trait BuildExtent
{
    /**
     * @return \Gus\Foundation\Database\ExtentBuilder
     */
    public function buildExtent()
    {
        return new ExtentBuilder();
    }
}
