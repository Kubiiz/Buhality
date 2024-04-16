<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'count', 'bomb', 'active'];

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
    public static function random(int $bomb = null) :string
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
    public static function action(string $random, array $players = null) :string
    {
        if ($random == 'noone')
            return __('Noone');
        elseif ($random == 'bomb')
            return __('BOMB') . '<br /><span class="x2 text-primary">' . __('Everybody drink!') . '</span>';
        elseif ($random == 'drink')
            return "<span class='x2 text-primary'>" . __('Drink') . "</span> " . implode(', ', $players);
        else
            return ($random == 'inc_all' ? __('Everybody') : $players[0]) . " <span class='x2 text-" . ($random == 'dec_one' ? "success plus'>-" : "danger plus'>+") . ($random == 'inc_two' ? 2 : 1) . "</span>";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function player()
    {
        return $this->hasMany(Player::class);
    }
}
