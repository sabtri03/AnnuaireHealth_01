<?php
/**
 * Created by PhpStorm.
 * User: strifi
 * Date: 07-Feb-19
 * Time: 21:06
 */

namespace App\Services;


class Mailer
{

    private $mailer;
    /**
     *
     *@var $mailer \swift_Mailer $mailer
     */
    Public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer =$mailer;
    }

    Public function sendMail($context="default", $email)
    {
        $message = (new \Swift_Message('hello world'))
            ->setFrom("sabtri@hotmail.com")
            ->setTo($email)
            ->setBody(
                "Hello"
            );
        $this->mailer->send($message);
        Return;
    }

}