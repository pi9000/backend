<!-- page starts here -->
<style>
    .star-color {
        color: #eeee05;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="panel-heading">
                            <h5 class="panel-title">Search Criteria :<span
                                    class="label label-sm label-danger">{{ request()->daterange }}</span></h5>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered fixed-table table-hover toggle-circle winloseTable ">
                                <thead>
                                    <tr>
                                        <th class="text-center"> No</th>
                                        <th class="text-center"> Transaction Date</th>
                                        <th class="text-center"> Transaction ID</th>
                                        <th class="text-center"> Account Name </th>
                                        <th class="text-center"> Username </th>
                                        <th class="text-center"> Upline Ref ID </th>
                                        <th class="text-center"> Ref No</th>
                                        <th class="text-center"> Fund Method </th>
                                        <th class="text-center"> Bonus </th>
                                        <th class="text-center"> Status</th>
                                        <th class="text-center"> Receipt</th>
                                        <th class="text-center"> Debit </th>
                                        <th class="text-center"> Credit</th>
                                        <th class="text-center"> Comfirmed/Rejected by</th>
                                        <th class="text-center"> Comfirmed/Rejected time</th>
                                        <th class="text-center"> Agent Id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->data as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                {{ date('Y-m-d 23:59:59', strtotime($item->created_at)) }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('transactions/instant_transaction/' . $item->trx_id) }}"
                                                    target="_blank"><span
                                                        id="id_{{ $item->trx_id }}">{{ $item->trx_id }}</span></a>
                                            </td>

                                            <td class="text-center">
                                                {{ $item->user->nama_pemilik }}
                                                <span>
                                                    / {{ strtoupper($item->user->nama_bank) }}
                                                </span>
                                                <div class="text-primary">
                                                    {{ $item->user->nomor_rekening }}
                                                </div>

                                            </td>
                                            <td class="text-center">
                                                @if ($item->user->deposit == 0)
                                                    <div class="">
                                                        <span class="badge badge-pill badge-danger">First Time</span>
                                                    </div>
                                                @endif
                                                <a href="{{ url('member_details/' . $item->user->extplayer) }}"
                                                    target="_blank">
                                                    <span
                                                        id="trans_{{ $item->user->extplayer }}">{{ $item->user->username }}</span>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                @if ($item->transaksi == 'Top Up')
                                                    <span class="label label-primary">Deposit</span>
                                                @else
                                                    <span class="label label-warning">Withdraw</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($item->metode == 'Payment Gateway')
                                                    <a href="{{ $item->keterangan }}" target="_blank"
                                                        class="waves-effect waves-light btn btn-success btn-sm btn-block btn-rounded">Payment
                                                        Links</a>
                                                @else
                                                    {{ $item->keterangan }}
                                                @endif
                                            </td>
                                            <td align="center">
                                                {{ $item->metode }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->bonus != 'tanpabonus' ? $item->bonuse->judul : '' }}
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status == 'Sukses')
                                                    <span class="label label-success">Confirmed</span>
                                                @else
                                                    <span class="label label-danger">Rejected</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->gambar)
                                                    <a href="javascript:void(0)"
                                                        onclick="showModal( '{{ url('transactions/view_receipt?i=' . $item->gambar) }}' , '.modal-sm', '#receipt' )"
                                                        class="waves-effect waves-light btn btn-success btn-sm btn-block btn-rounded">View</a>
                                                @else
                                                    <a href="javascript:void(0)"
                                                        class="waves-effect waves-light btn btn-danger btn-sm btn-block btn-rounded">X</a>
                                                @endif
                                            </td>

                                            <td align="right" class="amount_font">
                                                {{ $item->status == 'Ditolak' ? '<strike>' : '' }}{{ $item->transaksi == 'Withdraw' ? number_format($item->total, 2) : '' }}{{ $item->status == 'Ditolak' ? '</strike>' : '' }}
                                            </td>
                                            <td align="right" class="amount_font">
                                                {{ $item->status == 'Ditolak' ? '<strike>' : '' }}{{ $item->transaksi == 'Top Up' ? number_format($item->total, 2) : '' }}{{ $item->status == 'Ditolak' ? '</strike>' : '' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->transaction_by }}
                                            </td>
                                            <td class="text-center">
                                                {{ date('Y-m-d 23:59:59', strtotime($item->updated_at)) }}
                                            </td>
                                            <td class="text-center">
                                                {{ $item->agent_id }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan=""></th>
                                        <th colspan=""></th>
                                        <th colspan=""></th>
                                        <th colspan=""></th>
                                        <th colspan=""></th>
                                        <th colspan=""></th>
                                        <th colspan=""></th>
                                        <th colspan=""></th>
                                        <th colspan=""></th>
                                        <th colspan=""></th>
                                        <th colspan=""></th>

                                        <th colspan="" align="center">Total</th>
                                        <th colspan="" align="right" class="amount_font">
                                            {{ number_format($data->sum_debit,2) }}
                                            <i class="text-danger"></i>
                                        </th>
                                        <th colspan="" align="center" class="amount_font">
                                            {{ number_format($data->sum_credit,2) }}
                                            <i class="text-danger"></i>
                                        </th>
                                        <th colspan="3"></th>
                                        <th colspan="3"></th>
                                        <th colspan="3"></th>
                                        <th colspan="3"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="panel">
    <div class="panel-heading">

    </div>
    <div class="panel-body container-fluid">
        <div class="table-responsive">

        </div>
    </div>
</div>
<!--- page ends here -->

<script>
    $(document).ready(function() {
        let d_table = null;
        window.trans_record = Array.from({
            length: 15
        }, (_, i) => i); // <== 0 sampai 15

        function preset_filter() {
            let stored = localStorage.getItem('trans_record_filter');
            if (!stored) {
                localStorage.setItem('trans_record_filter', "");
                return;
            }

            let arr = stored.split(',');
            arr.forEach(preset_filter_function);
        }

        function preset_filter_function(item) {
            if (item !== "" && d_table) {
                const column = d_table.column(parseInt(item));
                if (column) column.visible(false);
            }

            setTimeout(() => {
                $('#lahanat_member').attr('disabled', false);
            }, 2000);
        }

        setTimeout(() => {
            d_table = $('.winloseTable').DataTable({
                dom: 'lBfrtip',
                lengthMenu: [
                    [50, 100, 150, 200, -1],
                    [50, 100, 150, 200, "All"]
                ],
                pageLength: 50,
                info: false,
                scrollX: true,
                scroller: true,
                buttons: ['copy', 'excel', 'print'],
                columnDefs: window.trans_record.map(index => ({
                    className: 'transcol' + (index + 1),
                    targets: index
                }))
            });

            preset_filter();
        }, 1000);

        setTimeout(() => {
            $('#table_replace').css({
                display: 'block',
                opacity: '0'
            });
            if (d_table) d_table.draw();
        }, 1500);

        setTimeout(() => {
            $("#loading-image").hide();
            $('#table_replace').css('opacity', '1');
        }, 2000);
    });
</script>
