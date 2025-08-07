<style media="screen">
    @media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width: 1200px;
        }

        .rule-table-header,
        .ip-access-header,
        .txt-record-header,
        .cf-table-header {
            background-color: #000043 !important
        }

        .rule-table-header:hover {
            background-color: #000043 !important
        }

        .txt-record-header:hover {
            background-color: #000043 !important
        }

        .ip-access-header:hover {
            background-color: #000043 !important
        }

        .ip-save-btn {
            background-color: black !important
        }

        .action-flex {
            gap: 6px !important
        }

        .highlight_yellow {
            background-color: #ffffb7 !important
        }

        .high_green {
            color: #007300 !important
        }

    }
</style>

<table class="cf-table table table-sm table-bordered table-hover tright medium">
    <thead class="cf-table-header">
        <tr class="cf-table-header">
            <th class="cf-table-header">#</th>
            <th class="cf-table-header">Domain</th>
            <th class="cf-table-header">Name Servers</th>
            <th class="cf-table-header">Status</th>
            <th class="cf-table-header">Redirection</th>
            <th class="cf-table-header">Created At</th>
            <th class="cf-table-header">Updated At</th>
            <th class="cf-table-header">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data->data as $item)
            <tr class="{{ $item->zone_id }} ">
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $item->domain }}
                    <br>
                </td>
                <td>
                    <ul class="cf-status" data-zone-id="{{ $item->zone_id }}">
                        <li class="">{{ $item->ns1 }}</li>
                        <li class="">{{ $item->ns2 }}</li>
                    </ul>
                </td>

                <td>
                    <span id="status_message" class="text-secondary status_message_{{ $item->zone_id }}"><img
                            src="{{ asset('assets/images/save_loading.gif') }}" alt=""
                            class="mini_loader"></span>
                    <i style="font-size:14px;" id=""
                        class="pending_message_{{ $item->zone_id }} pl-1 fas fa-question-circle fa-lg pointer text-secondary pending_message"
                        data-toggle="tooltip" data-placement="top"
                        title="Point nameservers from domain name registrar to complete the process. It may take up to 30 mins for NS to change."></i>
                    <i style="font-size:14px;" id=""
                        class="active_message_{{ $item->zone_id }} pl-1 fas fa-question-circle fa-lg pointer text-success active_message"
                        data-toggle="tooltip" data-placement="top"
                        title="Please wait up to 1 hour for domain to be fully active."></i>
                </td>

                <td>
                    <span class="text-primary redirectForwardURL{{ $item->zone_id }}">
                        -
                    </span>
                </td>

                <td>{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}</td>
                <td>{{ date('Y-m-d H:i:s', strtotime($item->updated_at)) }}</td>
                <td>

                    <span class="hide_action hide_action{{ $item->zone_id }}">
                        <span class="text-secondary"><img src="{{ asset('assets/images/save_loading.gif') }}"
                                alt="" class="mini_loader"></span>
                    </span>
                    <span class="show_action show_action{{ $item->zone_id }}" style="display: none;">
                        <div class="d-flex justify-content-start action-flex ">

                            <div class="remove_action_panel remove_action_panel_{{ $item->zone_id }}">
                                <button type="button" class="btn btn-xs btn-danger inactivate-button"
                                    data-toggle="modal" data-target="#inactivateModal{{ $item->zone_id }}">
                                    <b>Remove Domain</b>
                                </button>
                                <!-- InActivate Modal -->
                                <div class="modal" id="inactivateModal{{ $item->zone_id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Remove Domain</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="container">
                                                    <div class="">
                                                        Are you sure to remove zone for domain - <b
                                                            class="text-secondary font-weight-bold">{{ $item->domain }}</b>
                                                        ?
                                                    </div>
                                                    <hr>
                                                    <div class="">
                                                        <small id="" class="form-text text-danger">Noted :
                                                            This
                                                            action will delete the domain CF zone</small>
                                                        <small id="" class="form-text text-danger">Noted :
                                                            This
                                                            action will delete the DNS record</small>
                                                        <small id="" class="form-text text-danger">Noted :
                                                            This
                                                            action will delete the zone rule / page rule / firewall
                                                            rule</small>
                                                        <small id="" class="form-text text-danger">Noted :
                                                            This
                                                            action will delete the ip access rule</small>
                                                        <small id="" class="form-text text-danger">Noted :
                                                            This
                                                            action will delete domain from web url settings</small>
                                                        <small id="" class="form-text text-danger">Noted :
                                                            This
                                                            action will remove sitemap.xml and robots.txt</small>
                                                    </div>

                                                    <div class="">
                                                        <br>
                                                        <small id=""
                                                            class="form-text text-danger delete-process-message{{ $item->zone_id }}">processing...</small>
                                                    </div>


                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-danger btn-inactivate{{ $item->zone_id }}"
                                                    attr-id={{ $item->zone_id }}
                                                    attr-domain={{ $item->domain }}>Proceed
                                                    Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END InActivate Modal -->
                            </div>
                        </div>
                    </span>


                    <script type="text/javascript">
                            $('.delete-process-message{{ $item->zone_id }}').hide();
                            $('.btn-inactivate{{ $item->zone_id }}').prop('disabled', false);
                            $('.btn-inactivate{{ $item->zone_id }}').html('Proceed Remove');

                            $('.btn-inactivate{{ $item->zone_id }}').click(function() {
                                var id = $(this).attr('attr-id')
                                var domain = $(this).attr('attr-domain')
                                $('.delete-process-message{{ $item->zone_id }}').show();
                                var fd = new FormData();
                                fd.append("id", id);
                                fd.append("domain", domain);
                                $('.btn-inactivate{{ $item->zone_id }}').prop('disabled', true);
                                $('.btn-inactivate{{ $item->zone_id }}').html('processing..');

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    type: 'POST',
                                    url: '/Website/cloudflare_list/remove_domain/' + id,
                                    data: fd,
                                    processData: false,
                                    contentType: false,
                                    success: function(data) {
                                        if (data.status == 'error') {
                                            swal("Error", data['message'], 'error')
                                        } else {
                                            $('.delete-process-message{{ $item->zone_id }}').hide();
                                            swal("Success", data['message'], 'success')
                                        }
                                        $('.btn-inactivate{{ $item->zone_id }}').prop('disabled', false);
                                        $('.btn-inactivate{{ $item->zone_id }}').html('Proceed Remove');
                                        $('#inactivateModal' + id).remove();

                                        // remove row
                                        $('.' + id).remove();

                                        $('.modal-backdrop').remove();
                                        $('body').removeClass("modal-open");

                                    },
                                    error: function(data) {
                                        console.log("Error: ", data);
                                        console.log("Errors->", data.errors);
                                    }
                                });

                            })
                    </script>

                </td>

            </tr>
        @endforeach
    </tbody>
