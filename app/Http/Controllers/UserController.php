<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GameCodeNotification;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\ErrorResource;

class UserController extends Controller
{
    public function sendCode(Request $request)
    {
        $code = random_int(1000, 9999);
        $player1 = User::where(['email' => 'admin@example.com'])->first();
        $player2 = User::where(['email' => $request->email])->first();

        //storing code in the db against user email
        DB::table('games')->updateOrInsert(['player1_id' => $player1->id, 'player2_id' => $player2->id],
            ['game_code' => $code, 'created_at' => now()]);

        //sending notification to the user email address

        Notification::route('mail', $player2->email)
            ->notify(new GameCodeNotification($player2, $code));

        return new SuccessResource(
            'Invitation has been sent successfully',
            $player2, 200
        );

    }
}
