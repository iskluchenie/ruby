<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  @class(['dark' => ($appearance ?? 'system') == 'dark'])>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ __(config('app.name')) }}</title>

    <link rel="icon" href="/favicon.svg" type="image/svg+xml">

    @vite(['resources/scss/app.scss', 'resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
    @inertiaHead
</head>
<body>
@inertia
</body>
</html>
