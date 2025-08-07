@extends('layouts.main')
@section('panel')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h5 class="text-themecolor">Account List</h5>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <form action="/account_listing" method="POST" id="member_search_form">
                    <fieldset>
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sel1">Search Criteria </label>
                                <input type="hidden" name="all" id="all" value='0'>
                                <select data-plugin="selectpicker" class="form-control form-control-sm selecttype "
                                    id="test" name="form_select" onchange="showDiv(this)">

                                    <option>Member Listing</option>
                                    <option value="user_name"> Username</option>
                                    <option value="player_remark">Player Remark</option>
                                    <option value="user_mobile">Phone</option>
                                    <option value="user_account_number">Bank & E-wallet Account Number / Name</option>
                                    <option value="user_bank_name">Bank/Fund Method</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <div class="dropdown" id="date_div">
                                    <label for="sel1">Date </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control form-control-sm date_range created_at"
                                            name="created_at" id="created_at">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <span class="ti-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown" id="user_name_div" style="display:none">
                                    <div class="form-group">
                                        <label for="user_name">Username </label>
                                        <input type="text" name="user_name" id="user_name"
                                            class="form-control form-control-sm user_name" value="">
                                    </div>
                                </div>
                                <div class="toggle_columns">
                                    <div class="dropdown" id="player_remark_div" style="display:none;">
                                        <div class="dropdown">
                                            <div class="form-group">
                                                <label for="player_remark">Player Remark</label>
                                                <div>
                                                    <input type="text" name="player_remark" id="player_remark"
                                                        class="form-control form-control-sm player_remark" value="">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown" id="user_mobile_div" style="display:none">
                                    <div class="form-group">
                                        <label for="user_mobile">Mobile </label>
                                        <input type="text" name="user_mobile" id="user_mobile"
                                            class="form-control form-control-sm user_mobile" value="">
                                    </div>
                                </div>

                                <div class="dropdown" id="user_account_number_div" style="display:none">
                                    <div class="form-group">
                                        <label for="user_account_number">Bank & E-wallet Account Number / Name</label>
                                        <input type="text" name="user_account_number" id="user_account_number"
                                            class="form-control form-control-sm user_account_number" value="">
                                    </div>
                                </div>

                                <div class="dropdown" id="user_bank_name_div" style="display:none">
                                    <div class="form-group">
                                        <label for="user_bank_name">Bank/Fund Method</label>
                                        <input type="text" name="user_bank_name" id="user_bank_name"
                                            class="form-control form-control-sm user_bank_name" value="">
                                    </div>
                                </div>

                            </div>


                            <div class="col-md-3">
                                <div class="dropdown">
                                    <div class="form-group">
                                        <label for="status">Status </label>
                                        <select class="form-control form-control-sm" id="status" name="status">
                                            <option value=""> Member / New. Register </option>
                                            <option value="1">Status On</option>
                                            <option value="0">Status Off</option>
                                            <option value="1">Game Status On</option>
                                            <option value="0">Game Status Off</option>
                                            <option value="5">Balance > 0</option>
                                            <option value="6">Balance < 0</option>
                                            <option value="7">Member Deposit</option>
                                            <option value="9">Member No Deposit</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-8">
                                        <button id="agent_search" type="submit"
                                            class=" waves-effect waves-light btn btn-sm btn-info btn-rounded mt-4"
                                            name="submit">Search</button>
                                        &nbsp;&nbsp;

                                    </div>

                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group mb-0">
                                            <label for="column_sort">rows </label>
                                            <select name="rows" class="form-control form-control-sm">
                                                <option value="20"> 20 rows </option>
                                                <option value="50" selected> 50 rows </option>
                                                <option value="100"> 100 rows </option>
                                                <option value="500"> 500 rows </option>
                                                <option value="1000"> 1000 rows </option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-0">
                                            <label for="sort_column">Sort By </label>
                                            <select name="sort_column"
                                                class="form-control form-control-sm sort_fil column_sort">
                                                <option value="">-- Sort By --</option>
                                            </select>
                                        </div>

                                    </div>


                                    <div class="col-md-4">
                                        <div id="none-display" class="form-group  mb-0">
                                            <label for="sorting">Arrangement </label>
                                            <select name="sorting"
                                                class="form-control form-control-sm sort_fil sorting">
                                                <option value="desc">Desc</option>
                                                <option value="asc">Asc</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div id="display" class="card shadow" style="display: none">
            <div class="card-body">
                <div class="card-title">
                    <strong>Agent</strong>
                </div>
                <div class="account_table" id="account_table">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('addon')
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
<div class="custom_load position-fixed d-none">
    <div class="loader">
        <div class="loader__figure">
        </div>
        <p class="loader__label text-danger">Loading. Please do not leave the page!</p>
        <span class="loader__label pages"></span>
    </div>
    <div>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75"
                aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
        </div>
    </div>
