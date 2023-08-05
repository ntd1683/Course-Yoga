<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>{{ getTitle() }}</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url(option('site_favicon')) }}">
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/toasting.css') }}">
    <script src="{{ asset('js/lib/toasting.js') }}"></script>
</head>
<body>
<div class="main-wrapper">
    {{ $slot }}
</div>

<script src="{{ asset('js/admin/app.js') }}"></script>
<script src="{{ asset('js/jquery-slimscroll.js') }}"></script>
<script>
    var $slimScrolls = $('.slimscroll');
    // Sidebar Slimscroll

    if ($slimScrolls.length > 0) {
        $slimScrolls.slimScroll({
            height: 'auto',
            width: '100%',
            position: 'right',
            size: '7px',
            color: '#ccc',
            allowPageScroll: false,
            wheelStep: 10,
            touchScrollStep: 100
        });
        var wHeight = $(window).height() - 60;
        $slimScrolls.height(wHeight);
        $('.sidebar .slimScrollDiv').height(wHeight);
        $(window).resize(function () {
            var rHeight = $(window).height() - 60;
            $slimScrolls.height(rHeight);
            $('.sidebar .slimScrollDiv').height(rHeight);
        });
    }

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
