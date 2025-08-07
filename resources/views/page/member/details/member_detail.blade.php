<style media="screen">
    .pointer_cursor:hover {
        cursor: pointer;
    }

    .light_red {
        color: #FF0000 !important;
    }
</style>
<div class="row mt-3">
    <div class="col-md-12">
        <form id="editUser" method="post" style="margin:0;padding:0">
            <table class="table table-bordered table-hover tright medium">
                <thead>
                    <tr>
                        <th title="member_users_62">Basic Information</th>
                        <th colspan="3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td> User Name : <span class="text-danger">*</span> </td>
                        <td>
                            <input class="" type="text" value="{{ $data->user->username }}" disabled>
                        </td>
                        <td> Upline Agent: <span class="text-danger">*</span> </td>
                        <td>
                            <input class="" type="text" value="{{ $data->user->agent_id }}" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:150px"> Account Name : <span class="text-danger">*</span> </td>
                        <td>
                            <input class="" name="account_name" id="account_name" style="text-transform:uppercase"
                                type="text" value="{{ $data->user->nama_lengkap }}" required>
                        </td>

                        <td style="width:150px"> Upline Ref ID : <span class="text-danger">*</span> </td>
                        <td>
                            <input class="" name="ref_id" style="text-transform:uppercase" type="text"
                                value="{{ $data->user->refferal }}" onkeypress="return isNumberKey(event)" disabled>
                        </td>
                    </tr>

                    <tr>

                        <td>
                            Social Contact
                        </td>

                        <td>
                            <div class="d-flex justify-content-start">
                                <div class="d-flex align-items-center pr-3" title="WhatsApp">
                                    <i class="fab fa-whatsapp light_blue fa-2x"></i>
                                    <span class="pl-1">-</span>
                                </div>
                                <div class="d-flex align-items-center pr-3" title="Line ID">
                                    <i class="fab fa-line light_blue fa-2x"></i>
                                    <span class="pl-1">-</span>
                                </div>
                                <div class="d-flex align-items-center pr-3" title="WeChat ID">
                                    <i class="fab fa-weixin light_blue fa-2x"></i>
                                    <span class="pl-1">-</span>
                                </div>
                            </div>


                        </td>

                        <td> Date Created: <span class="text-danger">*</span> </td>
                        <td>
                            <input class=" input-sm" style="text-transform:uppercase" type="text"
                                value="{{ date('Y-m-d H:i:s', strtotime($data->user->created_at)) }}" disabled>
                        </td>
                    </tr>
                    <tr>
                        <td> Mobile : <span class="text-danger">*</span> </td>
                        <td>
                            +60
                            <input class="input-sm" type="text" name="mobile" value="{{ $data->user->no_hp }}">
                            <input class="input-sm" type="text" name="old_mobile" value="{{ $data->user->no_hp }}"
                                hidden>
                        </td>
                    </tr>

                    <tr class="">
                        <td colspan='4'>
                            <input name="player_id" type="hidden" value="{{ $data->user->extplayer }}">
                            <button type="submit" name="changename" style="float:right"
                                class="btn btn-sm btn-primary pull-right lock-submit">Save Changes</button>
                        </td>
                    </tr>



                </tbody>
            </table>
        </form>

        <form id="editUserBank" method="post" style="margin:0;padding:0">
            <table class="table table-bordered table-hover tright medium">
                <thead>
                    <tr>
                        <th>Account Bank Information</th>
                        <th colspan="4"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width:150px">Bank Name:</td>
                        <td colspan="2">
                            <input class="input-sm" type="text" value="{{ $data->user->nama_bank }}"
                                name="bank_name">
                        </td>
                        <td style="width:150px">Account Name:</td>
                        <td colspan="4">
                            <input class="input-sm" type="text" value="{{ $data->user->nama_lengkap }}"
                                name="accname">
                        </td>
                    </tr>

                    <tr>
                        <td style="width:150px">Account No:</td>
                        <td colspan="4">
                            <input class="input-sm" style="text-transform:uppercase" type="text"
                                value="{{ $data->user->nomor_rekening }}" name="accno">
                        </td>
                    </tr>

                    <tr class="">
                        <td colspan='6'>
                            <input name="player_id" type="hidden" value="{{ $data->user->extplayer }}">
                            <button type="submit" name="changebank" style="float:right"
                                class="btn btn-sm btn-primary pull-right lock-submit">Save Changes</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <form id="editUserGame" method="post" style="margin:0;padding:0">
            <table class="table table-bordered table-hover tright medium">
                <thead>
                    <tr>
                        <th>Account Game Information</th>
                        <th colspan="3"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width:150px">MEGA888 ID:</td>
                        <td>
                            <input class="input-sm" style="text-transform:uppercase" type="text"
                                value="{{ $data->user->mega888_id }}" name="mega888_id">
                        </td>
                        <td style="width:150px">MEGA888 Password:</td>
                        <td>
                            <input class="input-sm" type="text" value="{{ $data->user->mega888_password }}"
                                name="mega888_password">
                        </td>
                    </tr>

                    <tr>
                        <td style="width:150px">918KISS ID:</td>
                        <td>
                            <input class="input-sm" style="text-transform:uppercase" type="text"
                                value="{{ $data->user->s918kiss_id }}" name="s918kiss_id">
                        </td>
                        <td style="width:150px">918KISS Password:</td>
                        <td>
                            <input class="input-sm" type="text" value="{{ $data->user->s918kiss_password }}"
                                name="s918kiss_password">
                        </td>
                    </tr>

                    <tr>
                        <td style="width:150px">PUSSY888 ID:</td>
                        <td>
                            <input class="input-sm" style="text-transform:uppercase" type="text"
                                value="{{ $data->user->pussy888_id }}" name="pussy888_id">
                        </td>
                        <td style="width:150px">PUSSY888 Password:</td>
                        <td>
                            <input class="input-sm" type="text" value="{{ $data->user->pussy888_password }}"
                                name="pussy888_password">
                        </td>
                    </tr>
                    <tr class="">
                        <td colspan='4'>
                            <input name="player_id" type="hidden" value="{{ $data->user->extplayer }}">
                            <button type="submit" name="changegames" style="float:right"
                                class="btn btn-sm btn-primary pull-right lock-submit">Save Changes</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <table class="table table-bordered table-hover tright medium">
            <thead>
                <tr>
                    <th>Account Information</th>
                    <th colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width:150px">Last Login Date:</td>
                    <td>
                        <input class=" input-sm" style="text-transform:uppercase" type="text"
                            value="{{ $data->user->last_login_time ? date('Y-m-d H:i:s', strtotime($data->user->last_login_time)) : '' }}"
                            disabled>
                    </td>
                    <td style="width:150px">First Deposit Date:</td>
                    <td>
                        <input class="input-sm" type="text"
                            value="{{ $data->user->first_deposit_date ? date('Y-m-d H:i:s', strtotime($data->user->first_deposit_date)) : '' }}"
                            disabled>
                    </td>
                </tr>

                <tr>
                    <td style="width:150px">Last IP Address: </td>
                    <td>
                        <input class=" input-sm" type="text" value="{{ $data->user->last_login_ip }}" disabled>
                    </td>
                    <td style="width:150px">Last Deposit Date:</td>
                    <td>
                        <input class="input-sm" type="text"
                            value="{{ $data->user->last_deposit_date ? date('Y-m-d H:i:s', strtotime($data->user->last_deposit_date)) : '' }}"
                            disabled>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered table-hover tright medium">
            <thead>
                <tr>
                    <th>Balance information</th>
                    <th colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                <input type="hidden" name="wallet_id" value="{{ $data->user->extplayer }}">
                <tr class="">
                    <td style="width:150px"> Balance: <span class="text-danger">*</span> </td>
                    <td>
                        <input class=" input-sm" style="text-transform:uppercase" type="text"
                            value="{{ auth()->user()->currency }} {{ number_format($data->user->balance, 2) }}"
                            disabled id="walletBal--member">
                        <button type="button" class="btn btn-link" id="refreshWallet--member">
                            <i class="mdi mdi-refresh"></i>
                        </button>
                    </td>

                    <td style="width:150px"> Total Deposit: <span class="text-danger">*</span> </td>
                    <td>
                        <input class=" input-sm" style="text-transform:uppercase" id="walletBal--depositTotal"
                            type="text" value="{{ auth()->user()->currency }} 0.00" disabled>
                    </td>
                </tr>


                <tr class="">

                    <td style="width:150px">

                        Game Wallet:

                    </td>
                    <td>

                        <span class="text-danger">No Available</span>

                    </td>
                    <td style="width:150px"> Total Withdrawal: <span class="text-danger">*</span> </td>
                    <td>
                        <input class="input-sm" style="text-transform:uppercase" id="walletBal--withdrawTotal"
                            type="text" value="{{ auth()->user()->currency }} 0.00" disabled>
                    </td>
                </tr>

                <tr>
                    <td style="width:150px">Total Profit This Month: </td>
                    <td>
                        <input class=" input-sm positive" style="text-transform:uppercase"
                            id="walletBal--profitMonth" type="text" value="{{ auth()->user()->currency }} 0.00"
                            disabled>
                    </td>
                    <td style="width:150px">Total Profit All: </td>
                    <td>
                        <input class=" input-sm positive" style="text-transform:uppercase" id="walletBal--profitAll"
                            type="text" value="{{ auth()->user()->currency }} 0.00" disabled>
                    </td>
                </tr>
            </tbody>
        </table>

        <form id="updatenotes" method="post">
            <table class="table table-bordered table-hover tright medium">
                <thead>
                    <tr>
                        <th colspan="1">Internal Notes Information</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td style="width:150px">Remark: <span class="text-danger">*</span> </td>
                        <td>
                            <div>
                                <h4 class="text-danger font-weight-bold">
                                    <i>


                                    </i>
                                </h4>
                            </div>
                            <textarea row="10" class="" style="width:100%;height:150px" name="remark">{{ $data->user->remark }}</textarea>
                        </td>
                    </tr>
                    <tr class="">
                        <td colspan="2">
                            <input type="hidden" name="player_id" value="{{ $data->user->extplayer }}">
                            <button type="submit" name="submit"
                                class="btn btn-sm btn-primary pull-right lock-submit" style="float:right">Submit
                                Notes</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal modal-special" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
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


