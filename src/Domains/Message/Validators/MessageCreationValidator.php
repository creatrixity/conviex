<?php

namespace App\Domains\Message\Validators;

use App\Foundation\AppValidator;

class MessageCreationValidator extends AppValidator {

    protected $rules = [
        'body' =>  'required',
    ];

}
