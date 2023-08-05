<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ getTitle() }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url(option('site_favicon')) }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('css/user/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/toasting.css') }}">
    <script src="{{ asset('js/lib/toasting.js') }}"></script>
</head>
<body>

<x-user.layouts.partials.preloader />
<x-user.layouts.partials.scrollTop />
<x-user.layouts.partials.header />

<main>
    {{ $slot }}
</main>

<x-user.layouts.partials.footer />

<!-- JS here -->
<script src="{{ asset('js/user/app.js') }}"></script>
<script src="{{ asset('js/magnific-popup.js') }}"></script>
<script>
    /*=============================================
        =    		Magnific Popup		      =
    =============================================*/

    $('.popup-image').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    /* magnificPopup video view */
    $('.popup-video').magnificPopup({
        type: 'iframe'
    });
</script>
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
