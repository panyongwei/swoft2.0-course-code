<?php
/**
 * +----------------------------------------------------------------------
 * |
 * +----------------------------------------------------------------------
 * | Copyright (c) 2019 http://www.sunnyos.com All rights reserved.
 * +----------------------------------------------------------------------
 * | Date：2019-08-28 01:03:57
 * | Author: Sunny (admin@mail.sunnyos.com) QQ：327388905
 * +----------------------------------------------------------------------
 */

namespace App\Bean;

class SunnySms
{
    /**
     * @var Sms
     */
    private $sms;
    /**
     * @var Email
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    public function __construct(Email $email,int $i)
    {
        $this->email = $email;
        echo "i==={$i}\n";
    }

    public function smsSend()
    {
        echo "smsSend name is {$this->name}\n";
        $this->sms->send();
    }

    public function mailSend()
    {
        $this->email->send();
    }
}
