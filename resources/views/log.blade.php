<h1>Chess!</h1>

<ul>
    @foreach ($messages as $message)
    <li>{{ $message }}</li>
    @endforeach
</ul>

<strong>{{ $resultMessage }}</strong>