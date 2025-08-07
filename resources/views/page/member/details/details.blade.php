@extends('layouts.main')
@section('panel')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">

        <h5 class="text-themecolor">Member</h5>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="javascript:void(0)">Member</a>
            </li>
            <li class="breadcrumb-item active">
                Detail</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="panel panel-bordered">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    {{ $data->user->extplayer }}
                                </h3>
                            </div>
                            <div class="panel-body container-fluid">
                                <div class="example-wrap">

                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active"
                                                data-href="/member_details/details/{{ $data->user->extplayer }}"
                                                data-toggle="tab" href="#details"
                                                onclick="member_details('{{ $data->user->extplayer }}')">Details</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#transactionHistory"
                                                onclick="getTransHistory('{{ $data->user->extplayer }}')">Transaction</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#member_statement"
                                                onclick="member_statement('{{ $data->user->extplayer }}')">Game
                                                Statement</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content padding-top-20">
                                        <div class="tab-pane " id="details" role="tabpanel">

                                            <div class="" id="member_basic_details"></div>

                                        </div>
                                        <div class="tab-pane  " id="member_statement" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    <div class="" id="member_details_statement">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane " id="transactionHistory" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="" id="member_transaction_history"></div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {

             $('.tab-pane').hide();
             $('#details').show();

             $('.nav-link').click(function() {
                 $('.tab-pane').hide();
                 $($(this).attr('href')).show();
             });

             member_details('{{ $data->user->extplayer }}');

         });

         function member_details(id) {
             $("#member_basic_details").html(
                 '<div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg" ></i></div></div>'
                 );
             $.post('/member_details/details', {
                 _token: $("meta[name=csrf-token]").attr("content"),
                 player_id: id
             }, function(data) {
                 $('#member_basic_details').html(data);
             });
         }

         function member_statement(id) {
             $("#member_details_statement").html(
                 '<div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg" ></i></div></div>'
                 );
             $.post('/member_details/game_statement', {
                 _token: $("meta[name=csrf-token]").attr("content"),
                 player_id: id
             }, function(data) {
                 $('#member_details_statement').html(data);
             });
         }

         function getTransHistory(id) {
             $("#member_transaction_history").html(
                 '<div id="loading"  align="center"><div id="spinner">Loading <i class="fa fa-spinner fa fa-spin fa-lg" ></i></div></div>'
                 );
             $.post('/member_details/bank_transaction_history', {
                 _token: $("meta[name=csrf-token]").attr("content"),
                 player_id: id
             }, function(data) {
                 $('#member_transaction_history').html(data);
             });
         }
</script>
@endpush
