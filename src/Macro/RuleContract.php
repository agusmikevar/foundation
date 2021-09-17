<?php

namespace Gus\Foundation\Macro;

interface RuleContract
{
    /**
     * @var string
     */
    const VALIDATE_METHOD = 'validate';

    /**
     * @var string
     */
    const REPLACE_METHOD = 'replace';

    /**
     * @param  string  $attribute
     * @param  mixed   $value
     * @param  array   $parameters
     * @param  \Illuminate\Validation\Validator  $validator
     * @return boolean
     */
    public function validate($attribute, $value, $parameters, $validator) : bool;

    /**
     * @param  string  $message
     * @param  string  $attribute
     * @param  string  $rule
     * @param  array   $parameters
     * @return string
     */
    public function replace($message, $attribute, $rule, $parameters) : string;
}
