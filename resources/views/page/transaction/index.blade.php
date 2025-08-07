@extends('layouts.main')
@section('panel')
    <input type="hidden" class="view_value" value="deposit_only">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Transaction </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-inline-block align-middle">

                        <form id="searchtransaction" class="d-flex align-items-center" method="POST">
                            @csrf
                            <div class="px-2">
                                <div class="mb-3">
                                    <label class="control-label">Record Type</label>
                                    <div class="">
                                        <input type="hidden" name="view_name" value="deposit_only">

                                        <div>
                                            <div class="form-check-inline custom-radio">
                                                <input type="radio" id="credit" class="" value="1"
                                                    name="record_type" checked>

                                                <label for="credit" class="btn">
                                                    Credit / Debit </label>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="px-2">
                                <label for="search_name">Search Name:</label>
                                <div class="">
                                    <input type="text" name="search_name" class="form-control">
                                </div>
                            </div>
                            <div class="px-2">
                                <label for="period">Period</label>
                                <div class="">
                                    <input type="text" name="period" class="form-control single_time" value=""
                                        autocomplete="off" placeholder="Empty Show All" />

                                </div>
                            </div>
                            <div class="">
                                <div class="text-center">
                                    <button type="submit"
                                        class="waves-effect waves-light btn btn-primary  btn-rounded m-2">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="toggle_columns">

                        <div class="button-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                Toggle Columns</button>
                            <ul class="custom-tabled dropdown-menu">
                                <li class="0"><a href="#" class="toggle-vis 0" data-column="0"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>No</label></a></li>
                                <li class="1"><a href="#" class="toggle-vis 1" data-column="1"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>Transaction
                                            Date</label></a></li>
                                <li class="2"><a href="#" class="toggle-vis 2" data-column="2"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>Transaction
                                            ID</label></a></li>
                                <li class="3"><a href="#" class="toggle-vis 3" data-column="3"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>Account
                                            Name</label></a></li>
                                <li class="4"><a href="#" class="toggle-vis 4" data-column="4"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>Username</label></a></li>
                                <li class="5"><a href="#" class="toggle-vis 5" data-column="5"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>Ref
                                            Code</label></a></li>
                                <li class="6"><a href="#" class="toggle-vis 6" data-column="6"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>Fund
                                            Method</label></a></li>
                                <li class="7"><a href="#" class="toggle-vis 7" data-column="7"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>Bank
                                            Details</label></a></li>
                                <li class="8"><a href="#" class="toggle-vis 8" data-column="8"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>Status</label></a></li>
                                <li class="9"><a href="#" class="toggle-vis 9" data-column="9"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>Receipt</label></a></li>
                                <li class="10"><a href="#" class="toggle-vis 10" data-column="10"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>Debit</label></a></li>
                                <li class="11"><a href="#" class="toggle-vis 11" data-column="11"
                                        tabIndex="-1"> <input type="checkbox" checked /><label>Credit</label></a></li>

                            </ul>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <div id="load_tweets"></div>
@endsection
@push('style')
    <style>
        .glowing-text {
            background-color: #398bf7;
            transform: scale(1);
            color: white;
        }

        @keyframes fire {
            50% {
                /* text-shadow:0px -2px 2px #ffb22b,
                0px -6px 3px #ffb22b; */
                background-color: #398bf7;
                transform: scale(1.05);
                color: white;


            }
        }
    </style>
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
            float: right;
            margin: 0 10px 0 0;
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 11px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.primary:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(17px);
            -ms-transform: translateX(17px);
            transform: translateX(17px);
        }

        input:not(:checked)+.slider:before {
            -webkit-transform: translateX(-8px);
            -ms-transform: translateX(-8px);
            transform: translateX(-8px);
        }

        .slider.round2 {
            border-radius: 34px;
        }

        .slider.round2:before {
            border-radius: 50%;
        }

        .pg_crypto {
            opacity: 0.3;
        }

        .pg_crypto.show {
            opacity: 1;
        }
    </style>
