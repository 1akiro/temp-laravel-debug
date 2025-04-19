<!doctype html>
<html lang="lv">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
  </head>
  <body>
    <x-navbar />
        {{ $slot }}
    <x-footer />
  </body>
</html>
