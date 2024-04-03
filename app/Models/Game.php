<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'count', 'bomba', 'active'];

    /**
     * Show a random action based on the percentage
     *
     * inc_one = Increment +1      Default 44%
     * inc_two = Increment +2      Default 15%
     * inc_all = Increment all +1  Default 10%
     * noone = Noone,              Default 10%
     * dec_one = Decrement -1      Default 20%
     *
     * bomb (3) = dzer visi        Default 1%
     */
    public static function random() :string
    {
        $json = json_decode(Settings::value('random'));

        foreach ($json as $key => $value) {
            for ($i = 1; $i <= $value; $i++){
                $array[] = $key;
            }
        }

        shuffle($array);
        $random = array_rand($array);

        return $array[$random];
    }

    // Get a random action and display it
    public function action(string $random, object $player) :string
    {
        if ($random == 'inc_one')
            $return = $player->name . ' <span class="x2 text-danger plus">+1</span>';
        elseif ($random == 'inc_two')
            $return = $player->name . ' <span class="x2 text-danger plus">+2</span>';
        elseif ($random == 'inc_all')
            $return = 'Visi';
        elseif ($random == 'noone')
            $return = 'Neviens';
        elseif ($random == 'dec_one')
            $return = $player->name . ' <span class="x2 text-success plus">-1</span>';
        elseif ($random == 'bomb' || $random == 'bomba')
            $return = 'BOMBA<br /><span class="x2 text-primary">Dzer visi!</span>';
        else
            $return = 'FAIL';

        return $return;
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
