<?php

namespace Tests;

use App\BowlingGame;
use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
    /**
     * @test
     */
    public function it_scores_zero()
    {
        $game = new BowlingGame();

        foreach (range(1, 20) as $roll) {
            $game->roll(0);
        }

        $this->assertEquals(0, $game->score(0));
    }

    /**
     * @test
     */
    public function it_scores_all_ones()
    {
        $game = new BowlingGame();

        foreach (range(1, 20) as $roll) {
            $game->roll(1);
        }

        $this->assertEquals(20, $game->score(0));
    }

    /**
     * @test
     */
    public function it_awards_a_one_roll_bonus_for_every_spare()
    {
        $game = new BowlingGame();

        $game->roll(5);
        $game->roll(5); // spare

        $game->roll(8);

        foreach (range(1, 17) as $roll) {
            $game->roll(0);
        }

        $this->assertEquals(26, $game->score(0));
    }

    /**
     * @test
     */
    public function it_awards_a_two_roll_bonus_for_every_strike()
    {
        $game = new BowlingGame();

        $game->roll(10); // strike

        $game->roll(5);
        $game->roll(3);

        $game->roll(8);

        foreach (range(1, 16) as $roll) {
            $game->roll(0);
        }

        $this->assertEquals(34, $game->score(0));
    }

    /**
     * @test
     */
    public function it_scores_a_perfect_game()
    {
        $game = new BowlingGame();

        foreach (range(1, 12) as $roll) {
            $game->roll(10);
        }

        $this->assertEquals(300, $game->score(0));
    }

    /**
     * @test
     */
    public function a_spare_on_the_final_frame_grants_one_extra_ball()
    {
        $game = new BowlingGame();

        foreach (range(1, 18) as $roll) {
            $game->roll(1);
        }

        $game->roll(5);
        $game->roll(5); // spare

        $game->roll(5);

        $this->assertEquals(33, $game->score(0));
    }

    /**
     * @test
     */
    public function a_strike_on_the_final_frame_grants_two_extra_balls()
    {
        $game = new BowlingGame();

        foreach (range(1, 18) as $roll) {
            $game->roll(1);
        }

        $game->roll(10); // strike

        $game->roll(5);
        $game->roll(5);

        $this->assertEquals(38, $game->score(0));
    }
}
