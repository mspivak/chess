<?php

namespace App\Exceptions;


class CheckMateException extends \Exception
{

    protected $winner;
    protected $loser;

    function __construct($message, $code, $previous, $winner, $loser)
    {
        parent::__construct($message, $code, $previous);

        $this->winner = $winner;
        $this->loser = $loser;

    }

    static function mate($winner, $loser) {

        return new static(sprintf(
            'Check Mate! %s %s killed %s %s',
            $winner->getColor(),
            class_basename($winner),
            $loser->getColor(),
            class_basename($loser)), 0, null, $winner, $loser);

    }

    function winner() {
        return $this->winner;
    }

    function loser() {
        return $this->loser;
    }

}