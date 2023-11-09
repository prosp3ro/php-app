<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Enums\OrderStatusesEnum;
use AttributesRouter\Attribute\Route;

class HomeController
{
    #[Route('/', name: 'index', methods: ['GET'])]
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

    #[Route('/arr', 'GET')]
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
