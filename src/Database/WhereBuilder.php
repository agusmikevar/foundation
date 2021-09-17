<?php

namespace Gus\Foundation\Database;

use Illuminate\Support\Str;

class WhereBuilder
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
     * Request usage.
     * 
     * @var string
     */
    private $requestUsage = 'query';

    /**
     * Store the wheres.
     * 
     * @var array
     */
    private $wheres = [];

    /**
     * Set the request.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Gus\Foundation\Database\WhereBuilder
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
     * @return \Gus\Foundation\Database\WhereBuilder
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
     * @return \Gus\Foundation\Database\WhereBuilder
     */
    public function column($column)
    {
        $this->queueColumn = $column;

        return $this;
    }

    /**
     * Set the request usage.
     * 
     * @param  string  $requestUsage
     * @return \Gus\Foundation\Database\WhereBuilder
     */
    public function usage($requestUsage)
    {
        $this->requestUsage = $requestUsage;
        return $this;
    }

    /**
     * Execute the mode.
     * 
     * @param  string  $mode
     * @param  array   $args
     * @return \Gus\Foundation\Database\WhereBuilder
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
            $this->wheres[] = [
                $queueColumn, $request->boolean($queueIndex)
            ];
        }
    }

    /**
     * @return void
     */
    public function stringMode($leftWildcard = '%', $rightWildCard = '%')
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;

        $this->wheres[] = [
            $queueColumn, 'like', $leftWildcard . $this->value($queueIndex, '') . $rightWildCard
        ];
    }

    /**
     * @return void
     */
    public function strictStringMode()
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;
        $value = $this->value($queueIndex, '*');

        if ($value !== '*') {
            $this->wheres[] = [
                $queueColumn, '=', $value
            ];
        }
    }

    /**
     * @return void
     */
    public function nullableStringMode($leftWildcard = '%', $rightWildCard = '%')
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;

        $this->wheres[] = [
            function ($query) use (
                $queueColumn,
                $queueIndex,
                $leftWildcard,
                $rightWildCard,
                $request
            ) {
                return $query->where(
                    $queueColumn,
                    'like', 
                    $leftWildcard.$this->value($queueIndex, '').$rightWildCard
                )->orWhereNull($queueColumn);
            }
        ];
    }

    /**
     * @return void
     */
    public function idMode()
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;
        $value = $this->value($queueIndex, '*');

        if ($value !== '*') {
            $this->wheres[] = [
                $queueColumn, $value
            ];
        }
    }

    /**
     * @return void
     */
    public function booleanToTimestampMode()
    {
        $queueIndex = $this->queueIndex;
        $queueColumn = $this->queueColumn;
        $request = $this->request;
        
        if ($this->value($queueIndex, '*') !== '*') {
            $value = $request->boolean($queueIndex);
            $this->wheres[] = [
                $value
                    ?   (fn ($query) => $query->whereNotNull($queueColumn))
                    :   (fn ($query) => $query->whereNull($queueColumn))
            ];
        }
    }

    /**
     * @return void
     */
    public function dateMode()
    {
        $queueIndex = $this->queueIndex;
        $queueColumns = $this->queueColumn;
        $request = $this->request;
        $value = $this->value($queueIndex, date('Y-m-d'));

        $this->wheres[] = [
            (
                function ($query) use ($queueIndex, $queueColumns, $request, $value)
                {
                    foreach ($queueColumns as $i => $queueColumn) {
                        if ($i == 0) {
                            $query->whereDate($queueColumn, $value);
                        } else {
                            $query->orWhereDate($queueColumn, $value);
                        }
                    }

                    return $query;
                }
            )
        ];
    }

    /**
     * Get the wheres collection.
     * 
     * @return array
     */
    public function toArray()
    {
        return $this->wheres;
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

    /**
     * Get the value dynamically based on the request usage.
     * 
     * @param  string  $queueIndex
     * @param  mixed  $default
     * @return mixed
     */
    private function value($queueIndex, $default)
    {
        return $this->request->{$this->requestUsage}($queueIndex, $default);
    }
}
