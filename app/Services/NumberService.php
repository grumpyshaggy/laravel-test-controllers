<?php

namespace App\Services;

class NumberService
{
    public function getRandomNumber() : int
    {
        return rand(1, 20);
    }
}