<?php

namespace Thtg88\LaravelBaseClasses\Validators;

use Illuminate\Validation\Validator as BaseValidator;

class Validator extends BaseValidator
{
    use Concerns\WithUniqueCaseInsensitiveValidation;
}
