<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" name="csrf-token" value="{{ csrf_token() }}">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" href="{{{ asset('images/favicon-32x32.png') }}}">
    <link rel="apple-touch-icon" href="{{{ asset('images/favicon-57x57.png') }}}"/>
    <link rel="stylesheet" href="{{ mix('css/bundle.css') }}">

{{--     <script>
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    </script> --}}

    <script src="https://use.fontawesome.com/45ecff3689.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

    <title> @yield('title') </title>

    <style>

        body {
            padding-bottom: 100px;
            padding-top: 50px;
        }
        .level {
            display: flex; 
            align-items: center; 
        }
        .flex {
            flex: 1;
        }
        .doc-content {
            margin: 10px;
        }
        .ml-1 {
            margin-left: 1em;
        }
        .mr-1 {
            margin-right: 1em;
        }
        .mt-1 {
            margin-top: 1em;
        }
        .mb-1 {
            margin-bottom: 1em;
        }
        .pl-1 {
            margin-left: 1em;
        }
        .pr-1 {
            margin-right: 1em;
        }
        .pt-1 {
            margin-top: 1em;
        }
        .pb-1 {
            margin-bottom: 1em;
        }
        .pl-05 {
            margin-left: 0.5em;
        }
        .pr-05 {
            margin-right: 0.5em;
        }
        .pt-05 {
            margin-top: 0.5em;
        }
        .pb-05 {
            margin-bottom: 0.5em;
        }
        hr.doc {
            margin-bottom: 5px;
        }
        [v-cloak] { 
            display: none; 
        }

    </style>


@yield('head')

  </head>

  <body>

@yield('content')

<script src="{{ mix('js/app.js') }}"></script>

  </body>

</html>
