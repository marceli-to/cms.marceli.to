<!DOCTYPE html>
<html lang="de" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - {{ config('app.name', 'Weberbrunner') }}</title>
    @vite(['resources/css/dashboard.css', 'resources/js/dashboard/app.js'])
</head>
<body class="h-full antialiased">
    <div id="app"></div>
</body>
</html>
