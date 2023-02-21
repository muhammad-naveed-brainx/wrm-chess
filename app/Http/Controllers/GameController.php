<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

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

    public function joinGame(Request $request, Game $game)
    {
        $player = null;
        // Check if player 1 is already assigned
        if (!$request->session()->has('player1_id')) {
            // Assign the user as player 1
//            $player1_id = generatePlayerId();
            $request->session()->put('player1_id', $game->player1_id);
//            $request->session()->put('player1_user_id', $request->user()->id);
            $player = $game->player1_id;
        } else {
            // Assign the user as player 2
//            $player2_id = generatePlayerId();
            $request->session()->put('player2_id', $game->player2_id);
//            $request->session()->put('player2_user_id', $request->user()->id);
            $player = $game->player2_id;
        }

        // Pass the player id to the view
        return view('game', ['player' => $player, 'game_code'=>$game->game_code]);
    }

//    function generatePlayerId() {
//        return uniqid('player', true);
//    }
}

