<?php

namespace App;

use JsonSerializable;


class Position implements JsonSerializable
{

    static public $columnNames = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', ];

    protected $column;
    protected $row;

    function __construct($row, $column = null) {

        if (is_string($row)) {
            $this->setFromString($row);
        } else {
            $this->row = $row;
            $this->column = $column;
        }

    }

    public function getRow() {
        return $this->row;
    }

    public function getColumn() {
        return $this->column;
    }

    public function jsonSerialize() {
        return [$this->row, $this->column];
    }

    public function __toString()
    {
        return sprintf('%s%s', static::$columnNames[$this->column-1], $this->row);
    }

    public function setFromString($positionString) {

        try {
            $this->column = (array_search(substr($positionString, 0, 1), static::$columnNames)+1) ;
        } catch (\ErrorException $e) {
            throw new ChessException(sprintf('Sorry, %s is not a valid position', $positionString));
        }
        $this->row = (int) substr($positionString, 1, 1);

    }

}