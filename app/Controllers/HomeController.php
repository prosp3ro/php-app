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

    public function arrayUnpacking()
    {
        $arr1 = [
            "a" => "b",
            "b" => "c"
        ];

        $arr2 = [
            "c" => "d",
            "d" => "e"
        ];

        dump(array($arr1, $arr2));
        dump(array(...$arr1, ...$arr2));
    }
}
