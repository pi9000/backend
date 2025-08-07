@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Credit Logs</h5>

        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">

            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-lg-8 col-sm-8 align-center">
                                <h5 class="m-0">Agent Credit Logs</h5>

                            </div>
                        </div>
                    </div>
                    <style>
                        .star-color {
                            color: #eeee05;
                        }

                        .dataTables_length {

                            margin-right: 20px;
                        }

                        .scrolledTable {
                            overflow-y: auto;
                            clear: both;
                        }

                        .table th {

                            padding: 8px 3px !important;
                        }
                    </style>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover tright text-center medium" id="credit-logs">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Date & Time</th>
                                    <th>Transaction Id</th>
                                    <th>Transaction Type</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody class="text-right">
                                @foreach ($logs as $log)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $log->username }}</td>
                                        <td>{{ $log->created_at }}</td>
                                        <td>{{ $log->transaction_id }}</td>
                                        <td>{{ $log->transaction_type }}</td>
                                        <td class="text-danger">{{ number_format($log->debit, 2) }}</td>
                                        <td class="text-primary">{{ number_format($log->credit, 2) }}</td>
                                        <td class="text-success">{{ number_format($log->balance, 2) }}</td>
                                        <td>{{ $log->note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>

                                <th class="text-center">Total: </th>
                                <th class="text-danger text-center">{{ number_format($logs->sum('debit'),2) }}</th>
                                <th class="text-primary text-center">{{ number_format($logs->sum('credit'),2) }} </th>
                                <th></th>
                                <th></th>
                            </tfoot>
                        </table>

                    </div>


                    <script>
                        $(document).ready(function() {

                            $('#credit-logs').DataTable({
                                dom: 'lBfrtip',
                                "lengthMenu": [
                                    [
                                        50, 100, 150, 200, -1
                                    ],
                                    [
                                        50, 100, 150, 200, "All"
                                    ]
                                ],
                                "pageLength": 50,
                                "info": false,
                                columnDefs: [{
                                    bSortable: false,
                                    targets: [0, 1, 2]
                                }],
                                buttons: [{
                                        extend: 'copyHtml5',
                                        footer: true
                                    },
                                    {
                                        extend: 'excelHtml5',
                                        footer: true
                                    },
                                    {
                                        extend: 'csvHtml5',
                                        footer: true
                                    },
                                    {
                                        extend: 'pdfHtml5',
                                        footer: true
                                    }
                                ]
                            });

                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
@endsection
