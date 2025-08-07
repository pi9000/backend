<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="robots" content="noindex">

<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="robots" content="NOINDEX, NOFOLLOW">
<meta name="author" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Favicon icon -->

@if(applogo()->favicon != NULL)
<link rel="icon" type="image/png" sizes="16x16" href="{{ applogo()->favicon }}">
@endif
<title>{{ setting()->title }}</title>

<!-- Bootstrap Core CSS -->
<link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/wizard/steps.css') }}" rel="stylesheet">
<!-- This page CSS -->
<link href="{{ asset('/assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">
<!--Toaster Popup message CSS -->
<link href="{{ asset('/assets/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/dropify/dist/css/dropify.min.css?v=2') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css"
    href="{{ asset('/assets/plugins/datatables/media/css/dataTables.bootstrap4.css') }}">
<link href="{{ asset('/css/pages/floating-label.css') }}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/slick-1.8.1/slick.css') }}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/slick-1.8.1/slick-theme.css') }}" rel="stylesheet">
<!-- Custom CSS -->
<link href="{{ asset('/assets/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">

<link href="{{ asset('/css/pages/ribbon-page.css') }}" rel="stylesheet">
<link href="{{ asset('/css/style.css?v0.6.3') }}" rel="stylesheet">
<link href="{{ asset('/css/pages/other-pages.css') }}" rel="stylesheet">
<link href="{{ asset('/css/pagination.css') }}" rel="stylesheet">
<!-- Dashboard 1 Page CSS -->
<link href="{{ asset('/css/pages/dashboard4.css?v=1741002026') }}" rel="stylesheet">
<!-- You can change the theme colors from here -->
<link href="{{ asset('/css/colors/default-dark.css?v=0.0.3') }}" id="theme" rel="stylesheet">
<link href="{{ asset('/assets/plugins/select2/dist/css/select2.min.css?v=2') }}" rel="stylesheet">
<link href="{{ asset('/assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
<script src="{{ asset('/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

<script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{ asset('/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/date-paginator/moment.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/date-paginator/bootstrap-datepaginator.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/wizard/jquery.steps.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/wizard/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/jquery-animateNumber/jquery.animateNumber.min.js') }}"></script>
<script src="{{ asset('/js/pagination.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/plugins/slick-1.8.1/slick.min.js') }}"></script>
<script src="{{ asset('/assets/plugins/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript"></script>
<link rel="stylesheet" href="{{ asset('/mdb/css/mdb.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">



<style type="text/css" id="bootstrap-datepaginator-style">
    .datepaginator {
        font-size: 12px;
        height: 60px
    }

    .datepaginator-sm {
        font-size: 10px;
        height: 40px
    }

    .datepaginator-lg {
        font-size: 14px;
        height: 80px
    }

    .pagination {
        margin: 0;
        padding: 0;
        white-space: nowrap
    }

    .dp-nav {
        height: 60px;
        padding: 22px 0 !important;
        width: 20px;
        margin: 0 !important;
        text-align: center
    }

    .dp-nav-square-edges {
        border-radius: 0 !important
    }

    .dp-item {
        height: 60px;
        padding: 13px 0 !important;
        width: 35px;
        margin: 0 !important;
        border-left-style: hidden !important;
        text-align: center
    }

    .dp-item-sm {
        height: 40px !important;
        padding: 5px !important
    }

    .dp-item-lg {
        height: 80px !important;
        padding: 22px 0 !important
    }

    .dp-nav-sm {
        height: 40px !important;
        padding: 11px 0 !important
    }

    .dp-nav-lg {
        height: 80px !important;
        padding: 33px 0 !important
    }

    a.dp-nav-right {
        border-left-style: hidden !important
    }

    .dp-divider {
        border-left: 2px solid #ddd !important
    }

    .dp-off {
        background-color: #F0F0F0 !important
    }

    .dp-no-select {
        color: #ccc !important;
        background-color: #F0F0F0 !important
    }

    .dp-no-select:hover {
        background-color: #F0F0F0 !important
    }

    .dp-today {
        background-color: #88B5DB !important;
        color: #fff !important
    }

    .dp-selected {
        background-color: #428bca !important;
        color: #fff !important;
        width: 140px
    }

    #dp-calendar {
        padding: 3px 5px 0 0 !important;
        margin-right: 3px;
        position: absolute;
        right: 0;
        top: 10
    }

    .level-icon {
        /* background: url(/assets/images/mem_level.png) no-repeat; */
        background: url('https://files.sitestatic.net/sprites/flags-sm.png') no-repeat;
        background-size: 80px;
        width: 12px;
        height: 12px;
        margin: auto;
        display: block;
        min-width: auto !important;
    }

    .level-icon.silver {
        background-position: -37px -37px;
    }

    .level-icon.gold {
        background-position: -52px -37px;
    }

    .level-icon.plat {
        background-position: -66px -37px;
    }

    .level-icon.regular {
        background: url('https://files.sitestatic.net/sprites/bronze_diamond.png') no-repeat;
        background-size: cover;
    }

    .mini_loader {
        width: 25px !important;
        height: 25px !important;
    }
</style>
<style type="text/css">
    .remark {
        text-indent: -9999px;
        transform: scale(0.7);
    }

    .custom_load {
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 99;
        background: rgba(255, 255, 255, 0.8);
    }

    .modal-dialog.modal-full {
        max-width: 1140px;
    }

    .amount_font {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 14px !important;
    }

    .toggle_columns [type=checkbox] {
        opacity: 0;
        position: absolute;
        left: -9999px;
    }

    .toggle_columns .dropdown-menu {
        padding: 10px;
    }

    .toggle_columns .dropdown-menu a {
        color: initial;
    }

    .custom-radio {
        position: relative;
    }

    .custom-radio input {
        position: absolute;
        clip: rect(0, 0, 0, 0);
        pointer-events: none;
    }

    .custom-radio label {
        padding: 0px 5px !important;
        border: 1px solid #2196F3;
        color: #6c757d;
    }

    .custom-radio label:before,
    .custom-radio label:after {
        content: "";
        border: 0 !important;
    }

    .custom-radio [type="radio"]:checked+label:after {
        background-color: unset !important;
    }

    .custom-radio [type="radio"]:checked+label {
        background-color: #2196F3;
        color: white;
    }
</style>

<link href="{{ asset('/css/customcheckbox.css?v=1.0') }}" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
