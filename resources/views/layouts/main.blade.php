<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-g">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ config('app.name', 'Laravel') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <x-site.header />

    <!-- Page Content -->
    <main>
      {{ $slot }}
    </main>

    <x-site.footer />
  </div>
</body>

</html>
