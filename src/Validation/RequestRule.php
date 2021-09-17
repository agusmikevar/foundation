<?php

namespace Gus\Foundation\Validation;

use Illuminate\Http\Request;
use Gus\Foundation\Database\BuildWhere;

abstract class RequestRule
{
    use BuildWhere;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $message;

    /**
     * @param  \Illuminate\Http\Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param  string
     * @return void
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
