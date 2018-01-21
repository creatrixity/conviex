<?php

namespace App\Data\Repositories;

use Framework\Message;

use App\Data\Contracts\MessageRepositoryInterface;

class EloquentMessageRepository extends Repository implements MessageRepositoryInterface
{
    public function __construct()
    {
        $this->message = new Message;

        parent::__construct($this->message);
    }

}
