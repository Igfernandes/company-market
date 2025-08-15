<?php

use App\Components\Private\MsgCenter\Message;
?>
<div component='msg-center' class="cursor-pointer relative">
    <div component='msg-center:icon' data-popup='msg-center'>
        <i class="bi bi-chat-square-text-fill text-hover text-xl"></i>
    </div>
    <div component='msg-center:popup' data-target-popup='msg-center' class="absolute right-0 min-w-[15rem] shadow bg-light border-accent border-2 shadow rounded-md">
        <div class="message-title text-center text-light bg-accent p-1">
            <span>Mensagens</span>
        </div>
        <div class="message-content px-1 overflow-y-auto max-h-36">
            <?= Message::render(); ?>
            <?= Message::render(); ?>
            <?= Message::render(); ?>
            <?= Message::render(); ?>
            <?= Message::render(); ?>
        </div>
        <hr>
        <div class="message-footer">
            <div class="text-center">
                <a href=""
                    class="block w-80 bg-accent-light text-hover font-poppins text-sm py-1 rounded-sm mx-auto my-4">
                    <strong>Ver mensagens</strong>
                </a>
            </div>
        </div>
    </div>
</div>