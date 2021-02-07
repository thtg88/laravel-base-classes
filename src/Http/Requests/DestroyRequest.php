<?php

namespace Thtg88\LaravelBaseClasses\Http\Requests;

use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\DestroyRequestInterface;

class DestroyRequest extends Request implements DestroyRequestInterface
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        if ($this->authorizeResourceExist() === false) {
            return false;
        }

        return $this->user()->can('delete', $this->resource);
    }
}
