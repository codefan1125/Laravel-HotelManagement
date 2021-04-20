<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('package/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    {{-- style --}}
    <link rel="stylesheet" href="{{ asset('style/css/style.css') }}">

    {{-- Sweet Alert --}}
    <link rel="stylesheet" href="{{ asset('package/sweetalert2/dist/sweetalert2.min.css') }}">
    <title>@yield('title')</title>

    {{-- Toastr --}}
    <link href="{{ asset('package/toastr/toastr/build/toastr.css') }}" rel="stylesheet" />

    {{-- Toggle IOS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('package/toggle/vc-toggle-switch.css') }}" />

    {{-- Font Awesome --}}
    <link href="{{ asset('package/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    @yield('head')
</head>

<body>
    <header>
        @include('template.include._navbar')
    </header>
    <main class="my-3">
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->

            <!-- /#sidebar-wrapper -->
            @include('template.include._sidebar')
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="mt-3 ms-1">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-lg-12">
                                @include('template.include._sidebarToggle')
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
                {{-- <div class="wrapfooter">
                </div> --}}
            </div>
            <!-- /#page-content-wrapper -->

        </div>
    </main>
    <footer class="footer mt-auto py-2 shadow-sm border-top mt-3" style="background: #f8f9fa; height:55px">
        @include('template.include._footer')
    </footer>

    <script src="{{ asset('package/bootstrap/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });

    </script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

    </script>
    {{-- Sweet Alert 2 JS --}}
    <script src="{{ asset('package/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    {{-- Toastr JS --}}
    <script src="{{ asset('package/toastr/toastr/build/toastr.min.js') }}"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}","Success")
        @endif
        @if (Session::has('failed'))
            toastr.error("{{ Session::get('failed') }}","Failed")
        @endif
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        Echo.channel('channel-reservation-{{ auth()->user()->random_key }}')
            .listen('NewReservationEvent', (e) => {
                console.log(e.message);
                $("#refreshThisDropdown").load(window.location.href + " #refreshThisDropdown");
                $("#refreshThisDropdown").load(" #refreshThisDropdown > *");
                toastr.success(e.message, "Hello there");
            })
    </script>
    @yield('footer')
</body>

</html>
