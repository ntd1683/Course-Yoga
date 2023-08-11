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
    @stack('css')
</head>
<body>

<x-user.layouts.partials.preloader />
<x-user.layouts.partials.scrollTop />
<x-user.layouts.partials.header />

<main>
    {{ $slot }}
</main>

<x-user.layouts.partials.footer />

<button id="open_modal_auth" data-toggle="modal" data-target="#modal_auth" class="d-none"></button>
<x-user.modal id="modal_auth">
    <x-slot:heading>
        {{ __('Notify') }}
    </x-slot:heading>

    {{ __('Please login to receive member offers') }}

    <x-slot:footer>
        <button type="button" class="btn btn-modal btn-secondary" data-dismiss="modal" id="close_modal_auth">{{ __('Turn OFF 24h') }}</button>
        <a href="{{ route('login') }}" class="btn btn-modal btn-primary">{{ __('Login') }}</a>
    </x-slot:footer>
</x-user.modal>

<!-- JS here -->
<script src="{{ asset('js/user/app.js') }}"></script>
<script src="{{ asset('js/magnific-popup.js') }}"></script>
<script src="{{ asset('js/lib/wow.js') }}"></script>
<script>
    $('#close_modal_auth').on('click', () => {
        setCookie('modal_auth', '1', 1);
    })

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

    $(window).on('load', function () {
        @if(auth()->guest())
            if (getCookie('modal_auth') != 1) {
                $('#open_modal_auth').click();
            }
        @endif
        function wowAnimation() {
            var wow = new WOW({
                boxClass: 'wow',
                animateClass: 'animated',
                offset: 0,
                mobile: false,
                live: true
            });
            wow.init();
        }

        wowAnimation();
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

@stack('js')
</body>
</html>
