<?php

namespace App\Http\Controllers;

use App\Board;
use App\King;
use App\Horse;
use App\Position;
use App\Exceptions\CheckMateException;
use App\Exceptions\ChessException;
use Illuminate\Http\Request;

class ChessController extends Controller
{

    public function setup(Request $request) {
        return view('setup');
    }

    public function play(Request $request) {

        $board = new Board;

        $blackKingPosition = new Position($request->input('white'));
        $whiteHorsePosition = new Position($request->input('black'));

        $board->place(new Horse('white'), $whiteHorsePosition);
        $board->place(new King('black'), $blackKingPosition);

        try {
            for ( $i=0 ; $i<100 ; $i++ ) {
                $whiteHorsePosition = $board->makeRandomMovement($whiteHorsePosition);
                $blackKingPosition = $board->makeRandomMovement($blackKingPosition);
            }
        } catch (CheckMateException $e) {
            var_dump($e->getMessage()." after $i movements.");
        }

    }


}
