@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Game Controll</h5>

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
                                <h5 class="m-0">Call Manage</h5>

                            </div>
                        </div>
                    </div>
                    <div id="alias_listing_table">
                        <style>
                            .switch {
                                position: relative;
                                display: inline-block;
                                width: 50px;
                                height: 24px;
                            }

                            /* Hide default HTML checkbox */
                            .switch input {
                                display: none;
                            }

                            /* The slider */
                            .slider {
                                position: absolute;
                                cursor: not-allowed;
                                top: 0;
                                left: 0;
                                right: 0;
                                bottom: 0;
                                background-color: #ccc;
                                -webkit-transition: .4s;
                                transition: .4s;
                            }

                            .slider-allowed {
                                cursor: default;
                            }

                            .slider:before {
                                position: absolute;
                                content: "";
                                height: 20px;
                                width: 20px;
                                left: 11px;
                                bottom: 2px;
                                background-color: white;
                                -webkit-transition: .4s;
                                transition: .4s;
                            }

                            input.primary:checked+.slider {
                                background-color: #2196F3;
                            }

                            input:focus+.slider {
                                box-shadow: 0 0 1px #2196F3;
                            }

                            input:checked+.slider:before {
                                -webkit-transform: translateX(17px);
                                -ms-transform: translateX(17px);
                                transform: translateX(17px);
                            }

                            input:not(:checked)+.slider:before {
                                -webkit-transform: translateX(-8px);
                                -ms-transform: translateX(-8px);
                                transform: translateX(-8px);
                            }

                            .slider.round2 {
                                border-radius: 34px;
                            }

                            .slider.round2:before {
                                border-radius: 50%;
                            }

                            #cssTable td:nth-child(3) {
                                width: 100px;
                            }

                            #cssTable td:nth-child(2) {
                                width: 50px;
                            }
                        </style>

                        <div class="table-responsive">
                            <table class="playing-user-table table table-bordered table-hover tright medium">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Player Code </th>
                                        <th> Provider </th>
                                        <th> Game Code </th>
                                        <th> Balance </th>
                                        <th> Bet Amount </th>
                                        <th> Total Debit </th>
                                        <th> Total Credit </th>
                                        <th> Rtp(Target/Real) </th>
                                        <th> Call Action </th>
                                        <th> Control Rtp </th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:center;color:black">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="call-modal" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Call Apply</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="container">
                        <div class="form-group">
                            <label>User Code</label>
                            <input type="text" id="user-code" class="form-control" disabled />
                        </div>
                        <div class="form-group">
                            <label>Provider</label>
                            <input type="text" id="provider-code" class="form-control" disabled />
                        </div>
                        <div class="form-group">
                            <label>Game Code</label>
                            <input type="text" id="game-code" class="form-control" disabled />
                        </div>
                        <div class="form-group">
                            <label>Bet</label>
                            <input type="number" id="bet-money" class="form-control" disabled />
                        </div>
                        <div class="form-group">
                            <label>Call Type</label>
                            <select class="form-control" id="call-type">
                                <option value="1">Common</option>
                                <option value="2">Buy</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Call Amount</label>
                            <input type="number" id="call-money" class="form-control" value="0" />
                        </div>
                        <div class="form-group" id="call-list-area">
                            <label>Call List</label>
                            <small id="" class="form-text text-danger process-messages"
                                style="display: none;">processing...</small>
                            <select class="form-control" id="call-list" onchange="calculateCallMoney()"
                                style="display: none"></select>
                        </div>
                        <small id="" class="form-text text-danger process-message"
                            style="display: none;">processing...</small>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="handleApplyCall()" id="btn-call-apply"
                        class="btn btn-primary save-btn">Apply</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        th {
            text-align: center;
        }

        .fade-scale {
            transform: scale(0);
            opacity: 0;
            -webkit-transition: all .25s linear;
            -o-transition: all .25s linear;
            transition: all .25s linear;
        }

        .fade-scale.in {
            opacity: 1;
            transform: scale(1);
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

        @media (min-width: 768px) {
            .modal-xl {
                width: 90%;
                max-width: 1200px;
            }
        }
    </style>
@endpush
@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        function convertNumber(number, lang = "en") {
            let resultString = "";

            if (number == 0) {
                return 0;
            }

            if (lang == "ko") {
                let inputNumber = number < 0 ? false : number;
                let unitWords = ["", "만", "억", "조", "경"];
                let splitUnit = 10000;
                let splitCount = unitWords.length;
                let resultArray = [];

                for (let i = 0; i < splitCount; i++) {
                    let unitResult = (inputNumber % Math.pow(splitUnit, i + 1)) / Math.pow(splitUnit, i);
                    unitResult = Math.floor(unitResult);
                    if (unitResult > 0) {
                        resultArray[i] = unitResult;
                    }
                }

                for (let i = 0; i < resultArray.length; i++) {
                    if (!resultArray[i]) continue;
                    resultString = String(resultArray[i]) + unitWords[i] + resultString;
                }
            } else {
                resultString = Number(number).toLocaleString();
            }

            return resultString;
        }

        function convertString(input, length) {
            if (input.length > length) {
                return input.slice(0, length) + " ...";
            } else {
                return input;
            }
        }
        $(document).ready(function() {
            let playingUserTable;
            let callResultTable;

            // 게임중인 유저 내역
            function drawPlayingUsers() {
                if (playingUserTable) {
                    playingUserTable.ajax.reload();
                } else {
                    playingUserTable = $(".playing-user-table").DataTable({
                        order: [
                            [1, "desc"]
                        ],
                        dom: 'lfrtip',
                        lengthMenu: [
                            [50, 100, 150, 200, -1],
                            [50, 100, 150, 200, "All"]
                        ],
                        pageLength: 50,
                        info: false,
                        ordering: false,
                        columns: [{
                                title: "#",
                                data: "no",
                                width: "40px",
                                orderable: false
                            },
                            {
                                title: "User Code",
                                data: "userCode",
                                orderable: false
                            },
                            {
                                title: "Provider",
                                data: "providerCode",
                                orderable: false
                            },
                            {
                                title: "Game Code",
                                data: "gameCode",
                                orderable: false
                            },
                            {
                                title: "Balance",
                                data: "balance",
                                orderable: false
                            },
                            {
                                title: "Bet",
                                data: "lastBet",
                                orderable: false
                            },
                            {
                                title: "Total Debit",
                                data: "totalDebit",
                                orderable: false
                            },
                            {
                                title: "Total Credit",
                                data: "totalCredit",
                                orderable: false
                            },
                            {
                                title: "Rtp(Target/Real)",
                                data: "rtp",
                                orderable: false
                            },
                            {
                                title: "Call Action",
                                data: "callAction",
                                orderable: false
                            },
                            {
                                title: "Control Rtp",
                                data: "rtpAction",
                                orderable: false
                            },
                        ],
                        columnDefs: [{
                            className: 'text-center',
                            targets: '_all'
                        }, ],
                        ajax: {
                            url: "{{ url('game_control_table_ajax') }}",
                            type: "GET",
                            dataSrc: function(res) {
                                if (res.data) {
                                    for (let i = 0; i < res.data.length; i++) {
                                        res.data[i].no = Number(i + 1) + Number(0);
                                        res.data[i].userCode = convertString(res.data[i].user_code, 30);
                                        res.data[i].providerCode = convertString(res.data[i]
                                            .provider_code, 30);
                                        res.data[i].gameCode = convertString(res.data[i].game_code, 30);
                                        res.data[i].balance = convertNumber(res.data[i].balance);
                                        res.data[i].lastBet = convertNumber(res.data[i].bet);
                                        res.data[i].totalDebit = convertNumber(res.data[i].total_debit);
                                        res.data[i].totalCredit = convertNumber(res.data[i]
                                            .total_credit);
                                        res.data[i].rtp = convertString(res.data[i].target_rtp + " / " +
                                            res.data[i]
                                            .real_rtp, 30);
                                        res.data[i].callAction =
                                            `<button type="button" id="btn-call" class="btn btn-xs btn-primary inline-block" onclick="handleCallModal('${res.data[i].user_code}', '${res.data[i].provider_code}', '${res.data[i].game_code}', '${res.data[i].bet}')">Call Action</button>`;
                                        res.data[i].rtpAction =
                                            `<button type="button" id="btn-call-rtp" class="btn btn-xs btn-primary inline-block" onclick="handleControlRtp('${res.data[i].user_code}', '${res.data[i].provider_code}', '${res.data[i].target_rtp}')">Control Rtp</button>`;
                                    }
                                }

                                return res.data;
                            },
                        },
                    });
                }
            }

            drawPlayingUsers();

            setInterval(() => {
                drawPlayingUsers();
            }, 8000);
        });

        function calculateCallMoney() {
            const rtp = $("#call-list").val();
            const betMoney = Number($("#bet-money").val());
            const applyCallMoney = (betMoney * Number(rtp)) / 100;

            $("#call-money").val(applyCallMoney);
        }

        function handleCallModal(userCode, providerCode, gameCode, betMoney) {
            $('.process-messages').show();
            $("#call-list").hide();
            $("#call-modal").modal("show");
            $("#user-code").val(userCode);
            $("#provider-code").val(providerCode);
            $("#game-code").val(gameCode);
            $("#bet-money").val(betMoney);

            $("#call-list-area").show();
            $("#call-generate-money-area").hide();
            $("#call-money").prop("disabled", true);
            $("#btn-call-generate").hide();
            $("#btn-call").attr("disabled", true);
            $("#btn-call-apply").attr("disabled", true);

            let data = {
                providerCode: providerCode,
                gameCode: gameCode,
            };

            $.ajax({
                type: "GET",
                url: "{{ url('game_control/call_list') }}",
                data: data,
                success: function(res) {
                    if (res.status == 1) {
                        let callListHtml = ``;

                        for (let call of res.calls) {
                            callListHtml += `<option value="${call.rtp}">Bet ${
                                    call.rtp / 100
                                } (Times)</option>`;
                        }

                        $("#call-list").html(callListHtml);
                        $('.process-messages').hide();
                        $("#call-list").show();
                        calculateCallMoney();
                    }
                    $("#btn-call").removeAttr("disabled");
                    $("#btn-call-apply").removeAttr("disabled");
                },
                error: function() {
                    $("#btn-call").removeAttr("disabled");
                    $("#btn-call-apply").removeAttr("disabled");
                },
            });
        }


        function handleApplyCall() {
            const userCode = $("#user-code").val();
            const providerCode = $("#provider-code").val();
            const gameCode = $("#game-code").val();
            const callType = $("#call-type").val();
            const betMoney = Number($("#bet-money").val());
            const rtp = Number($("#call-list").val());
            const callMoney = (rtp / 100) * betMoney.toFixed(2);
            $("#btn-call-apply").attr("disabled", true);
            $('.process-message').show();

            let data = {
                userCode: userCode,
                providerCode: providerCode,
                gameCode: gameCode,
                callRtp: rtp,
                callWin: (rtp / 100) * betMoney,
                callType: callType,
            };
            $.ajax({
                type: "GET",
                url: "{{ url('game_control/call_apply') }}",
                data: data,
                success: function(res) {
                    if (res.status == 1) {
                        toastMessage('Congrats', 'Operation is done successfully.', '#ff6849', 'success');
                        $("#call-modal").modal("hide");
                    } else {
                        $("#call-modal").modal("hide");
                        toastMessage('Error', res.msg, '#ff6849', 'error');
                    }
                    $("#btn-call-apply").removeAttr("disabled");
                    $('.process-message').hide();
                },
                error: function() {
                    $("#btn-call-apply").removeAttr("disabled");
                     $('.process-message').hide();
                },
            });
        }

        // 콜 취소
        function handleCallCancel(callId) {
            let data = {
                callId: callId,
            };

            $("#btn-call-cancel").attr("disabled", true);

            $.ajax({
                type: "POST",
                url: "/api/call/cancel",
                data: data,
                success: function(res) {
                    if (res.status == 1) {
                        toastMessage('Congrats', 'Operation is done successfully.', '#ff6849', 'success');
                    }
                    $("#btn-call-cancel").removeAttr("disabled");
                },
                error: function() {
                    $("#btn-call-cancel").removeAttr("disabled");
                },
            });
        }


        function handleControlRtp(userCode, providerCode, rtp) {
            let targetRtp = prompt("Please input rtp. (0 ~ 95).", rtp);
            if (targetRtp == null) {
                return;
            }

            if (targetRtp && targetRtp > 0) {
                let data = {
                    userCode: userCode,
                    providerCode: providerCode,
                    rtp: targetRtp,
                };

                $("#btn-call-rtp").attr("disabled", true);

                $.ajax({
                    type: "GET",
                    url: "{{ url('game_control/control_rtp') }}",
                    data: data,
                    success: function(res) {
                        if (res.status == 1) {
                            drawPlayingUsers();
                            toastMessage('Congrats', 'Operation is done successfully.', '#ff6849', 'success');
                        }
                        $("#btn-call-rtp").removeAttr("disabled");
                    },
                    error: function() {
                        $("#btn-call-rtp").removeAttr("disabled");
                    },
                });
            } else {
                toastMessage('Error', 'Please input rtp exactly.', '#ff6849', 'error');
                return;
            }
        }
    </script>
@endpush