</div>
<style>
    .progress {
        height: 1rem;
    }
</style>
<script type="text/javascript">
    // function getPlayerRemark(val){
        //   onchange="getPlayerRemark(this.value);"
        //   if (val == 'Player_Remark') {
        //       $("#search_field_div").css("display", "block");
        //       $('#player_remark').show();
        //       $('#search_field').hide();
        //       $('#none-display').hide();
        //   }else {
        //       $("#search_field_div").css("display", "none");
        //       $('#player_remark').hide();
        //       $('#search_field').show();
        //       $('#none-display').show();
        //   }
        // }sorting
        $(document).ready(function() {
            $(document).on('click', '.pagination a', function(event) {
                var str = $("#member_search_form").serialize();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                event.preventDefault();

                var page = $(this).attr('href').split('page=')[1];
                $("#agent_all").prop("disabled", true);
                $("#agent_search").prop("disabled", true);

                account_list_table(page);

            });

            $('.sort_fil').on('change', function() {
                var paginate = $('.pagination li.active a').attr('href');
                var page = (paginate != undefined ? paginate.split('page=')[1] : 0);
                account_list_table(page);

            })

        });

        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('noPaginationTable');
            var wb = XLSX.utils.table_to_book(elt, {
                sheet: "sheet1"
            });
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || (Date.now() + '_AccountingList.' + (type || 'xlsx')));
        }

        function account_list_table(page) {
            // $.post( url , data, (d)=>{
            //     $("#account_table").html(d);
            //     $('#display').show();
            //   });
            //var rows = 50 ;
            var url = $('#member_search_form').attr("action");
            // var rows = $("option:selected" , "select[name=rows]").val();
            var data = $('#member_search_form').serializeArray();
            // var sorting = $('.sorting').val();
            // var sort_column = $('.column_sort').val();
            data.push({
                name: "page",
                value: page
            });
            // data.push({ name: "rows", value: rows });
            // data.push({ name: "sorting", value: sorting });
            // data.push({ name: "sort_column", value: sort_column });


            $.ajax({

                url: url,
                type: "POST",
                data: data,
                async: true,
                cache: false,
                datatype: "JSON",
                beforeSend: function() {
                    $("#account_table").append(
                        '<div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg" ></i></div></div>'
                        );
                },
                success: function(data) {
                    //  console.log(data);
                    // $("#account_table").html(data);
                    // $('#display').show();
                    // location.hash = page;

                    if (data == "false") {
                        alert('Unauthorized access');
                        location.reload();
                    } else {
                        $("#account_table").html(data);
                        $('#display').show();
                        location.hash = page;
                    }



                },
                error: function(qXHR, ajaxOptions, thrownError) {
                    console.log('Error:', thrownError);
                    alert('No response from server');
                }
            })
            $("#agent_all").removeAttr("disabled");
            $("#agent_search").removeAttr("disabled");
        }
        $(document).ready(function() {
            $('.date_range').daterangepicker({
                autoApply: true,
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
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                ranges: {
                    'Today': [moment().set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })],
                    'Yesterday': [moment().subtract(1, 'days').set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().subtract(1, 'days').set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })],
                    'Last 7 Days': [moment().subtract(6, 'days').set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })],
                    'Last 30 Days': [moment().subtract(29, 'days').set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })],
                    'This Month': [moment().startOf('month').set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().endOf('month').set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })],
                    'Last Month': [moment().subtract(1, 'month').startOf('month').set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().subtract(1, 'month').endOf('month').set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })]
                },
                locale: {
                    format: 'MM/DD/YYYY HH:mm:ss'
                }
            });

            $('.referral_date_range').daterangepicker({

                autoApply: true,
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
                // minDate: moment().format('MM/DD/YYYY 00:00:00'),
                maxDate: moment().format('MM/DD/YYYY 23:59:59'),
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,

                autoUpdateInput: false,

                ranges: {
                    'Today': [moment().set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })],
                    'Yesterday': [moment().subtract(1, 'days').set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().subtract(1, 'days').set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })],
                    'Last 7 Days': [moment().subtract(6, 'days').set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })],
                    'Last 30 Days': [moment().subtract(29, 'days').set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })],
                    'This Month': [moment().startOf('month').set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().endOf('month').set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })],
                    'Last Month': [moment().subtract(1, 'month').startOf('month').set({
                        "hour": 00,
                        "minute": 00,
                        "second": 00
                    }), moment().subtract(1, 'month').endOf('month').set({
                        "hour": 23,
                        "minute": 59,
                        "second": 59
                    })]
                },
                locale: {
                    format: 'MM/DD/YYYY HH:mm:ss',
                    cancelLabel: 'Clear'
                }
            });

            $('.referral_date_range').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY HH:mm:ss') + ' - ' + picker.endDate.format(
                    'MM/DD/YYYY HH:mm:ss'));
            });

            $('.referral_date_range').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });

            //account_list_table($('#member_search_form').attr("action"),$('#member_search_form').serialize());

            $('#member_search_form').submit(function(e) {
                e.preventDefault();
                console.log($(this).serialize());

                var created_at_input = $('.created_at').val();
                var user_name_input = $('.user_name').val();
                var player_remark_input = $('.player_remark').val();
                var user_mobile_input = $('.user_mobile').val();
                var user_account_number_input = $('.user_account_number').val();
                var user_bank_name_input = $('.user_bank_name').val();

                var selecttype = $('.selecttype').val();

                switch (selecttype) {
                    case 'Member Listing':
                        if (created_at_input == "") {
                            swal("Please provide Date range")
                            return;

                        }
                        break;
                    case 'user_name':
                        if (user_name_input == "") {
                            swal("Please provide user name")
                            return;

                        }
                        break;
                    case 'player_remark':
                        if (player_remark_input == "") {
                        }
                        break;
                    case 'user_mobile':
                        if (user_mobile_input == "") {
                            swal("Please provide mobile no")
                            return;

                        }
                        break;
                    case 'user_account_number':
                        if (user_account_number_input == "") {
                            swal("Please provide Bank & E-wallet Account Number / Name")
                            return;

                        }
                        break;
                    case 'user_bank_name':
                        if (user_bank_name_input == "") {
                            swal("Please provide Bank/Fund Method name ")
                            return;
                        }
                        break;

                    default:

                }

                $("#all").val("0"); // List all

                $("#agent_all").prop("disabled", true);
                $("#agent_search").prop("disabled", true);

                //  account_list_table($(this).attr("action"),$(this).serialize(),1);
                account_list_table(1);

            });

            $('#agent_all').click(function(e) {
                $("#agent_all").prop("disabled", true);
                $("#agent_search").prop("disabled", true);

                e.preventDefault();
                $("#all").val("1"); // List all
                account_list_table(1);
            })

        });

        $("select[name=rows]").change(function() {
            $("#agent_all").prop("disabled", true);
            $("#agent_search").prop("disabled", true);
            account_list_table(1);
        });





        function reset_pin(e, id) {
            var r = confirm('Are you sure want to reset pin?');
            if (r) {
                let data = {
                    _token: $(`meta[name=csrf-token]`).attr('content'),
                    id: id,

                };
                $.post(`/_reset_pin/${id}`, data, function(d, c, x) {
                    if (x.status == 200) {

                        toastMessage(d.t, d.m, '#ff6849', d.s);
                        cancel_button('.cancel_button', id);

                    } else {
                        toastMessage('Something Went Wrong', 'Please Login Again', '#ff6849', 'error');
                    }
                });
            }

        }

        function cancel_button(e, id) {
            $(` #suspend_${id} , #status_${id} , #firstname_${id} , #lastname_${id} , #lock_${id}, #email_${id} ,#mobile_${id} , #password_${id} `)
                .hide();
            $(` #suspend_${id}_display , #status_${id}_display , #firstname_${id}_display , #lastname_${id}_display , #lock_${id}_display , #mobile_${id}_display ,#email_${id}_display , #password_${id}_display `)
                .show();
            $(e).parent().prev().show();
            $(e).parent().hide();
        }

        function load_agents(id, type, e) {
            var status = $('#filter_status').val();
            let html = $(e).html();
            let action = $('#member_search_form').attr('action');
            let split = action.split('/');
            let url = '';
            split.forEach((element, key) => {
                if (key < split.length - 1) {
                    url += element + '/';
                }
            });

            $('#member_search_form').attr('action', url + id)
            // console.log('check',url)
            for (i = type + 5; i <= 20; i = i + 5) {
                $(`#${i}`).parent().remove();
            }
            if ($(`#${type}`).length < 1) {
                $('.breadcrumb').append(`
        <li class="breadcrumb-item ">
          <a href="javascript:void(0)" id="${type}" onclick="load_agents( ${id} , ${type} , this )">
            ${html}
          </a>
        </li>
      `);
            }
            let dataset = {
                all: 1,
                _token: $('meta[name=csrf-token').attr('content'),
                rows: $('select[name="rows"]').val()

            }
            console.log(rows);
            $.post(`/account_listing/${id}`, dataset, (d) => {

                $("#account_table").html(d);
                $('#display').show();
                $(this).removeAttr("disabled");
                $("#agent_search").removeAttr("disabled");
            });
        }
