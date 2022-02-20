<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CYTONN | DMS</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">


    <meta name="csrf-token" content="{{ csrf_token() }}">
   </head>

<body>

<div id="app">

</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
