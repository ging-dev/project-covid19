<?php

declare(strict_types=1);

if (! function_exists('name')) {
    // Theo format Việt Nam (Họ và tên)
    function name(string $firstName, string $lastName): string
    {
        return $lastName.' '.$firstName;
    }
}
