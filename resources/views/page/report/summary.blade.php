@extends('layouts.main')
@section('panel')
<div class="pl-4 pr-4">
    <div class="row page-titles">
        <div class="col-md-12 align-self-center d-flex justify-content-between">
            <h5 class="text-themecolor">Summary</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Report</a></li>
                    <li class="breadcrumb-item active" aria-current="/summary_report">Summary</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- search criteria -->
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sel1">Date </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control form-control-sm date_range" name="daterange">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <span class="ti-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4 align-self-end">
                            <div class="mb-3">
                                <button type="button" id="search"
                                    class="daily_report_search_new mx-3 btn btn-primary btn-sm btn-rounded">Search</button>
                                <img src="{{ asset('assets/images/save_loading.gif') }}" alt=""
                                    class="search_mini_loader" style="display:none;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end search criteria -->

        <!-- daily data -->
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <span class="daily_data_result"></span>
                </div>
            </div>
        </div>
        <!-- end daily data -->

    </div>
</div>
@endsection

@push('script')
<script>
    var date_range = $('.date_range').val();
        var filter_date_start;
        var filter_date_end;

        var _token = $('meta[name=csrf-token]').attr('content');


        // set global variable
        $('.date_range').change(function() {
            date_range = $('.date_range').val();
            _updateDateFormat();
        });

        $('.market_selector').change(function() {
            market = $("option:selected", this).val();
        });

        $('.report_view_selector').change(function() {
            report_view = $("option:selected", this).val();
        });

        $(`#sorted_by`).change(function() {
            sorted_by = $(" option:selected ", this).val();

        });

        $(`#player_remark`).change(function() {
            player_remark = $(" option:selected ", this).val();
        });


        $('#filter_by').change(function() {
            var option = $(this).val();
            if (option == '0') {
                $('#filter_field').val('')
            }
            if (option == '0') {
                $("#filter_by_div").css("display", "none");
            } else {
                $("#filter_by_div").css("display", "block");
            }
            filter_by = $('#filter_by').val();
        })

        function _updateDateFormat() {
            var new_ = date_range.split(' - ');
            var date_from = new_[0];
            var date_to = new_[1];
            filter_date_start = date_from;
            filter_date_end = date_to;
        }

        // calender date setup
        $(document).ready(function() {
            $('.date_range').daterangepicker({
                autoApply: true,
                startDate: moment().startOf('day'),
                endDate: moment().endOf('day'),
                ranges: {
                    'Today': [moment().startOf('day'), moment().endOf('day')],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1,'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment().subtract(1,
                        'days')],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment().subtract(
                        1, 'days')],
                    'This Month': [moment().startOf('month'), moment().endOf('month').subtract(12,
                        'hours')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]

                }
            }, function(start, end, label) {
                data.date = start.format('YYYY-MM-DD');
                data.date_end = end.format('YYYY-MM-DD');

                $('#paginator').find('a').removeClass('dp-selected');

            });


            // date selector for daily report
            $('.daily_date_range').daterangepicker({
                autoApply: true,
                startDate: moment().subtract(6, 'days'),
                endDate: moment(),
                minDate: moment().startOf('month').subtract(3, 'months').format('MM/DD/YYYY 00:00:00'),
                maxDate: moment().format('MM/DD/YYYY 23:59:59'),

                ranges: {
                    'Last 7 Days': [moment().subtract(6, 'days'), moment().subtract(1,
                        'days')],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment().subtract(
                        1, 'days')],
                    'This Month': [moment().startOf('month'), moment().endOf('month').subtract(12,
                        'hours')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, function(start, end, label) {


                data.date = start.format('YYYY-MM-DD');
                data.date_end = end.format('YYYY-MM-DD');

                $('#paginator').find('a').removeClass(
                'dp-selected');

            });

        });

        $(document).ready(function() {

            // mute & unmute button
            function muteButton() {
                $('.search_mini_loader').show();
                $('.daily_report_search').attr('disabled', 'disabled');

            }

            function unmuteButton() {
                $('.search_mini_loader').hide();
                $('.daily_report_search').removeAttr('disabled');

            }

            // daily report
            function _get_daily_report_new(data) {
                $.get("/get_summary_report?" + data, function(d) {
                    unmuteButton()
                    $('.daily_data_result').html(d);
                });
            }

            $('.daily_report_search_new').click(function() {
                var connection = $('.connection_selector').val();
                let data = {
                    filter_date_start: filter_date_start,
                    filter_date_end: filter_date_end,
                    _connection: connection,
                };
                muteButton()
                _get_daily_report_new($.param(data));
            })
        });
</script>
@endpush
