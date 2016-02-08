<!DOCTYPE html>
<html>
    <head>
        <title>Snippets</title>

        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>

        @yield('scripts')
    </body>
</html>
