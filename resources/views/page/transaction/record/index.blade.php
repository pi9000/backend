@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Transaction Record</h5>
        </div>
        <div class="col-md-7 align-self-center"></div>
    </div>
    <div class="row page-titles">
        <div class="col-12">
            <form class="form-horizontal" method="POST" action="{{ url('transactions/transaction_record_ajax') }}"
                id="searchForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class=" d-flex flex-row">
                                        <h5 class="p-1 mr-4">
                                            <a href="javascript:void(0)">
                                                <i class="ti-search"></i>
                                            </a>
                                            Search Criteria
                                        </h5>
                                        <input type='hidden' class="form-control trans_date_range" name="daterange" />
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary ml-2 p-2 date_button daterange1 grey"
                                            name="daterange1">
                                            <span class="custom_date">Custom Date <i class="far fa-calendar-minus"></i>
                                            </span>
                                            <span class="tick ml-2"></span></button>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary ml-2 p-2 date_button today_date_button">Today
                                            (<span class="today_date"></span>)
                                            <span class="tick ml-2">
                                                <i class="fas fa-check text-success"></i>
                                            </span>
                                        </button>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary ml-2 p-2 date_button yesterday_date_button grey">Yesterday(<span
                                                class="yesterday_date"></span>)
                                            <span class="tick ml-2"></span></button>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary ml-2 p-2 date_button this_week_date_button grey">This
                                            Week <span class="tick ml-2"></span></button>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary ml-2 p-2 date_button this_month_date_button grey">This
                                            Month <span class="tick ml-2"></span></button>
                                        <button type="button"
                                            class="btn btn-sm btn-outline-secondary ml-2 p-2 date_button last_month_date_button grey">Last
                                            Month <span class="tick ml-2"></span></button>
                                    </div>

                                </div>

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <hr>
                                <div class="row p-2">
                                    <div class="col-md-2">
                                        <div class="dropdown">
                                            <div class="form-group">
                                                <label for="recordType">Record Type</label>
                                                <div>
                                                    <select class="form-control form-control-sm" name="recordType"
                                                        id="recordType">
                                                        <option value="0">ALL</option>
                                                        <option value="Withdraw">Debit</option>
                                                        <option value="Top Up">Credit</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="dropdown">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <div>
                                                    <select class="form-control form-control-sm" name="status"
                                                        id="status">
                                                        <option value="0">ALL</option>
                                                        <option value="Sukses">Confirm</option>
                                                        <option value="Ditolak">Reject</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="text-center mt-4">
                                            <button type="submit" id="lahanat_member"
                                                class="waves-effect waves-light btn btn-sm btn-primary  btn-rounded">Search</button>
                                        </div>
                                    </div>

                                </div>

                                <div class="hide">
                                    <div id="paginator"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- loader image-->
    <center><img id="loading-image" src="https://78.media.tumblr.com/tumblr_mdkoyttBGV1rgpyeqo1_500.gif"
            style="display:none;" /></center>
    <!-- loader image-->
    <div class="panel panel-bordered" id="table_replace"></div>
    <!-- Modal -->
    <div class="modal modal-special" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function showModal(url, id = '', classes = '') {
            if (url.includes("(Silahkan Hubungi CS)")) {
                swal({
                    title: "Sorry!",
                    text: "Please update the bank account.no before transaction.",
                    icon: "error",
                    allowOutsideClick: false,
                    closeOnClickOutside: false,
                    button: "Okay",
                })
            } else {
                if (id == '#high_transinfo') {
                    $('.modal-special .modal-dialog').addClass(id.replace('#', ''));
                    $('.modal-special .modal-dialog').addClass(classes.replace('.', ''));
                    $('.modal-special .modal-content').load(url);
                    $('.modal.modal-special').modal('show');
                } else {
                    $('.modal-dialog').addClass(id.replace('#', ''));
                    $('.modal-dialog').addClass(classes.replace('.', ''));
                    $('.modal-content').load(url);
                    $('.modal').modal('show');
                }

            }

        }

        function hideModal() {
            $('.modal.modal-special').modal('hide');
        }


        $('.modal.modal-special').on('hidden.bs.modal', function() {
            $('.modal-special .modal-content').html('');
            window.pause = false;

        })
    </script>
@endsection
@push('style')
    <style media="screen">
        .date_button:active {
            box-shadow: none;
        }

        .date_button:hover {
            background-color: white;
            color: black !important;
        }

        .grey {
            color: grey;
            opacity: 0.5;
        }
    </style>
@endpush

