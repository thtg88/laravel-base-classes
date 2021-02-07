<?php

namespace Thtg88\LaravelBaseClasses\Http\Requests;

use Thtg88\LaravelBaseClasses\Http\Requests\Contracts\SearchRequestInterface;

class SearchRequest extends Request implements SearchRequestInterface
{
    protected string $model_classname;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->can('search', $this->model_classname);
    }
}
