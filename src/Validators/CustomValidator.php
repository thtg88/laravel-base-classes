<?php

namespace Thtg88\LaravelBaseClasses\Validators;

use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{
    use Concerns\WithUniqueCaseInsensitiveValidation;
}
