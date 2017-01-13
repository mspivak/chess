<?php

namespace App;

use App\Board;
use App\Position;
use Mockery\CountValidator\Exception;

abstract class Piece {

    protected $color;

    function __construct($color) {
        $this->color = $color;
    }

    public function getColor() {
        return $this->color;
    }

    public function possibleMovements(Position $position) {

        $possibleMovements = [];

        foreach ($this->_movingRules as $movingRule) {

            $possibleMovement = new Position(
                $position->getRow() + $movingRule[0],
                $position->getColumn() + $movingRule[1]
            );

            if (Board::isValidPosition($possibleMovement)) {
                $possibleMovements[] = $possibleMovement;
            }

        }

        return $possibleMovements;

    }

    public function makeRandomMovement() {

        $randomMovements = $this->possibleMovements();

        return $randomMovements[ array_rand($randomMovements) ];

    }

}