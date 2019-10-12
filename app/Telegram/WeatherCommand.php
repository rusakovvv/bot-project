<?php

namespace App\Telegram;

use DateTime;
use DateTimeZone;
use Exception;
use GuzzleHttp\Client;
use Telegram\Bot\Actions;
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
    protected $description = 'Weather command, Get weather in Moscow';

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function handle($arguments)
    {
        $this->replyWithChatAction(['action' => Actions::TYPING]);

        $client = new Client();
        $uri = sprintf('%s524901&units=metric&APPID=%s', env('OPENWEATHERMAP_URI'), env('OPENWEATHERMAP_KEY'));
        $data = $client->get($uri);
        $weather = json_decode($data->getBody());
        $text = '';
        $text .= sprintf('Погода в Москве: %s C %s' . PHP_EOL, $weather->main->temp, $weather->weather[0]->main);
        $sunrise = new DateTime(date("Y-m-d H:i:s", $weather->sys->sunrise));
        $sunrise->setTimezone(new DateTimeZone("+3"));
        $text .= sprintf('Рассвет: %s' . PHP_EOL, $sunrise->format("Y-m-d H:i:s"));
        $sunset = new DateTime(date("Y-m-d H:i:s", $weather->sys->sunset));
        $sunset->setTimezone(new DateTimeZone("+3"));
        $text .= sprintf('Закат: %s' . PHP_EOL,   $sunset->format("Y-m-d H:i:s"));

        $this->replyWithMessage(compact('text'));
    }
}