@endpush

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.single_time').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 1,
                autoUpdateInput: false,
                startDate: new Date(),
                minDate: moment().subtract(1, 'days').format('YYYY-MM-DD'),
                maxDate: new Date(),
                locale: {
                    format: 'YYYY-MM-DD HH:mm'
                }
            }).on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm'));
            }).on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

        });
    </script>

    <script type="text/javascript">
        let url = "{{ url('transactions/transaction_new_record_ajax') }}";
        window.interacted = true;
        window.rsearch = false;
        previous_trans = 0;
        trans_count = ($('#__instant').html() == '' ? 0 : $('#__instant').html());
        trans_depo_count = ($('#__instant_depo').html() == '' ? 0 : $('#__instant_depo').html());
        trans_withd_count = ($('#__instant_withd').html() == '' ? 0 : $('#__instant_withd').html());
        window.processed = trans_count;
        max_load = 300;
        l_count = 0;
        let search_value = "";

        function reloadtransaction() {
            clearTimeout(window.reload_trans);
            data = $('#searchtransaction').serialize();
            search_value = $('.dataTables_filter input').val();
            trans_count = ($('#__instant').html() == '' ? 0 : $('#__instant').html());
            trans_depo_count = ($('#__instant_depo').html() == '' ? 0 : $('#__instant_depo').html());
            trans_withd_count = ($('#__instant_withd').html() == '' ? 0 : $('#__instant_withd').html());
            let url = "{{ url('transactions/transaction_new_record_ajax') }}";

            if (window.rsearch || ($('#load_tweets').find('tbody tr[role="row"]').length == 0 && $('#load_tweets').find(
                    'table').length == 0) ||
                (!window.interacted && (((max_load == 0 || (max_load != 0 && trans_count < max_load)) && trans_count !=
                    previous_trans) || trans_count != window.processed))) {
                if (!window.pause) {
                    if (window.trans_ajax) {} else {
                        window.trans_ajax = $.ajax({
                            url: url + '?' + data,
                            success: function(d) {

                                $('#load_tweets').html(d);
                                window.reload_trans = setTimeout(() => {
                                    // if(!window.pause) {
                                    reloadtransaction();
                                    // }
                                }, 60000);
                                window.trans_ajax = undefined;
                            }
                        });
                    }
                }

                window.rsearch = false;
            } else {
                window.reload_trans = undefined;
            }
            previous_trans = trans_count;

        }

        function tablehideshow(e) {
            // console.log(event);
            e.preventDefault();

            var $target = $(this),
                val = $target.attr('data-column'),
                $inp = $target.find('input'),
                idx;


            // check current local storage
            var objectArray = [];
            var retrievedObject = localStorage.getItem('instant_filter');
            if (retrievedObject == null) {
                localStorage.setItem('instant_filter', "");
                retrievedObject = localStorage.getItem('instant_filter');
            }
            objectArray = retrievedObject.split(",");

            // if true mean uncheck, false mean checked
            if ($inp.prop('checked') == true) {
                // add to array
                objectArray.push(val);


            } else {
                // remove from array
                objectArray = objectArray.filter(function(item) {
                    return item !== val
                })
            }

            var mySet = new Set(objectArray);
            objectArray = [...mySet];
            instant_filter = objectArray.join(",");
            localStorage.setItem('instant_filter', instant_filter);



            if ((idx = window.options.indexOf(val)) > -1) {
                window.options.splice(idx, 1);
                setTimeout(function() {
                    $inp.prop('checked', false)
                }, 0);
            } else {
                window.options.push(val);
                setTimeout(function() {
                    $inp.prop('checked', true)
                }, 0);
            }



            if ($inp.prop('checked') == true) {
                $('.custom-tabled').find('li > .' + val + ' > input').prop('checked', true)
            }
            if ($inp.prop('checked') == false) {
                $('.custom-tabled').find('li > .' + val + ' > input').prop('checked', false)
            }

            // console.log('opt',window.options);
            $(event.target).blur();
            // Get the column API object
            column = d_table.column($(this).attr('data-column'));

            // Toggle the visibility
            column.visible(!column.visible());
            return false;
        }



        $(document).ready(function() {
            var all_filter_index = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13'];
            window.options = all_filter_index;
            c_count = 0;
            setInterval(() => {
                c_count++;
                if (c_count >= 20) {
                    window.interacted = false;
                    if (window.reload_trans == undefined && (c_count % 30 == 0)) {
                        reloadtransaction();
                    }
                }
            }, 1000);

            $('#load_tweets').on('click', function() {
                window.interacted = true;
                c_count = 0;
            })
            let data = $('#searchtransaction').serialize();
            reloadtransaction();
            $('.custom-tabled a').on('click', tablehideshow);
            $('#searchtransaction').submit(function(e) {
                e.preventDefault();
                window.rsearch = true;
                reloadtransaction();
            });
        });
    </script>
@endpush
