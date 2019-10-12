<?php

namespace App\Telegram;

use Telegram\Bot\Commands\Command;

class WeatherCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'weather';

    /**
     * @var string Command Description
     */
    protected $description = 'Weather command, Get a list of commands';

    /**
     * {@inheritdoc}
     */
    public function handle($arguments)
    {
        $commands = $this->telegram->getCommands();

        $text = '';
        foreach ($commands as $name => $handler) {
            $text .= sprintf('/%s - %s' . PHP_EOL, $name, $handler->getDescription());
        }

        $this->replyWithMessage(compact('text'));
    }
}

