<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BGSWSchool</title>
    </head>
    <link rel="stylesheet" type="text/css" href="http://http://127.0.0.1:8000/css/app.css">

<body>
    <div id="app"></div>

    <noscript>
        You need to enable JavaScript to run this app.
    </noscript>
    @if(env('APP_ENV') === 'local')
        <script src="http://127.0.0.1:8000/js/board/app.js"></script>
    @else
        <script src="/js/board/app.js"></script>
    @endif
</body>

</html>