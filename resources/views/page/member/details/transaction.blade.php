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
<div class="panel panel-bordered mt-3">
    <div class="panel-body">
        <form id="datesearch_history" class="row" action="" method="post">
            @csrf
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <div class="form-group">
                            <label class="col-md-12 col-sm-12 control-label ml-2">Date</label>
                            <div class="col-md-10 col-sm-10">

                                <div class=" d-flex flex-row">
                                    <input type='hidden' class="form-control date_range" name="daterange" />
                                    <button type="button"
                                        class="btn btn-sm btn-outline-secondary ml-2 p-2 date_button daterange1 grey"
                                        name="daterange1"><span class="custom_date">Custom Date &nbsp;<i
                                                class="far fa-calendar-minus"></i></span> <span
                                            class="tick ml-2"></span></button>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-secondary ml-2 p-2 date_button today_date_button">Today
                                        (<span class="today_date"></span>) <span class="tick ml-2"><i
                                                class="fas fa-check text-success"></i></span> </button>
                                    <button type="button"
                                        class="btn btn-sm btn-outline-secondary ml-2 p-2 date_button yesterday_date_button grey">Yesterday
                                        (<span class="yesterday_date"></span>) <span class="tick ml-2"></span></button>
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
                        </div>
                    </div>

                    <div class="col-md-1 col-sm-1">
                        <div class="panel-footer ">
                            <label class="col-md-12 col-sm-12 control-label"></label>
                            <input type="text" name="player_id" value="{{ $data->user->extplayer }}" hidden>
                            <button id="transactionSubmit" style='float: right;' type="submit" name="submit"
                                class="waves-effect waves-light btn btn-primary btn-sm btn-rounded mt-2 ">Search</button>
                        </div>
                    </div>
                </div>


            </div>
    </div>
    </form>
</div>
</div>
<hr>
<div class="panel panel-bordered" id="transactionArea">

    <div class="panel-body">
        <div class="" id="transactionHistoryList"></div>
        <div class="  padding-top-20" id="other"></div>
    </div>
</div>

<script>
    var global_date_range = {
        start: "{{ date('Y-m-d') }}",
        end: "{{ date('Y-m-d') }}"
    };
    $(document).ready(function() {

        $('.today_date').html(moment().format('DD/MM') + ' - ' + moment().format('DD/MM'));
        $('.yesterday_date').html(moment().subtract(1, 'days').format('DD/MM') + ' - ' + moment().subtract(1,
            'days').format('DD/MM'));
        $('.date_range').val(moment().format('YYYY-MM-DD') + ' - ' + moment().format('YYYY-MM-DD'));

        //default date
        $('.today_date_button').click(function() {
            $('.tick').html('');
            $('.date_button').addClass("grey")
            $('.daterange1').find('.custom_date').html(
                "Custom Date &nbsp;<i class='far fa-calendar-minus'></i>");
            $(this).removeClass("grey")
            $(this).find('.tick').html('<i class="fas fa-check text-success"></i>')
            $('.date_range').val(moment().format('YYYY-MM-DD') + ' - ' + moment().format('YYYY-MM-DD'));
        })
        $('.yesterday_date_button').click(function() {
            $('.tick').html('');
            $('.date_button').addClass("grey")
            $('.daterange1').find('.custom_date').html(
                "Custom Date &nbsp;<i class='far fa-calendar-minus'></i>");
            $(this).removeClass("grey")
            $(this).find('.tick').html('<i class="fas fa-check text-success"></i>')
            $('.date_range').val(moment().subtract(1, 'days').format('YYYY-MM-DD') + ' - ' + moment()
                .subtract(1, 'days').format('YYYY-MM-DD'));
        })
        $('.this_week_date_button').click(function() {
            $('.tick').html('');
            $('.date_button').addClass("grey")
            $('.daterange1').find('.custom_date').html(
                "Custom Date &nbsp;<i class='far fa-calendar-minus'></i>");
            $(this).removeClass("grey")
            $(this).find('.tick').html('<i class="fas fa-check text-success"></i>')
            $('.date_range').val(moment().startOf('week').format('YYYY-MM-DD') + ' - ' + moment().endOf(
                'week').format('YYYY-MM-DD'));
        })
        $('.this_month_date_button').click(function() {
            $('.tick').html('');
            $('.date_button').addClass("grey")
            $('.daterange1').find('.custom_date').html(
                "Custom Date &nbsp;<i class='far fa-calendar-minus'></i>");
            $(this).removeClass("grey")
            $(this).find('.tick').html('<i class="fas fa-check text-success"></i>')
            $('.date_range').val(moment().startOf('month').format('YYYY-MM-DD') + ' - ' + moment()
                .endOf('month').format('YYYY-MM-DD'));
        })
        $('.last_month_date_button').click(function() {
            $('.tick').html('');
            $('.date_button').addClass("grey")
            $('.daterange1').find('.custom_date').html(
                "Custom Date &nbsp;<i class='far fa-calendar-minus'></i>");
            $(this).removeClass("grey")
            $(this).find('.tick').html('<i class="fas fa-check text-success"></i>')
            $('.date_range').val(moment().subtract(1, 'months').startOf('month').format('YYYY-MM-DD') +
                ' - ' + moment().subtract(1, 'months').endOf('month').format('YYYY-MM-DD'));
        })

        $('#transactionArea').hide();
        $('#transactionSubmit').click(function(e) {
            e.preventDefault();
            $('#transactionArea').show();
            var date = $('.date_range').val();
            getTransactionHistory(date);
        });

        $('.daterange1').daterangepicker({
            autoApply: true,
            startDate: moment(),
            endDate: moment(),

        }, function(start, end, label) {

            global_date_range = {
                'start': start.format('YYYY-MM-DD'),
                'end': end.format('YYYY-MM-DD')
            };
            $('.tick').html('');
            $('.date_button').addClass("grey")
            $('.daterange1').removeClass("grey")
            $('.daterange1').find('.tick').html('<i class="fas fa-check text-success"></i>')
            $('.date_range').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
            $('.daterange1').find('.custom_date').html(start.format('YYYY-MM-DD') + ' - ' + end.format(
                'YYYY-MM-DD'));

        });
    });


    function getTransactionHistory(date) {
        $('#a').html("Transaction ( namaakun1 ) : " + date);
        $("#other").html('');
        $("#transactionHistoryList").html(
            '<div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg" ></i></div></div>'
            );
        $.post("/getTransactionHistory/{{ $data->user->extplayer }}", $('#datesearch_history').serialize(), function(data) {
            $("#transactionHistoryList").html(data);
        })

    }
</script>
