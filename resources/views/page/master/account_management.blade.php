@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Account Management</h5>

        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">

            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-lg-8 col-sm-8 align-center">
                                <h5 class="m-0">Agent</h5>

                            </div>
                        </div>
                    </div>
                    <div id="alias_listing_table">
                        <div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg mt-3" ></i></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        /* .container-fluid {
                    max-width: 1280px;
                } */

        th {
            text-align: center;
        }

        .fade-scale {
            transform: scale(0);
            opacity: 0;
            -webkit-transition: all .25s linear;
            -o-transition: all .25s linear;
            transition: all .25s linear;
        }

        .fade-scale.in {
            opacity: 1;
            transform: scale(1);
        }

        .control-label {
            font-size: 0.8rem;
        }

        .form-control {
            font-size: 0.8rem;
            min-height: auto;
        }

        .filter-option {
            font-size: 0.75rem;
        }

        .bootstrap-select .dropdown-menu li a span.text {
            font-size: 0.75rem;
        }

        .dropdown-item.active,
        .dropdown-item:active {
            color: #fff !important;
        }

        .bootstrap-select .dropdown-menu li a:hover,
        .bootstrap-select .dropdown-menu li a:focus {
            color: #398bf7 !important;
        }

        @media (min-width: 768px) {
            .modal-xl {
                width: 90%;
                max-width: 1200px;
            }
        }
    </style>
