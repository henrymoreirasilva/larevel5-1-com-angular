<?php

namespace CodeProject\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{

    protected $rules = [
        //ValidatorInterface::RULE_CREATE => [],
       // ValidatorInterface::RULE_UPDATE => [],
        'name' => 'required|max:255',
        'email' => 'required|email',
        'responsible' => 'required|max:255',
        'phone' => 'required',
        'address' => 'required'
   ];
}
