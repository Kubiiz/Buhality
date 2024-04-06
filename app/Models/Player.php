<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['game_id', 'name', 'count', 'shots',];
    public $timestamps = false;

    // Get a random player or players
    public static function random(object $players, int $count = null) :object
    {
        $players = $players->random($count);

        return $players;
    }

    // Get a random action and do something with the player
    public static function action(int $value, string $random) :int
    {
        // if ($random == 'inc_one')
        //     $return = $value + 1;
        // elseif ($random == 'inc_two')
        //     $return = $value + 2;
        // elseif ($random == 'inc_all')
        //     $return = $value + 2;
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
