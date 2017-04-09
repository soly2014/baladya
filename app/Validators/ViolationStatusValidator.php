<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ViolationStatusValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
		'required'	=>'	name=>required',
	],
        ValidatorInterface::RULE_UPDATE => [
		'required'	=>'	name=>required',
	],
   ];
}
