<?php

namespace App;

use App\Exceptions\CheckMateException;
use App\Position;
use App\Exceptions\ChessException;
use Log;

class Board
{

    static public $columnCount = 8;
    static public $rowCount = 8;

    protected $board;

    public $lastMessage;

    public function __construct() {
        $this->board = array_fill(1, self::$columnCount, array_fill(1, self::$rowCount, null));
    }

    public function place(Piece $piece, Position $position) {

        if (!Board::isValidPosition($position)) {
            throw new ChessException(sprintf('Sorry, the initial position for the %s is invalid', class_basename($piece)));
        }

        $this->board[$position->getRow()][$position->getColumn()] = $piece;
    }

    public function removePieceFromPosition(Position $position) {

        // This will throw an exception if there's no piece in this position.
        $piece = $this->getPieceFromPosition($position);

        // Clear the given position on the board.
        $this->board[$position->getRow()][$position->getColumn()] = null;

        return $piece;

    }

    public function move(Position $from, Position $to) {

        if (($loser = $this->getPieceFromPosition($to, false)) !== null) {

            $winner = $this->getPieceFromPosition($from);

            throw CheckMateException::mate($winner, $loser);

        }

        $piece = $this->removePieceFromPosition($from);

        $this->place($piece, $to);

        $this->lastMessage = sprintf("%s %s moves from %s to %s", ucfirst($piece->getColor()), class_basename($piece), $from, $to);

        return $to;

    }

    public function makeRandomMovement(Position $position) {

        $possibleMovements = $this->possibleMovements($position);

        $chosenMovement = $possibleMovements[ array_rand($possibleMovements) ];

        return $this->move($position, $chosenMovement);

    }

    public function getBoard() {
        return $this->board;
    }

    public function getPieceFromPosition(Position $position, $exceptionIfEmpty = true) {

        if (!Board::isValidPosition($position)) {
            throw new ChessException(sprintf('Sorry, %s is not a valid position', $position));
        }

        $piece = $this->board[$position->getRow()][$position->getColumn()];

        if ($exceptionIfEmpty && is_null($piece)) {
            throw new ChessException(sprintf('There`s no piece in position %s', $position));
        }

        return $piece;

    }

    function possibleMovements(Position $position) {

        $piece = $this->getPieceFromPosition($position);

        return $piece->possibleMovements($position);

    }

    static function isValidPosition($row, $col = null) {

        if ($row instanceof Position) {
            $position = $row;
            $row = $position->getRow();
            $col = $position->getColumn();
        }

        return  $col >= 1 && $col <= self::$columnCount
        &&      $row >= 1 && $row <= self::$rowCount;

    }

    static function makeMovement(Position $from, Position $to) {




    }

}