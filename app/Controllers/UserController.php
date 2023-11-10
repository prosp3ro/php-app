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

        $emailObj = (new Email())
            ->from('support@example.com')
            ->to($email)
            ->subject("Welcome")
            ->text("Thank you for signing up");

        $dsn = "smtp://localhost:1025";
        $transport = Transport::fromDsn($dsn);

        $mailer = new Mailer($transport);
        $mailer->send($emailObj);
    }
}
