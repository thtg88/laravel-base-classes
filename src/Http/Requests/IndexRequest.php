<?php

namespace Thtg88\LaravelBaseClasses\Http\Requests;

use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\IndexRequestInterface;

class IndexRequest extends Request implements IndexRequestInterface
{
    protected string $model_classname;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('viewAny', $this->model_classname);
    }
}
