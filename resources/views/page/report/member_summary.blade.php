<style>
    .green {
        color: blue;
    }

    .red {
        color: red;
    }
</style>
<h6 class="card-title">
    Search By Date :
    <span class="badge bg-dark text-light p-1 font-weight-bold h5">
        GMT +8 ({{ request()->filter_date_start }} 00:00:00 - {{ request()->filter_date_end }} 23:59:59)*
    </span>
</h6>

<div class="table-responsive">
    <table class="bank-summary table table-hover table-sm table-bordered table-stripped text-center"
        style="width: 100%">
        <thead>
            <tr class="font-weight-normal">
                <th>#</th>
                <th class="">Register Date</th>
                <th class="">Last Deposit Date</th>
                <th class="" width="130px">Username</th>
                <th class="" width="130px">Last Deposit Amount</th>
                <th class="" width="130px">Total Deposit</th>
                <th class="" width="130px">Total Withdrawal</th>
                <th class="">Total Profit</th>
                <th class="">Bonus</th>
                <th class="">Remark</th>
                <th class="" width="130px">Total Deposit Count</th>
                <th class="" width="130px">Total Withdrawal Count</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->created_at }}</td>
                <td>{{ $item->last_deposit_date }}</td>
                <td>
                    <span>
                        <a href='/member_details/{{ $item->extplayer }}' target="_blank">
                            <span class="">
                            </span>
                            <span>
                                <span id='uname_{{ $item->extplayer }}' class="">{{ $item->username }}</span>
                            </span>
                            <span class="">
                        </a>
                        <br>
                        <i onclick="Copytext('uname_{{ $item->extplayer }}')" class="far fa-copy pointer"
                            style="font-size:15px;" aria-hidden="true" title="Copy"></i>
                    </span>
                </td>
                <td>{{ number_format($item->last_deposit_amount, 2) }}</td>
                <td class="{{ $item->total_deposit > 0 ? 'green' : '' }}">{{ number_format($item->total_deposit, 2) }}
                </td>
                <td class="{{ $item->total_withdraw > 0 ? 'red' : '' }}">{{ $item->total_withdraw > 0 ? '-' : '' }}{{
                    number_format($item->total_withdraw, 2) }}</td>
                <td>{!! $item->total_sale !!}</td>
                <td>{!! $item->bonuses !!}</td>
                <td>{{ $item->remark }}</td>
                <td>{{ number_format($item->total_deposit_count) }}</td>
                <td>{{ number_format($item->total_withdraw_count) }}</td>
            </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr class="light-gray-backgroud">
                <th colspan="4">Total</th>
                <th colspan="">
                    @php
                    echo number_format(collect($data->data)->sum(function($d) {
                    return str_replace(',', '', $d->last_deposit_amount);
                    }), 2);
                    @endphp
                </th>
                <th colspan="" class="green">
                    @php
                    echo number_format(collect($data->data)->sum(function($d) {
                    return str_replace(',', '', $d->total_deposit);
                    }), 2);
                    @endphp
                </th>
                <th colspan="" class="red">
                    @php
                    echo number_format(collect($data->data)->sum(function($d) {
                    return str_replace(',', '', $d->total_withdraw);
                    }), 2);
                    @endphp
                </th>
            </tr>
        </tfoot>
    </table>
</div>

<script type="text/javascript">
    $('.bank-summary').DataTable({
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
            bSortable: true,
            targets: [0, 1, 2]
        }],
        buttons: ['copy', 'excel', 'print']
    });

    function Copytext(e) {

        const el = document.createElement('textarea');
        el.value = document.getElementById(e).innerHTML;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);


        /* Get the text field */
        var copyText = document.getElementById(e).innerHTML;


        swal("Copied the text: " + el.value);
    }
</script>
