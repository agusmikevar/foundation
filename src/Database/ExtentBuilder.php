<?php

namespace Gus\Foundation\Database;

use Illuminate\Support\Str;

class ExtentBuilder
{
    /**
     * The index on queue.
     * 
     * @var string
     */
    private $queueIndex = '';

    /**
     * The column on queue.
     * 
     * @var string
     */
    private $queueColumn = '';

    /**
     * Injected request.
     * 
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Store the extents.
     * 
     * @var array
     */
    private $extents = [];

    /**
     * Set the request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Gus\Foundation\Database
     */
    public function with($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Set the index to be built.
     * 
     * @param  string  $index
     * @return \Gus\Foundation\Database
     */
    public function index($index)
    {
        $this->queueIndex = $index;
        $this->queueColumn = $index;

        return $this;
    }

    /**
     * Set the column to be built
     * 
     * @param  string  $column
     * @return \Gus\Foundation\Database
     */
    public function column($column)
    {
        $this->queueColumn = $column;

        return $this;
    }

    /**
     * Execute the mode.
     * 
     * @param  string  $mode
     * @param  array   $args
     * @return \Gus\Foundation\Database
     */
    public function mode($mode, $args = [])
    {
        $args = is_array($args) ? $args : explode('|', $args);

        $mode = Str::camel($mode);
        $this->{$mode.'Mode'}(...$args);

        return $this;
    }

    /**
     * @return void
     */
    public function booleanMode()
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;

        if ($request->query($queueIndex, '*') !== '*') {
            $this->extents[] = $request->boolean($queueIndex) 
                ?   'is'.Str::studly($queueColumn)
                :   'isNot'.Str::studly($queueColumn);
        }
    }

    /**
     * Get the extents collection.
     * 
     * @return array
     */
    public function toArray()
    {
        return $this->extents;
    }

    /**
     * Prettier version of "toArray" method.
     * 
     * @return array
     */
    public function done()
    {
        return $this->toArray();
    }
}
