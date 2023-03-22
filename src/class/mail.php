<?php

namespace App\Class;


use Mailjet\Client;
use Mailjet\Resources;

class mail
{
    private string $api_key = '7714ee632d28a93be15f51517c1c7cdb';
    private string $api_key_secret = '040728defbba4f34d111db089a6cb9';

    public function send($to_mail, $to_name, $subject, $title, $subtitle, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret,true,['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "yessirinelove@gmail.com",
                        'Name' => "Yessirine"
                    ],
                    'To' => [
                        [
                            'Email' => "$to_mail",
                            'Name' => " $to_name"
                        ]
                    ],
                    'TemplateID' => 4666681,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' =>[
                        'title' => $title,
                        'subtitle' => $subtitle,
                        'content' =>$content,
                    ]

                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && dd($response->getData());
    }
}
