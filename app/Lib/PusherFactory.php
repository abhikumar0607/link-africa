<?php

namespace App\Lib;


use Pusher\Pusher;

class PusherFactory
{
    public static function make()
    {
        // You can get all this keys from pusher.com. After register of your app.
        $options = array(
            'cluster' => 'ap2',
            'encrypted' => true
        );
        return new Pusher(
            'fd2d9d84a885929af982',
            'a0da7d825f1290b56235',
            '1567817',
            $options
        );
    }
}