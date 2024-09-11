<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FitHero - @yield('title')</title>


        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
{{--        <link rel="stylesheet" href="../css/app.css">--}}

    </head>

{{--    <body class="h-screen bg-gradient-to-b from-lime-200 via-zinc-600 to-stone-900">--}}
    <body class="h-screen bg-gray-300">
        <div class="content">@yield('content')</div>
        <script src="../js/logique.js"></script>
    </body>
</html>
