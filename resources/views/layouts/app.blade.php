<!DOCTYPE html>
<html>
    <head>
        <title>Snippets</title>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,400,400italic' rel='stylesheet'>
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>

        @yield('scripts')
    </body>
</html>
