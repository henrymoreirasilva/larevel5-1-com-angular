<?php

namespace CodeProject\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'progress' => 'required|max:100',
        'status' => 'required|max:5',
        'due_date' => 'required|date',
        'owner_id' => 'required',
        'client_id' => 'required'
   ];
}
