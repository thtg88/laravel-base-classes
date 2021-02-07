<?php

namespace Thtg88\LaravelBaseClasses\Http\Requests;

use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\UpdateRequestInterface;

class UpdateRequest extends Request implements UpdateRequestInterface
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

        return $this->user()->can('update', $this->resource);
    }
}
