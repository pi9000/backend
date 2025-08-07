@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Domain Settings</h5>
        </div>
        <div class="col-md-7 align-self-center">
            <div style="float: right; margin-right: 10px; font-size: 16px; line-height: 16px;"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="float-left pb-3">
                                <button type="button" class="btn btn-sm btn-success btn-rounded activate-button"
                                    data-toggle="modal" data-target="#addModal">
                                    <i class="fas fa-plus"></i>
                                    New Domain
                                </button>
                                <div class="d-flex flex-row">
                                    <div class="p-2"><small id="" class="form-text text-danger">Noted : Maximum
                                            30 active
                                            domains</small></div>
                                    <div class="p-2">
                                        <i style="font-size:14px;"
                                            class="pl-1 fas fa-question-circle fa-lg pointer text-secondary"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Pending status & active status counted as active domain"></i>
                                    </div>
                                </div>



                                <!-- Add Modal -->
                                <div class="modal" id="addModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Add New Domain</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="container">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="inputDomain">Domain*</label>
                                                            <input type="text" class="form-control" id="inputDomain"
                                                                aria-describedby="" placeholder="">
                                                            <small id="" class="form-text text-muted">Example :
                                                                domain123.com</small>
                                                        </div>
                                                    </form>

                                                    <small id=""
                                                        class="form-text text-danger process-message">processing...</small>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary save-btn">Save
                                                    changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Add Modal -->
                            </div>
                            @csrf
                            <input type='hidden' name='agent_id' id='agent_id' value='{{ auth()->user()->agent_id }}'>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- table -->
        <div class="col-12">
            <div class="row">
                <div class="col">

                    <div class="card shadow">
                        <div class="card-body">
                            <span id="cloudflare_table"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END table -->
    </div>
@endsection
@push('style')
    <style>
        .container-fluid {
            max-width: 1480px;
        }
    </style>
@endpush
@push('script')
    <script>
        $(document).ready(function(event) {

            var agent_id = $('#agent_id').val()
            showList(0, agent_id);
            $('.process-message').hide();

            $('.save-btn').click(function() {
                var domain = $('#inputDomain').val();
                if (domain == '' || domain == null || domain == 'undefined') {
                    alert('Please enter a domain');
                    $('#inputDomain').focus();
                    return false;
                }
                $('.save-btn').prop('disabled', true);
                $('.process-message').show();
                createDomain(domain);
            })

        })

        $('.ban-all-button').click(function() {
            showBanAllList();
        })

        function showBanAllList() {

        }

        $('.save-ban-ip-btn').click(function() {
            var all_ip = $("#inputBanAllIP").val()

            var url = "/Website/cloudflare_ban_ip_all"
            var fd = new FormData();
            fd.append("ip", all_ip);
            $('.save-ban-ip-btn').html('processing..');
            $('.save-ban-ip-btn').prop('disabled', true);
            post_request(url, fd)
            return
        })

        function showList(is_company = 0, agent_code = 0) {
            if (agent_code == '' || agent_code == null || agent_code == 'undefined') {
                alert('Please select any one agent');
                return false;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: '/Website/cloudflare_list/' + agent_code,
                processData: false,
                contentType: false,
                success: function(data) {
                    $("#cloudflare_table").html(data)
                },
                error: function(data) {
                    console.log("Error: ", data);
                    console.log("Errors->", data.errors);
                }
            });

        }

        function createDomain(domain) {
            var url = "/Website/cloudflare_create"
            var fd = new FormData();
            fd.append("domain", domain);
            $('.save-btn').html('processing..');
            post_request(url, fd)
            return
        }

        function post_request(r_url, fd) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: r_url,
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 'error') {
                        swal("Error", data['message'], 'error')
                        $('.process-message').hide();
                    } else {
                        $('.save-btn').html('Save changes');
                        $('.process-message').hide();
                        $(".dataTables_empty").remove();
                        $('.save-btn').prop('disabled', false);
                        $('.save-btn').html('Save changes');
                        $('#addModal').modal('toggle');
                        $('#inputDomain').val('')
                        swal("Success", data['message'], 'success')
                        showList(0, $('#agent_id').val());
                    }

                },
                error: function(data) {
                    console.log("Error: ", data);
                    console.log("Errors->", data.errors);
                }
            });

        }
    </script>
@endpush
