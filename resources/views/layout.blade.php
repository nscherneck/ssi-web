<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta id="token" name="csrf-token" value="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:light,normal" rel="stylesheet">
<link rel="shortcut icon" href="{{{ asset('images/favicon-32x32.png') }}}">
<link rel="apple-touch-icon" href="{{{ asset('images/favicon-57x57.png') }}}"/>
<link rel="stylesheet" href="{{ mix('css/bundle.css') }}">

<script src="https://use.fontawesome.com/45ecff3689.js"></script>
<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>

<title> @yield('title') </title>

@yield('head')

</head>

<body>

@yield('content')

</body>

<script src="/js/manifest.js"></script>
<script src="/js/vendor.js"></script>
<script src="/js/app.js"></script>

</html>
