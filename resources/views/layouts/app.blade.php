<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Demo')</title>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}"> -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

</head>
<body>

@if( Auth::user())
  <x-nav-component></x-nav-component>
@endif
    @yield('content')
     <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>



