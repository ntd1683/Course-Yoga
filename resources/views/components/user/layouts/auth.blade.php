<!doctype html>
<html lang="en">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url(option('site_favicon')) }}">

    <link rel="stylesheet" href="{{ asset('css/user/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/toasting.css') }}">
    <script src="{{ asset('js/lib/toasting.js') }}"></script>

</head>
<body class="img js-fullheight" style="background-image: url({{ asset('images/bg/bg.jpg') }});">
<x-user.layouts.partials.preloader />
<x-user.layouts.partials.header />
<section class="ftco-section">
    <div class="container">
        {{ $slot }}
    </div>
</section>
<script src="{{ asset('js/user/auth.js') }}"></script>
<script>
    window.addEventListener('load', function () {
        @if (isset($errors))
        @foreach ($errors->all() as $error)
        toasting.create({
            "title": "Error",
            "text": "{{ $error }}",
            "type": "error",
            "progressBarType": "rainbow"
        });
        @endforeach
        @endif
        @if (session()->has('success'))
        toasting.create({
            "title": "Success",
            "text": "{{ session()->get('success') }}",
            "type": "success",
            "progressBarType": "rainbow"
        });
        @endif
        @if (session()->has('error'))
        toasting.create({
            "title": "Error",
            "text": "{{ session()->get('error') }}",
            "type": "error",
            "progressBarType": "rainbow"
        });
        @endif
    });
</script>
</body>
</html>
