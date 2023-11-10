<?php

declare(strict_types=1);

namespace App\Controllers;

use AttributesRouter\Attribute\Route;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class UserController
{
    // #[Route('/register', 'GET')]
    // public function create()
    // {
    //     // show registration page
    //     dd("register");
    // }

    #[Route('/register', 'GET')]
    public function register()
    {
        $username = "user";
        $email = "user@example.com";
        $password = "password";

        $html = <<<HTMLBody
            <h1 style="text-align: center">Welcome</h1>
            <br />
            Thank you for signing up
        HTMLBody;

        // email client might not support html
        $text = "Welcome. Thank you for signing up";

        $emailObj = (new Email())
            ->from('support@example.com')
            ->to($email)
            ->subject("Welcome")
            ->attach("asd", "attachment.txt")
            ->text($text)
            ->html($html);

        $transport = Transport::fromDsn($_ENV["MAILER_DSN"]);

        $mailer = new Mailer($transport);
        $mailer->send($emailObj);
    }
}