<script>
    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }

    function Copytext(e) {
        const el = document.createElement('textarea');
        el.value = $.trim($(e).val());
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
        var copyText = document.getElementById(e);
        swal("Copied the text: " + el.value);
    }



    $(document).ready(function() {
        $('#checked_id').click(function() {
            var checked = $(this).is(':checked');
            if (checked) {
                if (!confirm('Are you want to verify this member?')) {
                    $(this).removeAttr('checked');
                } else {
                    $('#checked_id_veri').show();
                    $('#checked_id_unveri').hide();
                }
            } else {
                if (!confirm('Are you want to unverify this member?')) {
                    $(this).attr("checked", "checked");
                } else {

                    $('#checked_id_unveri').show();
                    $('#checked_id_veri').hide();
                }
            }
        });
        get_balance_info();

        function get_balance_info() {

            var player_id = $("input[name=wallet_id]").val();
            $.ajax({
                type: "post",
                url: 'get_balance_info',
                data: 'player_id=' + player_id,
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {},
                success: function(data) {

                    switch (data.status) {
                        case 0:
                            swal(data.message);
                            break;

                        case 1:
                            $("#walletBal--member").val(data.user_balance);
                            $("#walletBal--profitAll").val(data.all_profit);
                            $("#walletBal--profitMonth").val(data.month_profit);
                            $("#walletBal--withdrawTotal").val(data.withdraw);
                            $("#walletBal--depositTotal").val(data.deposit);
                            break;
                        default:
                    }
                }
            });
        }

    });
