<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Job Search Tracker</title>
    @vite('resources/js/app.js')
    @inertiaHead

</head>

<body class="bg-slate-50 dark:bg-slate-950 text-slate-950 dark:text-slate-50">
    @inertia
</body>

</html>