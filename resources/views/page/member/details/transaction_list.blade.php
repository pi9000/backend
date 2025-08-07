<style>
    table {
        font-weight: bold;
    }

    tr th {
        text-align: center;
    }

    .click {
        cursor: pointer;
    }

    .click:hover {
        background-color: #e2e2e2;
    }

    .green {
        color: blue;
    }

    .red {
        color: red;
    }

    .line {
        text-decoration: line-through;
    }
</style>
<div class="panel panel-bordered" id="transactionArea">
    <div class="panel-heading">
        <h5 class="panel-title" id="a">Transaction ({{ $data->user->username }}) :
            <span class="badge bg-dark text-light">{{ $data->startDate }} 00:00:00 - {{ $data->endDate }}
                23:59:59</span>
            <span class="badge bg-warning text-primary"><b>GMT +08:00</b></span>
        </h5>
    </div>
    <div class="panel-body">
        <div class="" id="transactionHistoryList"></div>
        <div class="  padding-top-20" id="other"></div>
    </div>
</div>
<table class="table table-sm table-bordered text-center table-hover medium table_transaction">

    <thead>
        <tr>
            <th> # </th>
            <th> Transaction Date </th>
            <th> TransID </th>
            <th> Transaction Type </th>
            <th> Bank / Method</th>
            <th> Status </th>
            <th> Transaction By </th>
            <th> Debit </th>
            <th> Credit </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data->data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td> {{ date('Y-m-d H:i:s', strtotime($item->created_at)) }} </td>
            <td>{{ $item->trx_id }}</td>
            <td>
                @if($item->transaksi == 'Top Up')
                Deposit
                @else
                Withdraw
                @endif
            </td>
            <td>{{ $item->metode }}</td>
            <td>
                @if($item->status == 'Rejected')
                <span class="label label-danger">Rejected</span>
                @else
                <span class="label label-success">Approved</span>
                @endif
            </td>
            <td>{{ $item->transaction_by }}</td>
            <td>
                @if($item->transaksi == 'Top Up')
                {{ number_format($item->total,2) }}
                @elseif ($item->transaksi == 'Top Up' && $item->status == 'Rejected')
                <strike>{{ number_format($item->total,2) }}</strike>
                @endif
            </td>
            <td>
                @if($item->transaksi == 'Withdraw')
                {{ number_format($item->total,2) }}
                @elseif ($item->transaksi == 'Withdraw' && $item->status == 'Rejected')
                <strike>{{ number_format($item->total,2) }}</strike>
                @endif
            </td>

        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th colspan="6"></th>
            <th>Total</th>
            <td> {{ number_format($data->sum_depo, 2) }}</td>
            <td> {{ number_format($data->sum_wd, 2) }} </td>
        </tr>
    </tfoot>

</table>

<script>
    $(document).ready(function() {
        $('.table_transaction').DataTable({

            "lengthMenu": [
                [50, 100, 150, 200, -1],
                [50, 100, 150, 200, "All"]
            ],
            "pageLength": 50,
            "ordering": false,
            "info": false,

        });

    });
</script>
