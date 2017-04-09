<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class StreetValidator extends LaravelValidator {

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'required' => '	res_quar_id=>required',
            'required' => '	name=>required',
            'required' => '	map=>required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'required' => '	res_quar_id=>required',
            'required' => '	name=>required',
            'required' => '	map=>required',
        ],
    ];

}
