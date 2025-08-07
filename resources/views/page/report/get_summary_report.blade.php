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
                <th width="300px">Report Date</th>
                <th class="">Total Member / Active</th>
                <th class="">New Register Account / Deposit</th>
                <th class="">Total Turnover</th>
                <th class="">Total Win/Lose</th>
                <th class="">Total Deposit / Count</th>
                <th class="">Total Withdrawal / Count</th>
                <th class="">Total Adj (Deposit)</th>
                <th class="">Total Adj (Withdraw)</th>
                <th class="">Total Bonus Credit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td title="Transaction Date">{{ request()->filter_date_start }} 12:00:00 - {{ request()->filter_date_end
                    }} 11:59:59</td>
                <td title="Active Member" class="table-light">
                    {{ number_format($data->member_count) }} / <span class="green">{{ number_format($data->active_user) }}</span>
                </td>
                <td title="Register Acc / First Deposit" class="table-light">
                    {{ number_format($data->new_regitser_user) }} / {{ number_format($data->new_regitser_user_deposit)
                    }}
                </td>
                <td title="Total Turnover" class="dark-powder-blue font-weight-light">
                    {{ number_format($data->total_turnover,2) }}
                </td>
                <td title="Total Win/Lose" class="dark-powder-blue font-weight-light">
                    {{ number_format($data->total_win_lose,2) }}
                </td>
                <td title="Total Deposit" class="">
                    {{ number_format($data->deposit_total,2) }} / {{ number_format($data->deposit_count) }}
                </td>
                <td title="Total Withdrawal" class="">
                    {{ number_format($data->withdrawal_total,2) }} / {{ number_format($data->withdrawal_count) }}
                </td>
                <td title="Total Adj (Deposit)" class="">
                    {{ number_format($data->deposit_adj,2) }}
                </td>
                <td title="Total Adj (Withdrawal)" class="">
                    {{ number_format($data->withdrawal_adj,2) }}
                </td>
                <td title="Total Bonus Credit" class="">
                    {{ number_format($data->bonus_credit,2) }}
                </td>
            </tr>
        </tbody>

        <tfoot>
            <tr class="light-gray-backgroud">
                <th colspan=""></th>
                <th colspan="">Total</th>
                <th colspan="">
                    {{ number_format($data->member_count) }} / <span class="green">{{ number_format($data->active_user) }}</span>
                </th>
                <th colspan="">
                    {{ number_format($data->new_regitser_user) }} / {{ number_format($data->new_regitser_user_deposit)
                    }}
                </th>
                <th colspan="" class="dark-powder-blue font-weight-light">
                    {{ number_format($data->total_turnover,2) }}
                </th>
                <th colspan="" class="dark-powder-blue font-weight-light">
                    {{ number_format($data->total_win_lose,2) }}
                </th>
                <th colspan="" class="dark-powder-blue font-weight-light">
                    {{ number_format($data->deposit_total,2) }} / {{ number_format($data->deposit_count) }}
                </th>
                <th colspan="" class="dark-powder-blue font-weight-light">
                    {{ number_format($data->withdrawal_total,2) }} / {{ number_format($data->withdrawal_count) }}
                </th>
                <th colspan="" class="dark-powder-blue font-weight-light">
                    {{ number_format($data->deposit_adj,2) }}
                </th>
                <th colspan="" class="dark-powder-blue font-weight-light">
                    {{ number_format($data->withdrawal_adj,2) }}
                </th>
                <th colspan="" class="dark-powder-blue font-weight-light">
                    {{ number_format($data->bonus_credit,2) }}
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
</script>
