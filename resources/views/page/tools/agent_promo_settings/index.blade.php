@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Promotion Settings</h5>
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
                                        <a href="/agent_promo_settings/create" class="btn btn-sm btn-success btn-rounded"
                                            onclick="">New Banner</a>
                                    </div>
                                </div>

                            </div>
                            <div class="table-responsive">

                                <table class="table table-bordered table-hover tright medium BannerSettingTable">
                                    <thead>
                                        <tr>
                                            <th># </th>
                                            <th> Promotion Title </th>
                                            <th width="120px;"> Minimum Deposit Amt </th>
                                            <th width="120px;"> Bonus Percentage </th>
                                            <th width="120px;"> Maximum Bonus </th>
                                            <th> Claim Limit </th>
                                            <th> Turnover </th>
                                            <th width="120px;"> Category</th>
                                            <th> Display Image </th>
                                            <th width="120px;"> Promo Show At Deposit Page? </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;color:black">
                                        @forelse ($data->data as $item)
                                            <tr>
                                                <td> {{ $loop->iteration }} </td>
                                                <td> {{ $item->judul }} </td>
                                                <td> {{ number_format($item->minimal_deposit, 2) }} </td>
                                                <td> {{ number_format($item->bonus) }}% </td>
                                                <td> {{ number_format($item->max, 2) }} </td>
                                                <td> {{ number_format($item->max_claim) }} </td>
                                                <td> {{ number_format($item->turnover) }}X </td>
                                                <td>
                                                    @if ($item->bonus_type == 1)
                                                        Welcome Bonus
                                                    @elseif($item->bonus_type == 2)
                                                        First Deposit
                                                    @elseif($item->bonus_type == 3)
                                                        First Deposit Daily
                                                    @elseif($item->bonus_type == 4)
                                                        Redeposit
                                                    @else
                                                        Anytime
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->gambar != null)
                                                        <img src="{{ env('AWS_URL') }}{{ $item->gambar }}"
                                                            class="img-thumbnail" width="250px" />
                                                    @else
                                                        <span class="text-secondary">No Image</span>
                                                    @endif
                                                </td>
                                                <td> {{ $item->type == 2 ? 'Yes' : 'No' }} </td>
                                                <td> {{ ucfirst($item->status) }} </td>
                                                <td>
                                                    <div>
                                                        <a href="javascript:void(0)"
                                                            class="waves-effect waves-light btn btn-danger btn-sm btn-rounded"
                                                            onclick="deleteModel('{{ $item->id }}')">
                                                            <i class="fas fa-trash-alt"></i></a>
                                                    </div>
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
                    <div id="NewBanner_content" class="modal"></div>
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
                "searching": false,
                "order": [
                    [6, 'asc']
                ],
                "columnDefs": [{
                    bSortable: false,
                    targets: [0, 1, 2, 3, 4, 5, 7, 8, 9, 10]
                }],
                "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                    $("td:first", nRow).html(iDisplayIndex + 1);
                    return nRow;
                },
            });
        });
        $(document).ready(function() {
            $(`#NewBanner`).click(function(e) {
                e.preventDefault();
                $('#NewBanner_content').load('agent_promo_settings/create/');
                $('#NewBanner_content').modal("show");
            });
        });

        function deleteModel(id) {
            $('#NewBanner_content').load(`agent_promo_settings/edit?id=${id}`);
            $('#NewBanner_content').modal("show");
        };
    </script>
@endpush
