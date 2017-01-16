<?php

namespace App\Http\Controllers;

use App\Board;
use App\King;
use App\Horse;
use App\Position;
use App\Exceptions\CheckMateException;
use App\Exceptions\ChessException;
use Illuminate\Http\Request;

use Log;

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

        $movements = [];

        try {

            // Limit the number of movements just to avoid an infinite loop.
            // We could be using while (1==1) here.
            for ( $i=1 ; $i < 100 ; $i++ ) {

                $previoousWhiteHorsePosition = $whiteHorsePosition;
                $whiteHorsePosition = $board->makeRandomMovement($whiteHorsePosition);
                $movements[] = [
                    'message' => $board->lastMessage,
                    'board' => $board->getBoard(),
                    'from' => (string) $previoousWhiteHorsePosition,
                    'to' => (string) $whiteHorsePosition
                ];

                $previousBlackKingPosition = $blackKingPosition;
                $blackKingPosition = $board->makeRandomMovement($blackKingPosition);
                $movements[] = [
                    'message' => $board->lastMessage,
                    'board' => $board->getBoard(),
                    'from' => (string) $previousBlackKingPosition,
                    'to' => (string) $blackKingPosition
                ];

            }
        } catch (CheckMateException $e) {
            $resultMessage = sprintf("%s after %s movements.", $e->getMessage(), count($movements));
        }

        if (is_null($resultMessage)) {
            $resultMessage = 'Tie! Neither white horse nor black king won the game after 100 turns each.';
        }

        return view('log')->with(compact('messages', 'resultMessage', 'movements'));

    }


}
