<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>KGAT Academy (SMS) </title>
        <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}/css/app.css">
    </head>
    <body>
        <div id="root"></div>
        <noscript>
            You need to enable JavaScript to run this app.
        </noscript>
        @if(env('APP_ENV') === 'local')
            <script src="{{env('APP_URL')}}/js/app.js"></script>
        @else
            <script src="{{env('APP_URL')}}/js/app.js"></script>
        @endif
    </body>
</html>