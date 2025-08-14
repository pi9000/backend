<div class="table-responsive" style="width: 100%">
    <table id="noPaginationTable"
        class="table-hover account_list_table table-sm table-bordered table-stripped text-center align-middle"
        style="width: 100%">
        <thead>

            <tr>
                <th> # </th>
                <th> Agent ID </th>
                <th> Username </th>
                <th> Upline Ref ID </th>
                <th> Status </th>
                <th> Game Status </th>
                <th> Number Verified </th>
                <th> Account Name </th>
                <th> Phone </th>
                <th> Bank/Fund Method</th>
                <th> Balance</th>
                <th> Created Date </th>
                <th> First Deposit Date </th>
                <th> Last Deposit Date </th>
                <th> Last Login Time </th>
                <th> Last Login IP</th>
                <th> Player Remark </th>
                <th> Balance </th>
                <th> Spin Quota / Act </th>
                <th> Edit </th>
            </tr>
        </thead>
        <tbody style="text-align:center;color:black">
            @foreach ($data->data as $item)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $item->extplayer }}
                </td>

                <td>
                    <span id="password_{{ $item->extplayer }}_display">
                        <a href='member_details/{{ $item->extplayer }}' target="_blank">
                            <span class="">
                            </span>
                            <span>
                                <span id='uname_{{ $item->extplayer }}' class="">{{ $item->username }}</span>
                            </span>
                            <span class="">
                        </a>
                        <br>
                        <i onclick="Copytext('uname_{{ $item->extplayer }}')" class="far fa-copy pointer"
                            style="font-size:15px;" aria-hidden="true" title="Copy"></i>
                    </span>
                    <div id="password_{{ $item->extplayer }}" style="display:none">
                        {{ $item->username }}
                    </div>

                </td>
                <td class="text-middle"> </td>
                <td>
                    <span id="status_{{ $item->extplayer }}_display">{{ $item->status == 1 ? 'On' : 'Off' }}</span>
                    <select id="status_{{ $item->extplayer }}" style="display:none" class="w-100">
                        <option value="1" selected>On</option>
                        <option value="0">Off</option>
                    </select>
                </td>

                <td>
                    <span id="suspend_{{ $item->extplayer }}_display">{{ $item->status_game == 1 ? 'On' : 'Off'
                        }}</span>

                    <select id="suspend_{{ $item->extplayer }}" style="display:none" class="w-100">
                        <option value="1">On</option>
                        <option value="0">Off</option>
                    </select>
                </td>

                <td>
                    <span id="verified_{{ $item->extplayer }}_display">{{ $item->verified == 1 ? 'Yes' : 'No' }}</span>

                    <select id="verified_{{ $item->extplayer }}" style="display:none" class="w-100">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </td>

                <td>
                    <span id="firstname_{{ $item->extplayer }}_display">{{ $item->nama_lengkap }}</span>
                    <input type="text" id="firstname_{{ $item->extplayer }}" name="player_firstname" class="w-100"
                        style="display:none" value="{{ $item->nama_lengkap }}">
                </td>

                <td> <span id="mobile_{{ $item->extplayer }}_display">{{ $item->no_hp }}</span>
                    <input type="mobile" id="mobile_{{ $item->extplayer }}" class="w-100" style="display:none"
                        value="{{ $item->no_hp }}">
                    <input class="w-100" id="old_mobile_{{ $item->extplayer }}" type="text" name="old_mobile"
                        value="{{ $item->no_hp }}" hidden>
                </td>
                <td class="text-middle"> {{ $item->nama_bank }} </td>
                <td class="text-middle"> {{ number_format($item->balance, 2) }} </td>
                <td class="text-middle">
                    {{ $item->created_at ? date('Y-m-d H:i:s', strtotime($item->created_at)) : '' }} </td>
                <td class="text-middle">
                    {{ $item->first_deposit_date ? date('Y-m-d H:i:s', strtotime($item->first_deposit_date)) : '' }}
                </td>
                <td class="text-middle">
                    {{ $item->last_deposit_date ? date('Y-m-d H:i:s', strtotime($item->last_deposit_date)) : '' }}
                </td>
                <td class="text-middle">
                    {{ $item->last_login_time ? date('Y-m-d H:i:s', strtotime($item->last_login_time)) : '' }}
                </td>
                <td class="text-middle"> {{ $item->last_login_ip }} </td>
                <td class="text-middle"> {{ $item->remark }} </td>
                <td>
                    <a href="javascript:void(0)" class="waves-effect waves-light btn btn-primary btn-sm btn-rounded"
                        onclick="balance_settings(this, `{{ $item->extplayer }}`, `{{ $item->username }}` )">
                        &#9998; </a>
                </td>
                <td>
                    {{ number_format($item->spin_quota) }} /
                    <a href="javascript:void(0)" class="waves-effect waves-light btn btn-primary btn-sm btn-rounded"
                        onclick="balance_spin_settings(this, `{{ $item->extplayer }}`, `{{ $item->username }}` )">
                        &#9998; </a>
                </td>
                <td>
                    <a href="javascript:void(0)" class="waves-effect waves-light btn btn-warning btn-sm btn-rounded"
                        onclick="edit_button(this, `{{ $item->extplayer }}` )"> &#9998;
                    </a>

                    <div style="display:none">
                        <a href="javascript:void(0)"
                            class=" waves-effect waves-light btn btn-success btn-sm btn-rounded"
                            onclick="submit_button(this , `{{ $item->extplayer }}` )"> &#10004; </a>
                        <a href="javascript:void(0)"
                            class="cancel_button waves-effect waves-light btn btn-danger btn-sm btn-rounded"
                            onclick="cancel_button(this, `{{ $item->extplayer }}` )"> &#10007; </a>

                    </div>
                    <a href="javascript:void(0)" data-toggle="modal"
                        class="waves-effect waves-light btn btn-sm btn-block btn-rounded"
                        onclick="showModal('account_password_edit?id={{ $item->id }}&agent_id={{ $item->extplayer }}')">Edit
                        Password</a>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>


