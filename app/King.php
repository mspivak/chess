<?php

namespace App;

use App\Piece;

class King extends Piece
{

    protected $_movingRules = [
        [0, 1],
        [1, 1],
        [1, 0],
        [1, -1],
        [0, -1],
        [-1, -1],
        [-1, 0],
        [-1, 1],
    ];

}