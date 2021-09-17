<?php

namespace Gus\Foundation\Http;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    /**
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->afterValidation();
        });
    }

    /**
     * @return void
     */
    protected function afterValidation()
    {
        
    }
}
