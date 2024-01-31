<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class SlackService
{
    protected $webhookUrl;

    public function __construct($webhookUrl)
    {
        $this->webhookUrl = $webhookUrl;
    }

    public function sendMessage($message)
    {
        $client = new Client();

        $client->post($this->webhookUrl, [
            'json' => [
                'text' => $message,
            ],
        ]);
    }
}
