<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotController extends Controller
{

    public function getMe()
    {
        #dd(Telegram::getAccessToken());
        $keyboard = [
            ['7', '8', '9'],
            ['4', '5', '6'],
            ['1', '2', '3'],
            ['0']
        ];
        $response = Telegram::getMe();
        $botId = $response->getId();

        $firstName = $response->getFirstName();
        $username = $response->getUsername();
        $reply_markup = Telegram::replyKeyboardMarkup([
            'keyboard' => $keyboard,
            'resize_keyboard' => true,
            'one_time_keyboard' => true
        ]);

        $response = Telegram::sendMessage([
            'chat_id' => '99339886',
            'text' => 'Hello World',
            'reply_markup' => $reply_markup
        ]);
        dd($botId, $firstName, $username, $response);
    }

    public function setWebHook(Request $request)
    {
        // Don't forget to setup a POST route in your Laravel Project.
        return $this->bot->setWebhook(['url' => sprintf('%s/%s/webhook', $this->botUri, $this->botToken)]);
    }

    public function getWebHook(Request $request)
    {
        // $this->bot->getWebhookUpdates()
        // Don't forget to setup a POST route in your Laravel Project.
        // $response = Telegram::getWeb(['url' => 'https://example.com/<token>/webhook']);
        //dd($response);
    }
}
