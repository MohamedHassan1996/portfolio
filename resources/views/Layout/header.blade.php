<html lang="{{ app()->getLocale() }}" dir="{{ session('body_direction')['direction'] }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ url('public/storage/icons/favIco.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700" />
    <title>@yield('title')</title>
</head>
<body class="{{ session('body_direction')['body_class'] }}">
