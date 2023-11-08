<?php

declare(strict_types=1);

namespace App;

class ReadOnlyPropertyExample
{
    public function __construct(
        public readonly string $street,
        public readonly string $city,
        public readonly string $state,
        public readonly string $postalCode,
        public readonly string $country,
    )
    {
    }
}
