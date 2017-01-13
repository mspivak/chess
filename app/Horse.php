<?php

namespace App;

use App\Piece;

class Horse extends Piece
{

    protected $_movingRules = [
        [2, 1],
        [2, -1],
        [-2, 1],
        [-2, -1],
    ];


}