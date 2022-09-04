<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env("APP_NAME", "Fiszki") }}</title>

    <link rel="stylesheet" href="{{ asset("css/app.css") }}?{{ filemtime(base_path("public/css/app.css")) }}">
</head>
<body>
    <div id="app"></div>

    <script src="{{ asset("js/app.js") }}?{{ filemtime(base_path("public/js/app.js")) }}"></script>
</body>
</html>
