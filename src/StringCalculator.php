<?php

namespace App;

class StringCalculator
{
    /**
     * The maximum number allowed.
     */
    const MAX_NUMBER_ALLOWED = 1000;

    /**
     * The delimiter for the numbers.
     *
     * @var string
     */
    protected string $delimiter = ",|\n";

    /**
     * Add the given numbers.
     *
     * @param  string  $numbers
     * @return int
     */
    public function add($numbers)
    {
        if (empty($numbers)) {
            return 0;
        }

        $this->disallowNegatives($numbers = $this->parseString($numbers));

        return array_sum(
            $this->ignoreGreaterThanMaxNumber($numbers)
        );
    }

    /**
     * Parse the numbers string.
     *
     * @param  string  $numbers
     * @return array
     */
    protected function parseString(string $numbers): array
    {
        $customDelimiter = '\/\/(.)\n';

        if (preg_match("/{$customDelimiter}/", $numbers, $matches)) {
            $this->delimiter = $matches[1];

            $numbers = str_replace($matches[0], '', $numbers);
        }

        return preg_split("/{$this->delimiter}/", $numbers);
    }

    /**
     * Throw an exception if the numbers contain negatives.
     *
     * @param  array  $numbers
     * @return void
     */
    protected function disallowNegatives(array $numbers): void
    {
        foreach ($numbers as $key => $number) {
            if ($number < 0) {
                throw new \Exception("Invalid number provided: {$number}");
            }
        }
    }

    /**
     * Ignore numbers greater than 1000.
     *
     * @param  array  $numbers
     * @return array
     */
    protected function ignoreGreaterThanMaxNumber(array $numbers): array
    {
        return array_filter($numbers, fn ($number) => $number < self::MAX_NUMBER_ALLOWED);
    }
}
