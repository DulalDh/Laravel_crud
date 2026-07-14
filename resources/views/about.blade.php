<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css'])
    <title>About</title>
</head>

<body class="bg-gray-50">
    @include('commons.back-button')

    @if (session()->has('last_user'))
        Name: {{ data_get(session('last_user'), 'name') }}<br>
        Email: {{ data_get(session('last_user'), 'email') }}<br>
        Phone: {{ data_get(session('last_user'), 'phone') }}
    @else
        No last user found.
        
    @endif

    <br>
            <br>

    <a href="{{ url('/') }}">Back to Home</a>
</body>

</html>
