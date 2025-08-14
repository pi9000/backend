@extends('layouts.main')
@section('panel')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h5 class="text-themecolor">Luckyspin Prize Settings</h5>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col" id="account_table">
                <style>
                    th {
                        text-align: center;
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


                    label {
                        text-align: left;
                    }

                    .dropify-message p {
                        text-align: center;
                    }
                </style>
                <!-- Trigger/Open The Modal -->




                <div class="card shadow">
                    <div class="card-body">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 align-center">
                                    <h5 class="m-0">Agent</h5>
                                </div>
                                <div class="col-lg-6 col-sm-6  text-sm-right">
                                    <a href="/luckyspin_prize_settings/create" class="btn btn-sm btn-success btn-rounded"
                                        onclick="">New Prize</a>
                                </div>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover tright medium BannerSettingTable">
                                <thead>
                                    <tr>
                                        <th># </th>
                                        <th> Agent ID </th>
                                        <th> Title </th>
                                        <th width="120px;"> Win Rate </th>
                                        <th width="120px;"> Win Amount </th>
                                        <th width="120px;"> Image </th>
                                        <th width="120px;"> Created At </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center;color:black">
                                    @forelse ($data->prize as $item)
                                    <tr>
                                        <td> {{ $loop->iteration }} </td>
                                        <td> {{ $item->agent_id }} </td>
                                        <td> {{ $item->title }} </td>
                                        <td> {{ number_format($item->probability) }}% </td>
                                        <td> {{ number_format($item->win,2) }} </td>

                                        <td>
                                            @if ($item->value != null)
                                            <img src="{{ $item->value }}" class="img-thumbnail" width="250px" />
                                            @else
                                            <span class="text-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td> {{ date('Y-m-d H:i:s',strtotime($item->created_at)) }} </td>
                                        <td>
                                            <a href="{{ url('luckyspin_update?uid=' . $item->id) }}"
                                                class="waves-effect waves-light btn btn-danger btn-sm btn-rounded"
                                                onclick="return confirm('Are you sure want to delete this prize?');">
                                                <i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="13" align="center"> No Records Found. </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

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
            $('.BannerSettingTable').DataTable({
                "paging": false,
                "info": false,
                "searching": true,
            });
        });
</script>
@endpush
