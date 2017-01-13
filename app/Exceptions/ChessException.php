<?php

namespace App\Exceptions;


class ChessException extends \Exception
{

    protected $winner;
    protected $loser;

    function __construct($message, $code = null, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}