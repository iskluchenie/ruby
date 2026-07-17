<?php

namespace App\Handlers;


use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Stringable;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class TgWebhookHandler extends WebhookHandler
{
    protected function handleChatMessage(Stringable $text): void
    {
        $this->chat->html("Вы написали: $text")->send();
    }

    /** * @var string[] */
    protected array $allowedCommands = [
        'start',
        'buttons',
        'chatid',
    ];

    protected function handleCommand(Stringable $text): void
    {
        [$command, $parameter] = $this->parseCommand($text);
        if (!in_array($command, $this->allowedCommands)) {
            $this->handleUnknownCommand($text);
            return;
        }
        parent::handleCommand($text);
    }

    public function start(): void
    {
        $this->buttons();
    }

    public function buttons(): void
    {
        $this->chat->message('Выберите действие:')
            ->keyboard(Keyboard::make()->buttons([
                Button::make("️Разбудить A-server")->action("wakeUpAServer"),
            ])->chunk(2))->send();
    }

    /** * Обрабатывает нажатие на кнопку с action("read") */
    public function wakeUpAServer(): void
    {
        exec("wakeonlan 44:8A:5B:24:D7:E5", $outputWakeUp);
        sleep(7);
        exec("fping -B 1 '192.168.7.7' -t370 -a -q", $outputPing);

        if (in_array('192.168.7.7', $outputPing)){
            $responseText = "A-Server теперь доступен!";
        }else{
            $responseText = "Не удалось разбудить A-Server! :" . json_encode($outputPing);
        }
        $this->reply('Команда отправлена!', true);
        $this->chat->edit($this->messageId)->markdown($responseText)->send();
    }
}
