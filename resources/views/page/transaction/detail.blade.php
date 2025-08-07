@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Transaction Info</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-bordered table-hover toggle-circle winloseTable ">
                                <thead>
                                    <tr>
                                        <th colspan="2" class=""> Transaction Detail - {{ $data->username }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="" style='width:200px'>TransID</td>
                                        <td class="">{{ $data->trx_id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="" style=''>Admin Subsidi</td>
                                        <td class="text-danger">
                                            0.00
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="" style=''>Admin Fee</td>
                                        <td class="text-danger">0.00</td>
                                    </tr>
                                    <tr>
                                        <td class="" style=''>Amount</td>
                                        <td class="">
                                            @if ($data->status == 'Ditolak')
                                                <strike>{{ number_format($data->total, 2) }}</strike>
                                            @else
                                                {{ number_format($data->total, 2) }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="" style=''>Fund Method</td>
                                        <td class="">
                                            {{ $data->metode }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="" style=''>Transaction Date</td>
                                        <td class="">
                                            {{ date('Y-m-d H:i:s', strtotime($data->created_at)) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="" style=''>Transaction Type</td>
                                        <td class="text-info" style="font-weight:bold">
                                            @if ($data->transaksi == 'Top Up')
                                                Deposit
                                            @elseif($data->transaksi == 'Withdraw')
                                                Withdraw
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>

                                        <td class="" style=''>Status</td>
                                        @if ($data->status == 'Pending')
                                            <td class="text-warning" style="font-weight:bold">
                                                In Progress
                                            </td>
                                        @elseif($data->status == 'Ditolak')
                                            <td class="text-danger" style="font-weight:bold">
                                                Rejected
                                            </td>
                                        @else
                                            <td class="text-success" style="font-weight:bold">
                                                Approved
                                            </td>
                                        @endif

                                    </tr>

                                    <tr>
                                        <td class="" style=''>Confirmed/Rejected By</td>
                                        <td class="">
                                            {{ $data->status != 'Pending' ? $data->transaction_by : '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="" style=''>Confirmed/Rejected Date</td>
                                        <td class="">
                                            {{ $data->status != 'Pending' ? date('Y-m-d H:i:s', strtotime($data->updated_at)) : '' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-hover toggle-circle winloseTable ">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="">Representative Bank Users</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="" style='width:200px'>Bank Name</td>
                                        <td class="">{{ strtoupper($data->user->nama_bank) }}</td>
                                    </tr>

                                    <tr>
                                        <td class="" style=''>Bank Account Name</td>
                                        <td class="">{{ $data->user->nama_pemilik }}</td>
                                    </tr>

                                    <tr>
                                        <td class="" style=''>Bank Account No</td>
                                        <td class="">{{ $data->user->nomor_rekening }}</td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                    @if ($data->status == 'Pending')
                        <div class="col-md-12">
                            <div class="text-center">
                                <a href="{{ url('transactions/instant_transaction/confirm/'.$data->trx_id) }}?amount={{ $data->total }}&type={{ $data->transaksi }}"
                                    id="confirm_bt" value="Confirm"
                                    onclick="return confirm('Are you sure you want to confirm this transaction?')"
                                    class="waves-effect waves-light btn btn-success btn-sm btn-rounded"
                                    style="font-weight:500;"> Confirm
                                </a>
                                <a href="{{ url('transactions/instant_transaction/reject/'.$data->trx_id) }}?amount={{ $data->total }}&type={{ $data->transaksi }}"
                                    value="Confirm"
                                    onclick="return confirm('Are you sure you want to reject transaction?')"
                                    class="waves-effect waves-light btn btn-danger btn-sm btn-rounded"
                                    style="font-weight:500;">
                                    Reject
                                </a>

                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.transactTable').DataTable({
                "pageLength": 50
            });
        });
    </script>
@endpush
