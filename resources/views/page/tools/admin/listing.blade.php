<style>
    /* .container-fluid {
                max-width: 900px;
              } */
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        display: none;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: not-allowed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider-allowed {
        cursor: default;
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

    #cssTable td:nth-child(3) {
        width: 100px;
    }

    #cssTable td:nth-child(2) {
        width: 50px;
    }
</style>

<div class="table-responsive">
    <table class="table table-bordered table-hover tright medium">
        <thead>
            <tr>
                <th> # </th>
                <th> Admin User Name </th>
                <th> Full Name </th>
                <th> Email </th>
                <th> Status </th>
                <th> Currency </th>
                <th> Credit </th>
                <th> Created Date </th>
                <th> Last Login Ip </th>
                <th> Last Login Time </th>
                <th> Last Logout Time </th>

                <th>
                    Created By
                </th>
                <th>
                    <div class="d-flex justify-content-between">
                        <span>OTP</span>

                        <i class="pl-1 fas fa-question-circle fa-lg pointer text-secondary" data-toggle="tooltip"
                            data-placement="top" title="Toggle ON for alias agent to provide OTP when login"></i>
                    </div>
                </th>
                <th> Action</th>
            </tr>
        </thead>
        <tbody style="text-align:center;color:black">
            @foreach ($agent as $item)
                <tr>
                    <td> {{ $loop->iteration }} </td>
                    <td> {{ $item->username }} </td>
                    <td> {{ $item->fullname }}</td>
                    <td class="email_{{ $item->id }}"> {{ $item->email }} </td>
                    <td> {{ $item->status == 1 ? 'Active' : 'Locked' }} </td>
                    <td> {{ $item->currency }} </td>
                    <td> {{ number_format($item->balance, 2) }} </td>
                    <td> {{ $item->created_at }} </td>
                    <td> {{ $item->last_login_ip }} <br>
                        <a href="javascript:;" onclick="history_login('{{ $item->id }}')" style="float:right;"
                            class="btn btn-sm btn-primary" title="History">History</a>
                    </td>
                    <td> {{ $item->last_login_time }}</td>

                    <td> {{ $item->last_logout_time }}</td>


                    <td style="text-align:center">
                        {{ $item->agent_id }}{{ '@' . $item->created_by }}
                    </td>
                    <td style="text-align:center" class="not-allowed">
                        <label class="switch not-allowed">
                            <input type="checkbox"
                                class="not-allowed primary alias_otp_toggle otp_{{ $item->id }} not-allowed"
                                disabled readonly name="alias_otp_toggle" value="1" checked
                                attr-user-id='{{ $item->id }}' attr-agent-id='NABAA00'
                                attr-username='{{ $item->username }}' attr-email='perempuanbiadab16@gmail.com'
                                attr-toggle='1'>
                            <span class="slider round2"></span>
                        </label>
                    </td>

                    <td>
                        <div>
                            <a href="/edit_admin/{{ $item->id }}" onclick=""
                                class="btn btn-sm btn-warning btn-rounded" title="Edit"><i
                                    class="fas fa-edit"></i></a>
                            @if (auth()->user()->hasPermission('sub_sidebar.Tools.New Admin'))
                                <button type="button"
                                    onclick="balance_settings('{{ $item->id }}', '{{ $item->username }}')"
                                    class="btn btn-sm btn-info btn-rounded" title="Balance"><i class="ti-wallet"
                                        aria-hidden="true"></i></button>
                            @endif
                            @if (auth()->user()->hasPermission('sub_sidebar.Tools.New Admin'))
                                @if($item->status == 1)
                                    <a href="javascript:void(0)"
                                        onclick="suspendAlias('{{ $item->id }}', 'Suspend', 0)"
                                        class="btn btn-sm btn-danger btn-rounded" title="Suspend"><i
                                            class="fa fa-power-off" aria-hidden="true"></i></a>
                                @else
                                    <a href="javascript:void(0)"
                                        onclick="suspendAlias('{{ $item->id }}', 'Activate', 1)"
                                        class="btn btn-sm btn-success btn-rounded" title="Activate"><i
                                            class="fa fa-check" aria-hidden="true"></i></a>
                                @endif
                            @endif
                            @if (auth()->user()->hasPermission('sub_sidebar.Tools.New Admin'))
                                <a href="javascript:void(0)"
                                    onclick="removeAlias( `{{ $item->id }}`, `{{ $item->username }}` )"
                                    class="btn btn-sm btn-dark btn-rounded" title="Remove"><i class="fa fa-trash"
                                        aria-hidden="true"></i></a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if (auth()->user()->hasPermission('sub_sidebar.Tools.Admin Balance'))
    <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="exampleModalLongTitle">Credit settings
                        <b id="username_modal"></b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="balance_edit" method="post" action="/balance_settings">
                    @csrf
                    <input type="hidden" name="id" id="balance_edit_id" value="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-dark float-left">Action</label>
                            <select class="form-control" name="type">
                                <option value="1">Deposit</option>
                                <option value="2">Withdraw</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1" class="text-dark float-left">Amount</label>
                            <input type="text" class="form-control" name="amount" placeholder="Enter Amount"
                                onkeypress='isNum(event)' required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function balance_settings(id, username) {
            $('#exampleModalCenter').modal('show');
            $('#username_modal').text(username);
            $('#balance_edit_id').val(id);
        }
    </script>
@endif


<div id="NewBanner_content" class="modal"></div>

<script type="text/javascript">
    function suspendAlias(id, action, status) {
        swal({
            title: "Are you sure?",
            text: "You want to " + action + " this alias account?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/suspend_alias/' + id + '?s=' + status,
                    type: 'GET',
                    success: function(data) {
                        if (data.s == 'success') {
                            swal("Success", data.t, "success");
                            $('#alias_listing_table').load('/alias_account_listing');
                        } else {
                            swal("Error", data.t, "error");
                        }
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            }
        });
    }

    function removeAlias(id, username) {
        swal({
            title: "Are you sure?",
            text: "You want to remove this alias account?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: '/remove_alias/' + id,
                    type: 'GET',
                    success: function(data) {
                        if (data.s == 'success') {
                            swal("Success", data.t, "success");
                            $('#alias_listing_table').load('/alias_account_listing');
                        } else {
                            swal("Error", data.t, "error");
                        }
                    },
                    error: function(error) {
                        console.log('Error:', error);
                    }
                });
            }
        });
    }

    $('.otp-process-message').hide();

    $('.all_otp_toggle_selection').change(function() {
        var selected_value = $(this).val()

        if (selected_value == 0) {
            $('.otp-email').hide()
        } else {
            $('.otp-email').show()
        }

    })

    $('.all_otp_method_selection').change(function() {
        var selected_value = $(this).val()

        if (selected_value == 1) {
            $('.otp-email').show()
        } else {
            $('.otp-email').hide()
        }

    })

    function isNum(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }

    function history_login(id) {
        $('#NewBanner_content').html(
            '<br><br><br><br><br><br><br><br><br><br><center><img class="mt-5" id="loading-image" src="{{ asset('assets/images/save_loading.gif') }}"/></center>'
        );
        $('#NewBanner_content').load('/login_history/' + id);
        $('#NewBanner_content').modal("show");
    };
</script>
