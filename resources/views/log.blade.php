@extends('master')

@section('main')

<h1>Chess!</h1>

<ol id="game">
    @foreach ($movements as $movement)
        <li class="movement">

            <div class="board">
                @foreach ($movement['board'] as $row)
                    <div class="row">
                        @foreach ($row as $cell)
                            <div class="cell">

                                @if (!is_null($cell))

                                    @if ('App\King' == get_class($cell))
                                        l
                                    @endif

                                    @if ('App\Horse' == get_class($cell))
                                        n
                                    @endif

                                @endif

                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="message">
                {{ $movement['message'] }}
            </div>

        </li>

    @endforeach
</ol>

<h2>{{ $resultMessage }}</h2>

@endsection