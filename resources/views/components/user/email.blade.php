<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f6f6f6;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #333333;
            padding: 0;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation-name: slidein;
            animation-duration: 0.5s;
        }

        @keyframes slidein {
            from {
                transform: translateY(-50%);
                opacity: 0;
            }
            to {
                transform: translateY(0%);
                opacity: 1;
            }
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: #333333;
        }

        p {
            margin-bottom: 20px;
            color: #333333;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 30px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease-in-out;
        }

        .btn:hover {
            background-color: #3e8e41;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transform: translateY(-2px);
        }

        .logo {
            display: block;
            margin: 0 auto;
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <img class="logo" src="{{ config('app.logo') }}" alt="Logo">
    {{ $slot }}
    <br>
    <br>
    <br>
    <p>{{ __('Cheers') }},</p>
    <p>{{ config('app.name') }}</p>
</div>
</body>
</html>
