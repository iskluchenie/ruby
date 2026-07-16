<?php

namespace App\Handlers;

use Illuminate\Support\Stringable;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class TgWebhookHandler extends WebhookHandler
{
    protected function handleChatMessage(Stringable $text): void
    {
        $this->chat->html("Вы написали: $text")->send();
    }
}
