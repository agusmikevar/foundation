<?php

namespace Gus\Foundation\Database\Eloquent;

use Exception;
use Gus\Foundation\Exception\Problem;

class AuthModelException extends Exception
{
    use Problem;

    /**
     * @var array
     */
    protected $messages = [
        'model_has_no_contract' => 'Blueprint macro \':methodName\' of :model must implements '.AuthModel::class,
    ];
}
