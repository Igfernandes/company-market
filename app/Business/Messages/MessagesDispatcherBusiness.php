<?php

namespace App\Business\Messages;

use App\Business\BaseBusiness;
use App\Database\Models\MessagesDispatcher\MessagesDispatcherModel;

class MessagesDispatcherBusiness
{
    use BaseBusiness;

    private MessagesDispatcherModel $messagesDispatcherModel;

    public function __construct()
    {
        $this->messagesDispatcherModel = new MessagesDispatcherModel();
    }

    public function hasMessageDispatcher($query): bool
    {
        $found = $this->messagesDispatcherModel->where($query)->first();

        return !empty($found);
    }
}
