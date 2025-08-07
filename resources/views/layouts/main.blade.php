<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <x-layouts-header />
    @stack('css')
</head>

<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label"></p>
        </div>
    </div>
    <div id="main-wrapper">

        <x-partials-navbar />
        <x-partials-sidenav />

        <div class="page-wrapper">
            <div class="container-fluid">
                @yield('panel')
            </div>
            @stack('addon')
            <x-partials-footer />
        </div>
    </div>

    @stack('script')
    <audio id="notifSound" src="{{ asset('assets/sounds/notif.mp3') }}" preload="auto"></audio>

    <script src="{{ asset('/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('/js/waves.js') }}"></script>
    <script src="{{ asset('/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('/js/custom.min.js?timer=1740305512') }}"></script>
    <script src="{{ asset('/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/d3/d3.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/c3-master/c3.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
    <script src="{{ asset('/assets/plugins/dropify/dist/js/dropify.min.js?v=2') }}"></script>
    <script src="{{ asset('/assets/plugins/select2/dist/js/select2.full.min.js?v=2') }}"></script>
    <script src="{{ asset('/assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script src="{{ asset('/js/dashboard4.js?v=1741002026') }}"></script>
    <script src="{{ asset('/js/member_game.js') }}"></script>
    <x-partials-scripts />
</body>

</html>
