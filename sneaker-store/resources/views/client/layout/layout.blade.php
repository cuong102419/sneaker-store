<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('client.layout.partials.css')

    <title>@yield('title')</title>
</head>

<body>
    @include('client.layout.partials.nav')

    @yield('content')

    @include('client.cart.cart')

    @include('client.layout.partials.footer')


    @include('client.layout.partials.js')
</body>

</html>
