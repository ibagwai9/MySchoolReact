<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>iBAcademy (SMS) </title>
        <link rel="stylesheet" type="text/css" href="http://127.0.0.1:8000/css/app.css">
    </head>
    <body>
        <div id="root"></div>
        <noscript>
            You need to enable JavaScript to run this app.
        </noscript>
        @if(env('APP_ENV') === 'local')
            <script src="http://127.0.0.1:8000/js/app.js"></script>
        @else
            <script src="/js/app.js"></script>
        @endif
    </body>
</html>