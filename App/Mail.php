<?php

namespace App;

use App\Config;
use Mailgun\Mailgun;

/**
 * Mail
 *
 * PHP version 7.0
 * 
 * https://www.mailgun.com/
 * https://github.com/mailgun/mailgun-php
 * https://documentation.mailgun.com/libraries.html#php
 */
class Mail
{

    /**
     * Send a message
     *
     * @param string $to Recipient
     * @param string $subject Subject
     * @param string $text Text-only content of the message
     * @param string $html HTML content of the message
     *
     * @return mixed
     */
    public static function send($to, $subject, $text, $html)
    {
//        $mg = new Mailgun(Config::MAILGUN_API_KEY);
//        if happens Http\Client\Exception\RequestException cURL error 60: SSL certificate problem: unable to get local issuer certificate...
//        https://github.com/mailgun/mailgun-php/issues/130
//        fix using:
        $client = new \GuzzleHttp\Client([
            'verify' => false,
        ]);
        $adapter = new \Http\Adapter\Guzzle6\Client($client);
        $mg = new Mailgun(Config::MAILGUN_API_KEY, $adapter);
        
        $domain = Config::MAILGUN_DOMAIN;

        $mg->sendMessage($domain, ['from'    => 'postmaster@mailgun.org', //'from'    => 'your-sender@your-domain.com'
                                   'to'      => $to,
                                   'subject' => $subject,
                                   'text'    => $text,
                                   'html'    => $html]);
    }
}
