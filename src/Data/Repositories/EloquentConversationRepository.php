<?php

namespace App\Data\Repositories;

use Framework\Conversation;

use App\Data\Contracts\ConversationRepositoryInterface;

class EloquentConversationRepository extends Repository implements ConversationRepositoryInterface
{
    public function __construct()
    {
        $this->conversation = new Conversation;

        parent::__construct($this->conversation);
    }

}
