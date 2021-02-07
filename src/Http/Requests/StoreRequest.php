<?php

namespace Thtg88\LaravelBaseClasses\Http\Requests;

use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\StoreRequestInterface;

class StoreRequest extends Request implements StoreRequestInterface
{
    protected string $model_classname;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', $this->model_classname);
    }
}
