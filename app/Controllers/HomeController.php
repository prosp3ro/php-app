<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Enums\OrderStatusesEnum;

class HomeController
{
    public function index()
    {
        dd("test");
    }

    public function order(OrderStatusesEnum $enum)
    {
        dump($enum);
        dump($enum->text());
        dump($enum->name);
        dump($enum->value);
    }
}