@endpush
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $('#alias_listing_table').load('/account_management_table');

        function suspendAlias(id, m, code) {
            if (confirm(`${m} this alias account ? `)) {
                $.post(`/suspend_alias_account/${id}`, {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    suspend: code
                }, function(d) {
                    if (d.s == 'success') {
                        toastMessage(d.t, d.m, '#ff6849', d.s);
                        $('#alias_listing_table').load('/alias_account_listing');
                    }
                })

            } else {
                return false
            };
        }

        function forceLogoutAlias(id, m, code) {
            if (confirm(`${m} this alias account ? `)) {
                $.post(`/forceLogoutAlias/${id}`, {
                    _token: $("meta[name=csrf-token]").attr("content"),
                    force_logout: 1
                }, function(d) {
                    if (d.s == 'success') {
                        toastMessage(d.t, d.m, '#ff6849', d.s);
                        $('#alias_listing_table').load('/alias_account_listing');
                    }
                })

            } else {
                return false
            };
        }


        function otp_toggle(toggle, user_id, agent_id, username, email, ori_toggle) {

            var revert_toggle = 0;

            if (ori_toggle == 1) {
                revert_toggle = true
            } else {
                revert_toggle = false
            }

            if (toggle == 1) {
                // for enable toggle
                swal({
                    title: "Enable OTP",
                    text: "Please confirm email for alias - " + username,
                    content: {
                        element: 'input',
                        attributes: {
                            defaultValue: email,
                        }
                    },
                    showCancelButton: true,
                    closeOnConfirm: false,
                    icon: "info",
                    buttons: {
                        cancel: "Cancel",
                        confirm: "Confirm OTP"
                    },
                }).then((value) => {

                    if (value == null) {
                        $('.otp_' + user_id).prop('checked', revert_toggle);
                        swal('Action Cancel')
                    } else {
                        value = $('.swal-content__input').val()
                        var email_input = value

                        var fd = new FormData();

                        fd.append("otp_toggle", toggle);
                        fd.append("email_input", email_input);
                        fd.append("user_id", user_id);
                        fd.append("agent_id", agent_id);
                        fd.append("username", username);
                        fd.append("ori_toggle", ori_toggle);

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '/update_otp_toggle',
                            type: "post",
                            data: fd,
                            processData: false,
                            contentType: false,
                            success: function(data) {

                                switch (data.status) {
                                    case 0:
                                        $('.otp_' + user_id).prop('checked', revert_toggle);
                                        toastMessage('OTP Toggle', data.message, '#ff6849', 'error');
                                        break;

                                    case 1:
                                        $('.email_' + user_id).html(data.email);
                                        toastMessage('OTP Toggle', data.message, '#ff6849', 'success');
                                        break;
                                    default:

                                }
                            },
                            error: function(error) {
                                console.log('eror', error.responseText)
                            }
                        });
                    }
                });
                // end enable toggle
            } else {
                // for disable toggle
                Swal.fire({
                    title: "<i>Disable OTP</i>",
                    html: "Are you sure to disable OTP for alias - " + username,
                    confirmButtonText: "Confirm",
                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                }).then(function(conds) {
                    if (conds.value) {

                        var fd = new FormData();

                        fd.append("otp_toggle", toggle);
                        fd.append("user_id", user_id);
                        fd.append("agent_id", agent_id);
                        fd.append("username", username);
                        fd.append("ori_toggle", ori_toggle);

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '/update_otp_toggle',
                            type: "post",
                            data: fd,
                            processData: false,
                            contentType: false,
                            success: function(data) {

                                switch (data.status) {
                                    case 0:
                                        $('.otp_' + user_id).prop('checked', revert_toggle);
                                        toastMessage('OTP Toggle', data.message, '#ff6849', 'error');
                                        break;

                                    case 1:
                                        toastMessage('OTP Toggle', data.message, '#ff6849', 'success');
                                        break;
                                    default:

                                }
                            },
                            error: function(error) {
                                console.log('eror', error.responseText)
                            }
                        });

                    } else {
                        $('.otp_' + user_id).prop('checked', revert_toggle);
                    }
                });
                // end disable toggle
            }


        }

        function reset_pw_toggle(toggle, user_id, agent_id, username, email, ori_toggle) {

            var revert_toggle = 0;

            if (ori_toggle == 1) {
                revert_toggle = true
            } else {
                revert_toggle = false
            }

            if (toggle == 1) {
                // for force reset password

                Swal.fire({
                    title: "Enable Force Reset Password",
                    text: "Please confirm email for alias - " + username,
                    input: 'text',
                    inputValue: email,
                    inputAttributes: {
                        readonly: true
                    },
                    showCancelButton: true,
                    confirmButtonText: "Confirm",
                    cancelButtonText: "Cancel",
                    icon: "info",

                }).then((result) => {

                    if (result.isDismissed) {
                        $('.reset_pw_' + user_id).prop('checked', revert_toggle);
                        Swal.fire('Action Cancel')
                    } else {

                        var email_input = result.value

                        var fd = new FormData();

                        fd.append("force_reset_toggle", toggle);
                        fd.append("email_input", email_input);
                        fd.append("user_id", user_id);
                        fd.append("agent_id", agent_id);
                        fd.append("username", username);

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '/update_reset_password_toggle',
                            type: "post",
                            data: fd,
                            processData: false,
                            contentType: false,
                            success: function(data) {

                                switch (data.status) {
                                    case 0:
                                        $('.reset_pw_' + user_id).prop('checked', revert_toggle);
                                        toastMessage('Force Reset Password', data.message, '#ff6849',
                                            'error');
                                        break;

                                    case 1:
                                        $('.email_' + user_id).html(data.email);
                                        toastMessage('Force Reset Password', data.message, '#ff6849',
                                            'success');
                                        break;
                                    default:

                                }
                            },
                            error: function(error) {
                                console.log('eror', error.responseText)
                            }
                        });
                    }
                });
                // end enable toggle
            } else {
                // for disable toggle
                Swal.fire({
                    title: "<i>Disable Force Reset Password</i>",
                    html: "Are you sure to disable forced reset password for alias - " + username,
                    confirmButtonText: "Confirm",
                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                }).then(function(conds) {
                    if (conds.value) {

                        var fd = new FormData();

                        fd.append("force_reset_toggle", toggle);
                        fd.append("user_id", user_id);
                        fd.append("agent_id", agent_id);
                        fd.append("username", username);

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '/update_reset_password_toggle',
                            type: "post",
                            data: fd,
                            processData: false,
                            contentType: false,
                            success: function(data) {

                                switch (data.status) {
                                    case 0:
                                        $('.reset_pw_' + user_id).prop('checked', revert_toggle);
                                        toastMessage('Force Reset Password', data.message, '#ff6849',
                                            'error');
                                        break;

                                    case 1:
                                        toastMessage('Force Reset Password', data.message, '#ff6849',
                                            'success');
                                        break;
                                    default:

                                }
                            },
                            error: function(error) {
                                console.log('eror', error.responseText)
                            }
                        });

                    } else {
                        $('.reset_pw_' + user_id).prop('checked', revert_toggle);
                    }
                });
            }


        }


        function removeAlias(id, user_name) {

            swal({
                title: "Remove Alias Account",
                text: "Please enter " + user_name + " to remove this alias account.",
                content: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                icon: "info",
                buttons: {
                    cancel: "Cancel",
                    confirm: "Remove"
                },
            }).then((value) => {
                if (value == null) {
                    swal('Action Cancel')
                } else {

                    var user_name_input = value

                    var fd = new FormData();
                    fd.append("user_name_input", user_name_input);
                    fd.append("id", id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/remove_alias',
                        type: "post",
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            //console.log(data)
                            if (data.status == '1') {
                                toastMessage(data.message, 'Deleted account successfully', '#ff6849',
                                    'success');
                                $('#alias_listing_table').load('/alias_account_listing');
                            } else if (data.status == '7') {
                                toastMessage('Permission Denied',
                                    'Please request to your master admin.', '#ff6849', 'error');
                            } else {
                                toastMessage(data.message, '', '#ff6849', 'warning');
                            }

                        },
                        error: function(error) {
                            console.log('eror', error.responseText)
                        }
                    });

                }

            });
        }
    </script>
@endpush
