<?php
$columns = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', ];
?>

@extends('master')

@section('main')


<h1>Chess!</h1>

<button id="toggle-arrows" class="btn">Toggle Arrows</button>

<ol id="game">
    @foreach ($movements as $movement)
        <li class="movement">
            <div class="board">
                <div class="row">
                    <div class="cell header">&nbsp;</div>
                    @foreach ($columns as $col)
                        <div class="cell header">{{ $col }}</div>
                    @endforeach
                </div>
                @foreach ($movement['board'] as $rowIndex => $row)
                    <div class="row">
                        <div class="cell header">{{ $rowIndex }}</div>
                        @foreach ($row as $i => $cell)

                            <?php $cellName = $columns[$i-1] . $rowIndex ?>

                            <div class="cell {{ $cellName }} {{ $cellName == $movement['from'] ? 'from' : '' }} {{ $cellName == $movement['to'] ? 'to' : '' }}">
                                @if (!is_null($cell))
                                    <div class="piece">

                                        @if ('App\King' == get_class($cell))
                                            l
                                        @endif

                                        @if ('App\Horse' == get_class($cell))
                                            n
                                        @endif

                                    </div>
                                @else
                                    &nbsp;
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
                <svg>
                    <marker id="head" viewBox="0 0 10 10" refX="8" refY="5"
                            markerWidth="4" markerHeight="3"
                            orient="auto">
                        <path d="M 0 0 L 10 5 L 0 10 z" />
                    </marker>
                    <line stroke="#000" stroke-width="5" marker-end="url(#head)" class="arrow" />
                </svg>
            </div>


            <div class="message">
                {{ $movement['message'] }}
            </div>

        </li>

    @endforeach
</ol>

<h2>{{ $resultMessage }}</h2>

@endsection