</table>
<script>
    $(document).ready(function() {

        var table = $(".cf-table").DataTable({
            paging: false,
        });
        const zoneIds = $(".cf-status").map(function() {
            return $(this).data("zone-id");
        }).get();

        $.ajax({
            type: "POST",
            url: "/Website/cloudflare_list/status",
            data: {
                zones: zoneIds,
                _token: "{{ csrf_token() }}"
            },
            success: function(res) {
                $.each(res.status, function(zoneId, status) {
                    let badge = '<span class="badge bg-danger">Error</span>';

                    if (status === 'active') badge =
                        '<span class="badge badge-success font-weight-bold">active</span>';
                    else if (status === 'pending') badge =
                        '<span class="badge badge-secondary font-weight-bold">pending</span>';
                    else if (status === 'paused') badge =
                        '<span class="badge badge-secondary font-weight-bold">paused</span>';
                    $(`.status_message_${zoneId}`).html(badge);
                    $(`.hide_action${zoneId}`).hide();
                    $(`.show_action${zoneId}`).show();
                });
            },
            error: function() {
                $.each(zoneIds, function(_, zoneId) {
                    $(`.status_message_${zoneId}`).html(
                        '<span class="badge badge-danger font-weight-bold">Failed</span>'
                    );
                    $(`.hide_action${zoneId}`).hide();
                    $(`.show_action${zoneId}`).show();
                });

            }
        });
    });
</script>
