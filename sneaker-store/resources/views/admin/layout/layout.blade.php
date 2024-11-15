<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    @include('admin.layout.partials.css')

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.layout.partials.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            @include('admin.layout.partials.navbar')

            <div class="container">
                @yield('content')
            </div>

            @include('admin.layout.partials.footer')
        </div>
    </div>

    @include('admin.layout.partials.js')
</body>

</html>
