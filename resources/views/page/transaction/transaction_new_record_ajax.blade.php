<style>
    .dataTables_wrapper>.row:nth-child(1) {
        width: 70%;
    }

    .panel-heading {
        position: absolute;
        right: 1.25rem;
        top: 1.25rem;
    }

    .table-pink td,
    .table-pink:hover td {
        background-color: pink;
    }

    .table-orange td,
    .table-orange:hover td {
        background-color: #fcac44;
    }

    .table-border-red td,
    .table-border-red:hover td {
        border-color: red !important;
        background-color: #ff880010;
    }
</style>
<div class="row">
    <div class="col-12">
        <i class="text-danger">Notice: Maximum first 300 transaction load.</i>
    </div>
    <div class="col-12">
        <input type="hidden" id="payment" value="" />
        <input type="hidden" id="view_redirect" name="view_redirect" value="deposit" />

        <div class="card shadow">
            <div class="card-body">
                <div class="">
                    <table class="table table-bordered table-hover toggle-circle instant">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Transaction Date</th>
                                <th class="text-center">Transaction ID</th>
                                <th class="text-center">Transaction Type</th>
                                <th class="text-center">Account Name</th>
                                <th class="text-center">Username</th>
                                <th class="text-center" style="width: 50px">Ref No</th>
                                <th class="text-center">Fund Method</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Receipt</th>
                                <th class="text-center td_debit">Debit</th>
                                <th class="text-center td_credit">Credit</th>
                                <th></th>
                                <th></th>
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
                                        <br />
                                        <i onclick="Copytext('id_{{ $item->trx_id }}')" class="far fa-copy pointer"
                                            aria-hidden="true"></i>
                                    </td>
                                    <td class="text-center">
                                        @if ($item->transaksi == 'Top Up')
                                            <span class="label label-primary">Deposit</span>
                                        @else
                                            <span class="label label-warning">Withdraw</span>
                                        @endif

                                        <div class="text-danger">
                                            <i></i>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{ $item->user->nama_pemilik }} / {{ strtoupper($item->user->nama_bank) }}
                                        <div class="text-primary">{{ $item->user->nomor_rekening }}</div>
                                    </td>
                                    <td class="text-center">
                                        @if ($item->user->deposit == 0)
                                            <div class="">
                                                <span class="badge badge-pill badge-danger">First Time</span>
                                            </div>
                                        @endif
                                        <a href="{{ url('member_details/' . $item->user->extplayer) }}" target="_blank">
                                            <span
                                                id="trans_{{ $item->user->extplayer }}">{{ $item->user->username }}</span>
                                        </a>
                                        <br />
                                        <i onclick="Copytext('trans_{{ $item->user->extplayer }}')"
                                            class="far fa-copy pointer" aria-hidden="true"></i>
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
                                    <td class="text-center">{{ $item->metode }}</td>
                                    <td class="text-center">
                                        <span class="label label-warning">In Progess</span>

                                        <div class="text-danger">
                                            <i></i>
                                        </div>
                                    </td>
                                    <td class="no-padding text-center">
                                        @if ($item->gambar)
                                            <a href="javascript:void(0)"
                                                onclick="showModal( '{{ url('transactions/view_receipt?i=' . $item->gambar) }}' , '.modal-sm', '#receipt' )"
                                                class="waves-effect waves-light btn btn-success btn-sm btn-block btn-rounded">View</a>
                                        @else
                                            <a href="javascript:void(0)"
                                                class="waves-effect waves-light btn btn-danger btn-sm btn-block btn-rounded">X</a>
                                        @endif
                                    </td>

                                    <td align="right" class="amount_font text-center td_debit">
                                        <div>
                                            <div class="">
                                                {{ $item->transaksi == 'Withdraw' ? number_format($item->total, 2) : 0.0 }}
                                            </div>
                                        </div>
                                    </td>
                                    <td align="right" class="amount_font td_credit">
                                        <div>
                                            <div class="">
                                                {{ $item->transaksi == 'Top Up' ? number_format($item->total, 2) : 0.0 }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="no-padding">
                                        <a href="{{ url('transactions/instant_transaction/confirm/' . $item->trx_id) }}?amount={{ $item->total }}&type={{ $item->transaksi }}"
                                            data-msg="Are you sure you want to confirm this transaction?"
                                            value="Confirm"
                                            class="waves-effect waves-light btn btn-success btn-sm btn-block btn-rounded"
                                            style="font-weight: 500">
                                            Confirm
                                        </a>
                                    </td>
                                    <td class="no-padding">
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#reject"
                                            class="waves-effect waves-light btn btn-danger btn-sm btn-block btn-rounded"
                                            style="font-weight: 500"
                                            onclick="showModal('{{ url('transactions/instant_transaction/rejects/' . $item->trx_id) }}?amount={{ $item->total }}&type={{ urlencode($item->transaksi) }}', '.modal-lg', '#reject')">Reject</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <audio id="chatAudio">
                        <source src="{{ asset('assets/sounds/notify.wav') }}" type="audio/wav" />
                    </audio>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal modal-special" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"></div>
    </div>
</div>

<script type="text/javascript">
    function showModal(url, id = "", classes = "") {
        if (url.includes("(Silahkan Hubungi CS)")) {
            swal({
                title: "Sorry!",
                text: "Please update the bank account.no before transaction.",
                icon: "error",
                allowOutsideClick: false,
                closeOnClickOutside: false,
                button: "Okay",
            });
        } else {
            if (id == "#high_transinfo") {
                $(".modal-special .modal-dialog").addClass(id.replace("#", ""));
                $(".modal-special .modal-dialog").addClass(classes.replace(".", ""));
                $(".modal-special .modal-content").load(url);
                $(".modal.modal-special").modal("show");
            } else {
                $(".modal-dialog").addClass(id.replace("#", ""));
                $(".modal-dialog").addClass(classes.replace(".", ""));
                $(".modal-content").load(url);
                $(".modal").modal("show");
            }
        }
    }

    function hideModal() {
        $(".modal.modal-special").modal("hide");
    }

    $(".modal.modal-special").on("hidden.bs.modal", function() {
        $(".modal-special .modal-content").html("");
        window.pause = false;
    });
</script>
<style>
    a[disabled="disabled"] {
        pointer-events: none;
    }
</style>
<script>
    $(document).ready(function() {
        afterdata = $("#searchtransaction").serialize();
        $("#check-all").on("click", function() {
            // $('.multi_check').click();
            $(".multi_check")
                .prop("checked", $(this).is(":checked"))
                .trigger("change");
        });
        $(".multi_check").on("change", function() {
            if ($(this).is(":checked")) {
                $(this).parents("tr").addClass("table-info");
            } else {
                $(this).parents("tr").removeClass("table-info");
            }
        });
        $("#multi-confirm").on("click", function() {
            var token = {
                _token: $('meta[name="csrf-token"]').attr("content")
            };
            var input = $('input[name="multi[]"]').filter(":checked").serialize();
            var data = $.param(token) + (input ? "&" + input : "");
            var thise = $(this);
            if (!input) {
                toastMessage(
                    "warning",
                    "No Selected Transaction! Please select one.",
                    "#ff6849",
                    "warning"
                );

                return false;
            }
            if ($(this).attr("disabled")) {
                return false;
            } else {
                $(this).attr("disabled", true);
                if (
                    !confirm(
                        "Multiple Select to confirm! Are you sure to confirm multiple?"
                    )
                ) {
                    $(this).attr("disabled", false);
                    return false;
                }
            }
            $.post(
                "{{ url('transactions/instant_transaction/multi_confirm') }}",
                data,
                function(d) {
                    thise.attr("disabled", false);
                    toastMessage(d.s, d.m, "#ff6849", d.s);
                    $("#load_tweets")
                        .load(url + "?" + afterdata)
                        .fadeIn("slow");
                }
            );
        });

        $("#multi-reject").on("click", function() {
            var token = {
                _token: $('meta[name="csrf-token"]').attr("content")
            };
            var input = $('input[name="multi[]"]').filter(":checked").serialize();
            var data = $.param(token) + (input ? "&" + input : "");
            var thise = $(this);

            if (!input) {
                toastMessage(
                    "warning",
                    "No Selected Transaction! Please select one.",
                    "#ff6849",
                    "warning"
                );

                return false;
            }
            window.pause = true;
            showModal(
                "{{ url('transactions/instant_transaction/multi_reject_form') }}?" +
                data,
                "#multi_reject"
            );
        });
    });
</script>
<script>
    function clickConfirm(e) {
        e.preventDefault();
        window.location.href = $(this).attr("href");
    }

    $(document).ready(function() {
        let afterdata = $("#searchtransaction").serialize();
        let url = "{{ url('transactions/transaction_new_record_ajax') }}";
        voption = window.options.map(function(item) {
            return parseInt(item);
        });
        d_table = $(".instant").DataTable({
            // "paging": false,
            pageLength: 150,
            scrollX: true,
            scroller: true,
            bDestroy: true,
            search: {
                search: search_value,
            },
            columnDefs: [{
                    targets: voption,
                    visible: true
                },
                {
                    targets: "_all",
                    visible: false
                },
                {
                    targets: 13,
                    orderable: false
                },
            ],
        });
        d_table.on("draw", function() {
            $('a[value="Confirm"]').off("click", clickConfirm);
            $('a[value="Confirm"]').on("click", clickConfirm);
        });

        $('a[value="Confirm"]').off("click", clickConfirm);
        $('a[value="Confirm"]').on("click", clickConfirm);

        preset_filter();

        function preset_filter() {
            // check current local storage
            var objectArray = [];
            var retrievedObject = localStorage.getItem("instant_filter");
            if (retrievedObject == null) {
                localStorage.setItem("instant_filter", "");
                retrievedObject = localStorage.getItem("instant_filter");
            }
            objectArray = retrievedObject.split(",");
            objectArray.forEach(preset_filter_function);
        }

        function preset_filter_function(item, index, arr) {
            if (item != "") {
                if (window.options.includes(item)) {
                    oindex = window.options.indexOf(item);
                    window.options.splice(oindex, 1);
                }

                column = d_table.column(item);

                // Toggle the visibility
                column.visible(false);
            }
        }
    });

    function Copytext(e) {
        const el = document.createElement("textarea");
        el.value = document.getElementById(e).innerHTML;
        document.body.appendChild(el);
        el.select();
        document.execCommand("copy");
        document.body.removeChild(el);

        /* Get the text field */
        var copyText = document.getElementById(e).innerHTML;

        swal("Copied the text: " + el.value);
    }
</script>

<script>
    $("#chatAudio")[0].play();
</script>

<script>
    $(".td_credit").show();
</script>
