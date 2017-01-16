@extends('master')

@section('main')

    <h1>Chess!</h1>

    <form action="/play">

        <div class="form-group">
            <label for="white">White Horse position</label>
            <input type="text" name="white" id="white" value="a4">
        </div>

        <div class="form-group">
            <label for="black">Black King Position</label>
            <input type="text" name="black" id="black" value="b7">
        </div>

        <input type="submit" class="btn">

    </form>

@endsection