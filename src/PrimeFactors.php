<?php

namespace App;

class PrimeFactors
{
    public function generate($number)
    {
        $prime_function = [];

        for ($divisor = 2; $number > 1; $divisor++) {
            for (; $number % $divisor == 0; $number /= $divisor) {
                $prime_function[] = $divisor;
            }
        }

        return $prime_function;
    }
}
