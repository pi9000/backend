<style media="screen">
    .date_button:active {
        box-shadow: none;
    }

    .date_button:hover {
        background-color: white;
        color: black !important;
    }

    .grey {
        color: grey;
        opacity: 0.5;
    }
</style>
<div class="panel panel-bordered mt-3" id="statementArea">
    <div class="panel-body">
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

        <div class="panel-heading">
            <h5 class="panel-title" id="a">Game Statement ({{ $data->user->username }}) :
                <span class="badge bg-dark text-light">Total Turn Over [
                    {{ number_format($data->game_history_bet + $data->game_history_win, 2) }} ]</span>
            </h5>
        </div>

        <table class="table_statement table table-sm table-bordered table-hover text-center medium ">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Provider</th>
                    <th>Game Name</th>
                    <th>Game Type</th>
                    <th>Bet</th>
                    <th>Win</th>
                    <th>Game Code</th>
                    <th>Before Balance</th>
                    <th>After Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->game_history as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}
                        </td>
                        <td>{{ $item->provider }}</td>
                        <td>{{ $item->game_name }}</td>
                        <td>{{ $item->game_type }}</td>
                        <td class="red">{{ number_format($item->bet_amount, 2) }}</td>
                        <td class="green">{{ number_format($item->win_amount, 2) }}</td>
                        <td>{{ $item->game_code }}</td>
                        <td class="green">{{ number_format($item->before_balance, 2) }}</td>
                        <td class="green">{{ number_format($item->after_balance, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5">Total</th>
                    <th class="red">{{ number_format($data->game_history_bet, 2) }}</th>
                    <th class="green">{{ number_format($data->game_history_win, 2) }} </th>

                </tr>
            </tfoot>
        </table>

    </div>
</div>
<script>
    $(document).ready(function() {
        $('.table_statement').DataTable({

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
