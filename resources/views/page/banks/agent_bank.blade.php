@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Fund Method Listing</h5>
        </div>
        <div class="col-md-7 align-self-center">
            <div style="float: right; margin-right: 10px; font-size: 16px; line-height: 16px;">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title" style="display:none;">


                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Fund Method</label>
                                <select name="fund_method" id="fund_method" class="form-control">
                                    <option value="5">Bank</option>
                                    <option value="6">Pulsa</option>
                                    <option value="7">E-wallet</option>
                                    <option value="8">Crypto Currency</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="">Status</label>
                                <select name="status" id="status" class="form-control">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="bank_table">
                        <div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg" ></i></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $(document).ready(function() {

            let string = window.location.search;
            let method = new URLSearchParams(string).get('method');
            let status = new URLSearchParams(string).get('status');

            if (method == null) {
                method = 5;
            }
            changeMethod(method);
            if (status == null) {
                status = 1;
            }
            $('#fund_method').val(method);
            $('#status').val(status);
            loadbank($('#fund_method').val(), status);

            $(`#fund_method,#status`).change(function() {
                let fund_method = $('#fund_method').val();
                let status = $('#status').val();
                changeMethod(fund_method, status);
                loadbank(fund_method, status);

            });

        })

        function loadbank(method, status) {
            $('#bank_table').load(`/agent_bank_accounts_table?method=${method}&status=${status}`);
        }

        function changeMethod(fund_method, status) {
            if (fund_method == 7 || fund_method == 5) {
                $('#status').html(
                    '<option value="1" selected="">publish</option><option value="2">Internal</option><option value="0">Inactive</option>'
                    );
            } else {
                $('#status').html('<option value="1">Active</option><option value="0">Inactive</option>');
            }
            $("#status").val(status);
        }
    </script>
@endpush