</div>
<div class="text-center">

</div>


<style>
    .player_rm {
        cursor: pointer;
        position: relative;

    }

    .player_rm input {
        opacity: 0;
        z-index: 0;
        pointer-events: none;
    }

    .player_rm.active {
        transform: scale(0.8);
        opacity: 0.9;
    }

    .player_rm {
        transform: scale(0.8);
        opacity: 1;
    }

    .player_rm.active::before {
        content: '/';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLongTitle">Balance settings
                    <b id="username_modal"></b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="balance_edit" method="post" action="/member_details/balance_settings">
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
                    <button type="submit" class="btn btn-success btn-submit-ball">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="exampleModalCentercs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLongTitle">Spin Credit
                    <b id="username_modals"></b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="balance_edit_spin" method="post" action="/member_details/balance_spin_settings">
                @csrf
                <input type="hidden" name="id" id="balance_edit_ids" value="">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-dark float-left">Action</label>
                        <select class="form-control" name="type">
                            <option value="1">Spin Quota</option>
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
                    <button type="submit" class="btn btn-success btn-submit-ball">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function balance_settings(e, id, username) {
        $('#exampleModalCenter').modal('show');
        $('#username_modal').text(username);
        $('#balance_edit_id').val(id);
    }

    function balance_spin_settings(e, id, username) {
        $('#exampleModalCentercs').modal('show');
        $('#username_modals').text(username);
        $('#balance_edit_ids').val(id);
    }
</script>

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>
    $(document).ready(function() {

        var agent = `{{ auth()->user()->agent_id }}`;
        var searching = true
        var columns = [];
        $('.account_list_table th').each(function(key, item) {
            let opt_val = ($(item).html().trim() == 'Username') ? 'user_name' : $(item).html().trim()
                .replace(/ /g, '_').toLowerCase();
            innerOP = '<option value="' + opt_val + '">' + $(item).html().trim() + '</option>'
            if ($(item).html().trim() != 'Edit') {
                columns.push(innerOP)
            }
            // console.log($(item).html());
        })
        if ($('.column_sort option').length < 2) {
            $('.column_sort').html(columns);

        }
        // if the agent id in the array, hide the datatable search field
        if (jQuery.inArray(agent, ['AUGSKAA']) !== -1) {
            searching = false
        }
        $('.account_list_table1').DataTable({
            "searching": searching,
            "ordering": false,
            "info": false,
            "drawCallback": function(settings) {

                premark();
            }
        });
        let tabs = $('.account_list_table').DataTable({
            paging: false,
            "ordering": false,
            "scrollX": true,
            "scroller": true,
            'searching': false,
            "drawCallback": function(settings) {
                premark();
                $('input[type="search"]').prop('autocomplete', 'off');
            },
        });

    });


    function edit_button(e, id) {
        $(`#suspend_${id} , #status_${id} , #firstname_${id} , #lastname_${id} , #lock_${id}, #mobile_${id} , #old_mobile_${id} , #password_${id}, #verified_${id}`)
            .show();
        $(`#suspend_${id}_display , #status_${id}_display , #firstname_${id}_display , #lastname_${id}_display , #lock_${id}_display ,#mobile_${id}_display , #password_${id}_display, #verified_${id}_display `)
            .hide();
        $(e).hide();
        $(e).next().show();
        $("#firstname_" + id).inputFilter(function(value) {
            return /^[ A-Za-z0-9-.,'/]*$/.test(value) // consists of only these
        }, jQuery.validator.format("Only combination with alphabets and spaces , . ' - / is allowed."));
        $(`#chg_password_${id}, #chg_pin_${id} `).val('');
        $("#chg_pin_" + id).inputFilter(function(value) {
            return /^\d*$/.test(value);
        });

    }

    function submit_button(e, id) {

        let data = {
            _token: $(`meta[name=csrf-token]`).attr('content'),
            player_id: `${id}`,
            firstname: $(`#firstname_${id}`).val(),
            lastname: $(`#lastname_${id}`).val(),
            lock: $(`#lock_${id} option:selected`).val(),
            suspend: $(`#suspend_${id} option:selected`).val(),
            status: $(`#status_${id} option:selected`).val(),
            verified: $(`#verified_${id} option:selected`).val(),
            password: $(`#chg_password_${id}`).val(),
        }

        if (1) {
            data['mobile'] = $(`#mobile_${id}`).val();
        }
        if (1) {
            data['old_mobile'] = $(`#old_mobile_${id}`).val();
        }

        $.post(`/update_account_listing`, data, function(d, c, x) {
            if (d.s == 'success') {
                $('#display').show();
                $(`#suspend_${id}_display`).html(data.suspend == 1 ? 'On' : 'Off');
                $(`#status_${id}_display`).html(data.status == 1 ? 'On' : 'Off');
                $(`#lock_${id}_display`).html(data.lock == 1 ? 'Locked' : 'Unlock');
                $(`#firstname_${id}_display`).html(data.firstname);
                $(`#lastname_${id}_display`).html(data.lastname);
                $(`#mobile_${id}_display`).html(data.mobile);
                $(`#old_mobile_${id}_display`).html(data.old_mobile);
                toastMessage(d.t, d.m, '#ff6849', d.s);
                cancel_button(e, id);
            } else {
                toastMessage('Something Went Wrong', 'Please Login Again', '#ff6849', 'error');
            }
        });
    }


    function is_temp_pass(e, id) {

        let val = $("#is_tmp_pass").is(":checked") ? 1 : 0

        if (val == 1) {
            var r = confirm('Are you sure want to enable temporary password?');
        } else {
            var r = confirm('Are you sure want to disable temporary password?');
        }
        if (r) {
            let data = {
                _token: $(`meta[name=csrf-token]`).attr('content'),
                player_id: id,
                value: val

            };
            $.post(`/_temp_pass_update`, data, function(d, c, x) {
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
        $(` #suspend_${id} , #status_${id} , #firstname_${id} , #lastname_${id} , #lock_${id},#mobile_${id} , #old_mobile_${id} , #password_${id}, #verified_${id}`)
            .hide();
        $(` #suspend_${id}_display , #status_${id}_display , #firstname_${id}_display , #lastname_${id}_display , #lock_${id}_display , #mobile_${id}_display , #password_${id}_display , #verified_${id}_display `)
            .show();
        $(e).parent().prev().show();
        $(e).parent().hide();
    }

    function Copytext(e) {

        const el = document.createElement('textarea');
        el.value = document.getElementById(e).innerHTML;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);


        /* Get the text field */
        var copyText = document.getElementById(e).innerHTML;


        swal("Copied the text: " + el.value);
    }
</script>
