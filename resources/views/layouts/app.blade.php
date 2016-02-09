<!DOCTYPE html>
<html>
    <head>
        <title>Snippets</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,400,400italic' rel='stylesheet'>
        
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    </head>
    <body>
        <div class="wrapper">
            @yield('content')
        </div>

        @yield('scripts')
    </body>
</html>
