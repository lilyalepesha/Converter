<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

/**
 *
 */
class Telegram
{

    /**
     * @var string $token
     */
    protected string $token;
    /**
     *
     */
    const url = "https://api.tlgr.org/bot";

    /**
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @param $chatId
     * @param $message
     * @return void
     */
    public function sendMessage($chatId, $message)
    {
        Http::post(self::url . $this->token . '/sendMessage', [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'html',
        ]);
    }
}
