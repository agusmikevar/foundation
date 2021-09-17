<?php

namespace Gus\Foundation\Http;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Gus\Foundation\Database\Eloquent\{
    AuthModel,
    AuthModelException,
};
use Illuminate\Auth\AuthenticationException;

class AuthRequest extends FormRequest
{
    /**
     * @var bool
     */
    private $authenticationResult = false;

    /**
     * @return boolean
     */
    public function authorize()
    {
        if ( ! Auth::check()) throw new AuthenticationException;

        $this->authenticationResult = Authentication::authenticate($this->type, $this->refs);

        $this->afterAuthorization();

        return $this->authenticationResult;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @return void
     */
    protected function afterAuthorization()
    {
        //
    }
}
