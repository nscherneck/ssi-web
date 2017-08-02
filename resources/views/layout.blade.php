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

        .level {
            display: flex; 
            align-items: center; 
        }
        .flex {
            flex: 1;
        }

    </style>


@yield('head')

  </head>

  <body>

    @yield('content')
{{--     <div id="app">
        <flash message="{{ session('flash') }}"></flash>
    </div> --}}

    <script src="{{ mix('js/app.js') }}"></script>
      
  </body>

</html>
