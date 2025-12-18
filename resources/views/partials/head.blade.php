<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="shortcut icon" href="{{ asset('images/Logo ALP Webdev.png') }}?v={{ time() }}" type="image/png">
<link rel="icon" href="{{ asset('images/Logo ALP Webdev.png') }}?v={{ time() }}" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('images/Logo ALP Webdev.png') }}">
<meta name="msapplication-TileImage" content="{{ asset('images/Logo ALP Webdev.png') }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