</script>

<script type="text/javascript">
    function showDiv(select) {

            document.getElementById("user_name").value = "";
            document.getElementById("user_mobile").value = "";
            document.getElementById("user_account_number").value = "";
            document.getElementById("user_bank_name").value = "";
            document.getElementById('player_remark').value = "";
            document.getElementById("created_at").value = "";
            document.getElementById('none-display').value = "";
            if (select.value == 'user_name') {
                document.getElementById('user_name_div').style.display = "block";
                document.getElementById('player_remark_div').style.display = "none";
                document.getElementById('user_mobile_div').style.display = "none";
                document.getElementById('user_account_number_div').style.display = "none";
                document.getElementById('user_bank_name_div').style.display = "none";
                document.getElementById('date_div').style.display = "none";
                document.getElementById('none-display').style.display = "block";
                // unhide search button (for member)
                $("#agent_search").show();

            } else if (select.value == 'player_remark') {
                document.getElementById('user_name_div').style.display = "none";
                document.getElementById('player_remark_div').style.display = "block";
                document.getElementById('user_mobile_div').style.display = "none";
                document.getElementById('user_account_number_div').style.display = "none";
                document.getElementById('user_bank_name_div').style.display = "none";
                document.getElementById('date_div').style.display = "none";
                document.getElementById('none-display').style.display = "block";
                // unhide search button (for member)
                $("#agent_search").show();

            } else if (select.value == 'user_mobile') {
                document.getElementById('user_name_div').style.display = "none";
                document.getElementById('player_remark_div').style.display = "none";
                document.getElementById('user_mobile_div').style.display = "block";
                document.getElementById('user_account_number_div').style.display = "none";
                document.getElementById('user_bank_name_div').style.display = "none";
                document.getElementById('date_div').style.display = "none";
                document.getElementById('none-display').style.display = "block";
                // unhide search button (for member)
                $("#agent_search").show();

            } else if (select.value == 'user_account_number') {

                document.getElementById('user_name_div').style.display = "none";
                document.getElementById('player_remark_div').style.display = "none";
                document.getElementById('user_mobile_div').style.display = "none";
                document.getElementById('user_account_number_div').style.display = "block";
                document.getElementById('user_bank_name_div').style.display = "none";
                document.getElementById('date_div').style.display = "none";
                document.getElementById('none-display').style.display = "block";
                // unhide search button (for member)
                $("#agent_search").show();

            } else if (select.value == 'user_bank_name') {
                document.getElementById('user_name_div').style.display = "none";
                document.getElementById('member_level_div').style.display = "none";
                document.getElementById('player_remark_div').style.display = "none";
                document.getElementById('user_mobile_div').style.display = "none";
                document.getElementById('user_account_number_div').style.display = "none";
                document.getElementById('user_bank_name_div').style.display = "block";
                document.getElementById('date_div').style.display = "none";
                document.getElementById('none-display').style.display = "block";
                // unhide search button (for member)
                $("#agent_search").show();

            } else {
                document.getElementById('user_name_div').style.display = "none";
                document.getElementById('user_mobile_div').style.display = "none";
                document.getElementById('player_remark_div').style.display = "none";
                document.getElementById('user_account_number_div').style.display = "none";
                document.getElementById('user_bank_name_div').style.display = "none";
                document.getElementById('date_div').style.display = "block";
                document.getElementById('none-display').style.display = "block";
                $("#agent_search").show();

            }

        }
</script>
@endpush

@push('style')
<style>
    /* .container-fluid {
    max-width: 1600px;
    } */

    .star-color {
        color: #eeee05;
    }

    .account_list_table {
        overflow-x: auto !important;
        width: 100% !important;
        position: relative;
        margin: 10px auto;
        padding: 0;
        width: 100%;
        height: auto;
        border-collapse: collapse;
        text-align: center;
    }
</style>
@endpush
