<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Daninoz CMS</title>
    @include('admin._partials.styles')
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">
</head>
<body>
<div id="wrap">
    @include('admin._partials.header')
    @yield('content')
</div>
@include('admin._partials.footer')

@include('admin._partials.scripts')
</body>
</html>