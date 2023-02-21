<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    /**
     * show the game start view
     */
    public function index(Request $request)
    {
        return view('welcome');
    }

    /**
     * show game start view
     */
    public function gameStart(Game $game)
    {
        return view('game_started', ['game' => $game]); //sending route parameter game
    }

    /**
     * test function
     */
    public function joinGame(Request $request, Game $game)
    {
        $player_id = null;
        // Check if player 1 is already assigned
        if (!Session::has('player1_id')) {
            // Assign the user as player 1
            Session::put('player1_id', $game->player1_id);
            $player_id = $game->player1_id;
        }
        else {
            $player_id = $game->player2_id;
        }
        $data = ['player_id'=>$player_id, 'game' => $game];
        return view('game_started', ['data'=>$data]);
    }
}

