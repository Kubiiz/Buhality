<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class GameTest extends TestCase
{
    use RefreshDatabase;

    public $newGame = [
        'title'     => 'Test game',
        'player'    => ['Player', 'Player1'],
        'count'     => 5,
    ];

    // Test if user can create new game and add players to the game
    public function test_can_create_game_and_add_game_players(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/new-game', $this->newGame);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/game');
    }

    // Test if can get right games json response
    public function test_can_get_games_reponse(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post('/new-game', $this->newGame);

        $response = $this->get('/game/action');

        $response->assertJson(fn ($json) =>
            $json->whereType('random', 'string')
                ->whereType('player', 'integer')
                ->whereType('count', 'array')
                ->whereType('display', 'string')
                ->whereType('stop', 'boolean|null')
                ->whereType('audio', 'string|null')
        );
    }
}
