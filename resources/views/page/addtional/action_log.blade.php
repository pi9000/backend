@extends('layouts.main')
@section('panel')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h5 class="text-themecolor"> Action Log </h5>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <!-- <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Agent</li> -->
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-md-12 ">
                                <table class="table table-bordered table-hover tright text-center medium table-css"
                                    id="results" style="table-layout:fixed;width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="middle" style="max-width:20px;"> # </th>
                                            <th class="middle" style="width:100px;"> Brand ID </th>
                                            <th class="middle"> Action </th>
                                            <th class="logs" style="width:180px;"> Logs </th>
                                            <th class="middle"> By Agent </th>
                                            <th class="middle"> IP Address </th>
                                            <th class="middle"> Country </th>
                                            <th class="middle"> Created At </th>
                                        </tr>
                                    </thead>
                                </table>
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
    var global_date_range = { _token : $("meta[name=csrf-token]").attr("content") , 'd_start': moment().format('YYYY-MM-DD'), 'd_end': moment().format('YYYY-MM-DD'),'search':$("#search_text").val(),'search_criteria_type':$("#search_criteria_type").val() };

   function decodeHtmlEntities(str) {
      return str.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
   }
   function loadAction_log(datas) {
      $('#results').DataTable().clear().destroy();
      $('#results').DataTable({
         "scrollX": true,
         "scroller": true,
         "processing": true,
         "serverSide": true,
         "searching":false,
         "order": [[ 0, "desc" ]],
         "ajax":{
            "url": "/action_logs",
            "dataType": "json",
            "type": "POST",
            "data":datas
         },
         "columns": [
            { "data": "id" },
            { "data": "agent_id" },
                        { "data": "action" },
            {
            "data": "description",
            "render": function(data, type, row) {
                if (data !== null) {
                    return decodeHtmlEntities(data);
                }
                return data;
            }
           },
            { "data": "user_id" },
            { "data": "ip_address" },
            { "data": "country" },
            { "data": "created_at" }
         ],

        });

   }
   $(document).ready(function(){
        loadAction_log(global_date_range);
   });

</script>
@endpush
