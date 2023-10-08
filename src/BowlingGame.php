<?php

namespace App;

class BowlingGame
{
    const FRAMES_PER_GAME = 10;

    protected $rolls = [];

    public function roll($pins)
    {
        $this->rolls[] = $pins;
    }

    public function score()
    {
        $roll = 0;
        $score = 0;

        foreach (range(1, self::FRAMES_PER_GAME) as $frame) {
            if ($this->isStrike($roll)) {
                $score += $this->pinCount($roll) + $this->strikeBonus($roll);
                $roll++;
                continue;
            }

            $score += $this->defaultFrameScore($roll);

            if ($this->isSpare($roll)) {
                $score += $this->spareBonus($roll);
            }

            $roll += 2;
        }

        return $score;
    }

    /**
     * @param $roll
     * @return int
     */
    protected function defaultFrameScore(int $roll): int
    {
        return $this->pinCount($roll) + $this->pinCount($roll + 1);
    }

    /**
     * @param $roll
     * @return bool
     */
    protected function isSpare(int $roll): bool
    {
        return $this->defaultFrameScore($roll) === 10;
    }

    /**
     * @param $roll
     * @return bool
     */
    protected function isStrike(int $roll): bool
    {
        return $this->pinCount($roll) === 10;
    }

    /**
     * @param $roll
     * @return int
     */
    protected function strikeBonus(int $roll): int
    {
        return $this->pinCount($roll + 1) + $this->pinCount($roll + 2);
    }

    /**
     * @param $roll
     * @return int
     */
    protected function spareBonus(int $roll): int
    {
        return $this->pinCount($roll + 2);
    }

    /**
     * @param $roll
     * @return int
     */
    protected function pinCount(int $roll): int
    {
        return $this->rolls[$roll];
    }
}
