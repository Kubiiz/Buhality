<?php

namespace App\Classes;

use App\Models\Game;
use App\Models\Player;
use Auth;

class Action
{
    public $data, $random, $player;

    public function __construct()
    {
        $this->data = Auth::user()->game->whereNull('ended')->first();

        if ($this->data) {
            $this->random = $this->random($this->data->bomb);
            $this->player = $this->data->player()->get()->random();
        }
    }

    /**
     * Show a random action based on the percentage
     *
     * inc_one  = Increment +1      50%
     * inc_two  = Increment +2      10%
     * inc_all  = Increment all +1  10%
     * noone    = Noone             4%
     * dec_one  = Decrement -1      25%
     * bomb     = everyone drink    1%
     *                              ===
     *                              100%
     */
    public function random(int $bomb = null) :string
    {
        $percentages = [
            'inc_one'   => 50,
            'inc_two'   => 10,
            'inc_all'   => 10,
            'noone'     => 4,
            'dec_one'   => 25,
            'bomb'      => $bomb,
        ];

        foreach ($percentages as $key => $value) {
            for ($i = 1; $i <= $value; $i++){
                $array[] = $key;
            }
        }

        shuffle($array);
        $random = array_rand($array);

        return $array[$random];
    }

    // Get a random action and display it
    public function getAction(string $random, array $players = null) :string
    {
        if ($random == 'noone') {
            return __('Noone');
        } elseif ($random == 'bomb') {
            return __('BOMB') . '<br /><span class="x2 text-primary">' . __('Everybody drink!') . '</span>';
        } elseif ($random == 'drink') {
            return "<span class='x2 text-primary'>" . __('Drink') . "</span> " . implode(', ', $players);
        } else {
            return ($random == 'inc_all' ? __('Everybody') : $players[0]) . " <span class='x2 text-" . ($random == 'dec_one' ? "success plus'>-" : "danger plus'>+") . ($random == 'inc_two' ? 2 : 1) . "</span>";
        }
    }

    public function show()
    {
        if (!$this->data) {
            return false;
        }

        $display = [];
        $stop = false;
        $inc = 1;

        // Check if player count will be increased
        if ($this->random == 'inc_one' || $this->random == 'inc_two') {
            $inc = $this->random == 'inc_two' ? 2 : 1;
            $display[] = $this->player->name;

            if ($this->player->count + $inc >= $this->data->count) {
                $stop = true;
                $audio = 'drink';

                $this->data->player()->update(['count' => 0]);
            }

            $count[] = $this->updatePlayer($this->data, $this->player, $inc, $stop);
        }
        // Check if all players counts will be increased
        else if ($this->random == 'inc_all') {
            foreach ($this->data->player as $pl) {
                if ($pl->count + 1 >= $this->data->count) {
                    $stop = true;
                    $audio = 'drink';
                    $display[] = $pl->name;
                }

                $count[] = $this->updatePlayer($this->data, $pl, $inc, $stop);
            }
        }
        // Check if player count will be decreased
        else if ($this->random == 'dec_one') {
            $display[] = $this->player->name;

            if ($this->player->count <= 0) {
                $this->random = 'inc_one';
            } else {
                $inc = -1;
            }

            $count[] = $this->updatePlayer($this->data, $this->player, $inc);
        }
        // Check for bomb (all players need to drink a shot)
        else if ($this->random == 'bomb') {
            if ($this->data->bomb == 1) {
                $stop = true;
                $audio = 'bomb';

                foreach ($this->data->player as $pl) {
                    $count[] = $this->updatePlayer($this->data, $pl, $inc, true);
                }
            } else {
                $this->random = 'noone';
                $count[] = $this->player->count;
            }
        }
        // Nothing happens
        else if ($this->random == 'noone') {
            $count[] = $this->player->count;
        }

        return response()->json([
            'random'    => $audio ?? $this->random,
            'player'    => $this->player->id,
            'count'     => $count,
            'display'   => $this->getAction($this->random, $display),
            'stop'      => $stop ?? false,
            'audio'     => $audio ?? null,
        ]);
    }

    // Update player
    public function updatePlayer($data, $player, $inc, $resetCount = false)
    {
        if ($resetCount) {
            $player->increment('shots');
            $player->update(['count' => 0]);
        } else {
            $player->increment('count', $inc);
        }

        return [
            'id'    => $player->id,
            'count' => $resetCount ? $data->count : $player->count,
        ];
    }
}