</script>
<script>
    $(document).ready(function() {

        $(document).ready(function() {
            $("body").tooltip({
                selector: '[data-toggle=tooltip]'
            });
        });

        $('#editUser').submit(function(e) {
            e.preventDefault();
            var account_name = $('#account_name').val();
            if (!(/^[a-zA-Z.,'\/\-]+(?: [a-zA-Z.,'\/\-]+)*$/.test(account_name))) {
                toastMessage('Invalid Fields',
                    'Account Name can only consist of alphabets , single spaces and the following symbols: (, . \' - /). multiple consecutive spaces not allowed.',
                    '#ff6849', 'error');
                return;
            }
            $.ajax({
                type: "post",
                url: "{{ url('update_account_data') }}",
                data: $(this).serialize(),
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $("#roller").html(
                        '<div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg" ></i></div></div>'
                    );
                },
                success: function(data) {
                    console.log(data)
                    $("#roller").empty();
                    if (data.status == 'success') {
                        swal("Update Completed", "Account Update Success", "success");
                    } else {
                        toastMessage('Something Went Wrong', data.message, '#ff6849',
                            'error');
                    }


                }
            });
        });

        $('#editUserGame').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{ url('update_provider') }}",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $("#roller").html(
                        '<div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg" ></i></div></div>'
                    );
                },
                success: function(data) {
                    $("#roller").empty();
                    if (data.status == 'success') {
                        swal("Update Completed", "Account Update Success", "success");
                    } else {
                        toastMessage('Something Went Wrong', data.message, '#ff6849',
                            'error');
                    }


                }
            });
        });

        $('#editUserBank').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{ url('update_bank_user') }}",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $("#roller").html(
                        '<div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg" ></i></div></div>'
                    );
                },
                success: function(data) {
                    $("#roller").empty();
                    if (data.status == 'success') {
                        swal("Update Completed", "Account Update Success", "success");
                    } else {
                        toastMessage('Something Went Wrong', data.message, '#ff6849',
                            'error');
                    }


                }
            });
        });


        $('#updatenotes').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{ url('update_account_remark') }}",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $("#roller").html(
                        '<div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg" ></i></div></div>'
                    );
                },
                success: function(data) {
                    $("#roller").empty();
                    if (data.status == 'success') {
                        swal("Update Completed", "Account Update Success", "success");
                    } else {
                        toastMessage('Something Went Wrong', data.message, '#ff6849',
                            'error');
                    }
                }
            });

        });

        $('#refreshWallet--member').click(function(e) {
            e.preventDefault();
            e.stopPropagation();
            $('#refreshWallet--member').prop('disabled', true);
            $('#walletBal--member').val('');
            $("#walletBal--profitAll").val('');
            $("#walletBal--profitMonth").val('');
            $("#walletBal--withdrawTotal").val('');
            $("#walletBal--depositTotal").val('');
            var pid = $('input[name=player_id]').val();
            var data = {
                player_id: pid
            };
            $.ajax({
                type: "post",
                url: "get_balance_info",
                data: data,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                    $("#roller").html(
                        '<div id="loading" align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg" ></i></div></div>'
                    );
                },
                success: function(d) {
                    $("#roller").empty();
                    $("#walletBal--member").val(d.user_balance);
                    $("#walletBal--profitAll").val(d.all_profit);
                    $("#walletBal--profitMonth").val(d.month_profit);
                    $("#walletBal--withdrawTotal").val(d.withdraw);
                    $("#walletBal--depositTotal").val(d.deposit);
                    $('#refreshWallet--member').prop('disabled', false);
                },
                error: function(xhr, status, err) {
                    alert(xhr.responseText);
                    $('#refreshWallet--member').prop('disabled', false);
                }
            });
        });


        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31 &&
                (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
    });
</script>
