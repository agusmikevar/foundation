<?php

namespace Gus\Foundation\Http;

class AuthIdRequest extends AuthRequest
{
    /**
     * @var string
     */
    protected $model = '';

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->model = $this->model();
        $this->additionalPrepareForValidation();
    }

    /**
     * @final
     * @return array
     */
    final public function rules()
    {
        $rules = [
            'id' => [
                'required',
                config('waffleboss_foundation.macro.config.rule.prefix') .'_exists:' . $this->model,
            ],
        ];

        foreach ($this->additionalIdRules() as $idRule) {
            $rules['id'][] = $idRule;
        }

        foreach ($this->additionalRules() as $index => $rule) {
            $rules[$index] = $rule;
        }

        return $rules;
    }

    /**
     * @return array
     */
    public function additionalIdRules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function additionalRules()
    {
        return [];
    }

    protected function additionalPrepareForValidation()
    {
        return [];
    }

    /**
     * @return void
     */
    protected function model()
    {
        
    }
}
