<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GameCodeNotification;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\ErrorResource;
use App\Http\Requests\SendCodeRequest;
use App\Http\Requests\VerifyCodeRequest;
use App\Http\Requests\FenRequest;
use App\Models\Game;

class UserController extends Controller
{
    public function sendCode(SendCodeRequest $request)
    {
        $code = random_int(1000, 9999);
        $player1 = User::where(['email' => 'admin@example.com'])->first(); // this user will be gotten from auth
        $player2 = User::where(['email' => $request->email])->first();

        //storing code in the db against user email
        DB::table('games')->updateOrInsert(['player1_id' => $player1->id, 'player2_id' => $player2->id],
            ['game_code' => $code, 'created_at' => now()]);

        //sending notification to the user email address

        Notification::route('mail', $player2->email)
            ->notify(new GameCodeNotification($player2, $code));

        return new SuccessResource(
            'Invitation has been sent successfully',
            $code, 200
        );
    }

    public function verifyCode(VerifyCodeRequest $request)
    {
//        Post::where('id',3)->update(['title'=>'Updated title']);
        $game = Game::where('game_code', $request->code)->first();
        $game->update(['player2_id' => $request->id, 'verified' => true]);
        $game->refresh();
        return new SuccessResource(
            'Code verified successfully',
            $game, 200
        );
    }

    public function updateFen(FenRequest $request)
    {
        $game = Game::where('game_code', $request->code)->first();
        $game->update(['fen' => $request->fen, 'move'=>$request->move]);
        $game->refresh();
        return new SuccessResource(
            'Fen updated',
            $game, 200
        );
    }
}
