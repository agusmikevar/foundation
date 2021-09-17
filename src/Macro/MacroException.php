<?php

namespace Gus\Foundation\Macro;

use Exception;
use Gus\Foundation\Exception\Problem;

class MacroException extends Exception
{
    use Problem;

    /**
     * @var array
     */
    protected $messages = [
        'blueprint_has_no_contract' => 'Blueprint macro \':methodName\' of :blueprint must implements '.BlueprintContract::class,
        'rule_has_no_contract' => 'Blueprint macro \':ruleName\' of :rule must implements '.RuleContract::class,
    ];
}