@push('script')
    <script>
        $(document).ready(function() {

            $('.today_date').html(moment().format('DD/MM') + ' - ' + moment().format('DD/MM'));
            $('.yesterday_date').html(moment().subtract(1, 'days').format('DD/MM') + ' - ' + moment().subtract(1,
                'days').format('DD/MM'));
            $('.trans_date_range').val(moment().format('YYYY-MM-DD 00:00:00') + ' - ' + moment().format(
                'YYYY-MM-DD 23:59:59'));

            //default date
            $('.today_date_button').click(function() {
                $('.tick').html('');
                $('.date_button').addClass("grey")
                $('.daterange1').find('.custom_date').html(
                    "Custom Date &nbsp;<i class='far fa-calendar-minus'></i>");
                $(this).removeClass("grey")
                $(this).find('.tick').html('<i class="fas fa-check text-success"></i>')
                $('.trans_date_range').val(moment().format('YYYY-MM-DD 00:00:00') + ' - ' + moment().format(
                    'YYYY-MM-DD 23:59:59'));
            })
            $('.yesterday_date_button').click(function() {
                $('.tick').html('');
                $('.date_button').addClass("grey")
                $('.daterange1').find('.custom_date').html(
                    "Custom Date &nbsp;<i class='far fa-calendar-minus'></i>");
                $(this).removeClass("grey")
                $(this).find('.tick').html('<i class="fas fa-check text-success"></i>')
                $('.trans_date_range').val(moment().subtract(1, 'days').format('YYYY-MM-DD 00:00:00') +
                    ' - ' + moment().subtract(1, 'days').format('YYYY-MM-DD 23:59:59'));
            })
            $('.this_week_date_button').click(function() {
                $('.tick').html('');
                $('.date_button').addClass("grey")
                $('.daterange1').find('.custom_date').html(
                    "Custom Date &nbsp;<i class='far fa-calendar-minus'></i>");
                $(this).removeClass("grey")
                $(this).find('.tick').html('<i class="fas fa-check text-success"></i>')
                $('.trans_date_range').val(moment().startOf('week').format('YYYY-MM-DD 00:00:00') + ' - ' +
                    moment().endOf('week').format('YYYY-MM-DD 23:59:59'));
            })
            $('.this_month_date_button').click(function() {
                $('.tick').html('');
                $('.date_button').addClass("grey")
                $('.daterange1').find('.custom_date').html(
                    "Custom Date &nbsp;<i class='far fa-calendar-minus'></i>");
                $(this).removeClass("grey")
                $(this).find('.tick').html('<i class="fas fa-check text-success"></i>')
                $('.trans_date_range').val(moment().startOf('month').format('YYYY-MM-DD 00:00:00') + ' - ' +
                    moment().endOf('month').format('YYYY-MM-DD 23:59:59'));
            })
            $('.last_month_date_button').click(function() {
                $('.tick').html('');
                $('.date_button').addClass("grey")
                $('.daterange1').find('.custom_date').html(
                    "Custom Date &nbsp;<i class='far fa-calendar-minus'></i>");
                $(this).removeClass("grey")
                $(this).find('.tick').html('<i class="fas fa-check text-success"></i>')
                $('.trans_date_range').val(moment().subtract(1, 'months').startOf('month').format(
                        'YYYY-MM-DD 00:00:00') + ' - ' + moment().subtract(1, 'months').endOf('month')
                    .format('YYYY-MM-DD 23:59:59'));
            })

            $("#searchForm").submit(function(e) {
                e.preventDefault();
                let data = $(this).serialize();
                $('#table_replace').html('');
                $("#loading-image").show();
                $.post($(this).attr('action'), data, function(d) {
                    // console.log(d);
                    $("#loading-image").hide();
                    $('#table_replace').html(d);
                });
            });

            $("input:checkbox").on('click', function() {
                // in the handler, 'this' refers to the box clicked on
                var $box = $(this);
                if ($box.is(":checked")) {
                    // the name of the box is retrieved using the .attr() method as it is assumed and expected to be immutable
                    var group = "input:checkbox[name='" + $box.attr("name") + "']";
                    // the checked state of the group/box on the other hand will change and the current value is retrieved using .prop() method
                    $(group).prop("checked", false);
                    $box.prop("checked", true);
                } else {
                    $box.prop("checked", false);
                }
            });
        })
    </script>

    <script type="text/javascript">
        var global_date_range = {
            start: "{{ date('Y-m-d') }}",
            end: "{{ date('Y-m-d') }}"
        };
        var selected_game = 0;

        // var global_link = 'transaction_ajax';
        var tdate = new Date();
        var dd = tdate.getDate(); //yields day
        var MM = tdate.getMonth(); //yields month
        var yyyy = tdate.getFullYear(); //yields year
        var currentDate = yyyy + "-" + (
            MM + 1
        ) + "-" + dd;

        $(document).ready(function() {
            $('.daterange1').daterangepicker({
                autoApply: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                // startDate: moment().set({"hour": 00, "minute": 00, "second": 00}),
                // endDate: moment().set({"hour": 23, "minute": 59, "second": 59}),

                //startDate: moment().subtract(2, 'days').set({"hour": 00, "minute": 00,"second":00}),
                startDate: moment().set({
                    "hour": 00,
                    "minute": 00,
                    "second": 00
                }),
                endDate: moment().set({
                    "hour": 23,
                    "minute": 59,
                    "second": 59
                }),
                minDate: moment().startOf('month').subtract(3, 'months').format('MM/DD/YYYY 00:00:00'),
                //maxDate:moment().subtract(2, 'days').format('MM/DD/YYYY 23:59:59'),
                maxDate: moment().format('MM/DD/YYYY 23:59:59'),
                // startDate: moment(), endDate: moment(),

                locale: {
                    format: 'MM/DD/YYYY HH:mm:ss'
                }
            }, function(start, end, label) {

                global_date_range = {
                    'start': start.format('YYYY-MM-DD  HH:mm:ss'),
                    'end': end.format('YYYY-MM-DD  HH:mm:ss')
                };
                $('.tick').html('');
                $('.date_button').addClass("grey")
                $('.daterange1').removeClass("grey")
                $('.daterange1').find('.tick').html('<i class="fas fa-check text-success"></i>')
                $('.trans_date_range').val(start.format('YYYY-MM-DD  HH:mm:ss') + ' - ' + end.format(
                    'YYYY-MM-DD  HH:mm:ss'));
                $('.daterange1').find('.custom_date').html(start.format('YYYY/MM/DD HH:mm:ss') + ' - ' + end
                    .format('YYYY/MM/DD HH:mm:ss'));
                // $('#paginator').find('a').removeClass('dp-selected'); the blue highlight makes it confusing $("#results").load(global_link + `?date=${global_date_range.start}&date_end=${global_date_range.end}&game=${selected_game}`);

            });
        });
    </script>
@endpush
