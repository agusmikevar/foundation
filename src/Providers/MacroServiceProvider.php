<?php

namespace Gus\Foundation\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Validator;
use Gus\Foundation\Macro\{
    MacroException,
    BlueprintContract,
    RuleContract,
};

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBlueprintMacros();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootRuleMacros();
    }

    /**
     * @throws \Gus\Foundation\Macro\MacroException
     * @return void
     */
    public function registerBlueprintMacros()
    {
        if ( ! config('gus_foundation.macro.register.blueprints')) return;

        $kernels = $this->getMacroKernels();
        foreach ($kernels as $kernel) {
            if ( ! class_exists($kernel)) {
                continue;
            }
            
            $blueprints = $kernel::$blueprints;

            foreach ($blueprints as $methodName => $blueprintClass) {
                $blueprint = new $blueprintClass;
                if ( ! $blueprint instanceof BlueprintContract) {
                    $exception = new MacroException;
                    $exception->problem('blueprint_has_no_contract', [
                        'methodName' => $methodName,
                        'blueprint' => $blueprintClass,
                    ]);
                    throw $exception;
                }
                Blueprint::macro(
                    $methodName,
                    call_user_func([
                        $blueprint,
                        BlueprintContract::MAIN_METHOD
                    ])
                );
            }
        }
    }

    /**
     * @return void
     */
    private function bootRuleMacros()
    {
        if ( ! config('gus_foundation.macro.register.rules')) return;

        $kernels = $this->getMacroKernels();
        foreach ($kernels as $kernel) {
            if ( ! class_exists($kernel)) {
                continue;
            }
            
            $rules = $kernel::$rules;

            foreach ($rules as $ruleName => $ruleClass) {
                $ruleName = config('gus_foundation.macro.config.rule.prefix').'_'.$ruleName;

                $rule = new $ruleClass;
                if ( ! $rule instanceof RuleContract) {
                    $exception = new MacroException;
                    $exception->problem('rule_has_no_contract', [
                        'ruleName' => $ruleName,
                        'rule' => $ruleClass,
                    ]);
                    throw $exception;
                }

                $ruleClassMethod = $ruleClass.'@'.RuleContract::VALIDATE_METHOD;
                $replacerClassMethod = $ruleClass.'@'.RuleContract::REPLACE_METHOD;

                Validator::extend($ruleName, $ruleClassMethod);
                Validator::replacer($ruleName, $replacerClassMethod);
            }
        }
    }

    /**
     * @return array
     */
    private function getMacroKernels()
    {
        $kernels = config('gus_foundation.macro.kernel', []);
        if (is_string($kernels)) $kernels = [$kernels];
        return $kernels;
    }
}
