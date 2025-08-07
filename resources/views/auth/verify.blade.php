<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="robots" content="NOINDEX, NOFOLLOW">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>OTP Request</title>

    <style media="screen">
        .bgWhite {
            background: white;
            box-shadow: 0 3px 6px 0 #cacaca;
        }

        .centered {
            position: fixed;
            margin: 10% auto;
            /* Will not center vertically and won't work in IE6/7. */
            left: 0;
            right: 0;
        }

        .title {
            font-weight: 600;
            margin-top: 20px;
            font-size: 24px;
        }

        .customBtn {
            border-radius: 0;
            padding: 10px;
        }

        form input {
            display: inline-block;
            width: 50px;
            height: 50px;
            text-align: center;
        }

        .center-block {
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 15px;
        }

        .m_logo {
            min-width: 150px;
            max-height: 100px;
        }

        .pointer {
            cursor: pointer;
        }
    </style>

</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<body style="background-image:url(../assets/images/background/login-register.jpg);overflow: auto;">
    <div class="centered">
        <div class="row justify-content-md-center">
            <div class="col-md-4 mt-1 text-center">

                <div class="row">

                    <div class="text-center">
                        <h3 class="text-themecolor fw-light">OTP Verification</h3>

                        <h5>
                            <span class="badge badge-secondary text-dark">
                                Email

                            </span>
                        </h5>

                    </div>

                    <div class="col-sm-12 mt-1 bgWhite">
                        <br>
                        <br>

                        <div class="jumbotron jumbotron-fluid ">
                            <div class="container" style="float:left">
                                <p class="text-themecolor fw-light">Hi, {{ auth()->user()->username }}
                                    ( {{ auth()->user()->agent_id }} )</p>
                                <p class="text-themecolor fw-light">6 digits OTP is sending to your Email, please check
                                    in your Email within 5 minutes</p>
                                <p class="text-secondary">
                                    <b>{{ censor_email(auth()->user()->email) }}</b>
                                    <button class="btn btn-sm btn-secondary resend_otp" type="button" name="button"
                                        style="font-size:11px">
                                        <b>Resend OTP<b></button>
                                </p>

                                <!-- <p target="_blank" class="text-themecolor fw-light pointer text-primary reverify_button" style="text-decoration: underline">Click here if this is not your email</p> -->

                            </div>
                        </div>

                        <form action="" class="mt-5 text-center">

                            <input class="otp_1" type="text" oninput='digitValidate(this)' onkeyup='tabChange(1)'
                                maxlength="1">
                            <input class="otp_2" type="text" oninput='digitValidate(this)' onkeyup='tabChange(2)'
                                maxlength="1">
                            <input class="otp_3" type="text" oninput='digitValidate(this)' onkeyup='tabChange(3)'
                                maxlength="1">
                            <input class="otp_4" type="text" oninput='digitValidate(this)' onkeyup='tabChange(4)'
                                maxlength="1">
                            <input class="otp_5" type="text" oninput='digitValidate(this)' onkeyup='tabChange(5)'
                                maxlength="1">
                            <input class="otp_6" type="text" oninput='digitValidate(this)' onkeyup='tabChange(6)'
                                maxlength="1">
                            <button class="btn btn-sm btn-danger clear-input" type="button" name="button"
                                style="font-size:11px">
                                <b>Clear<b></button>

                            <hr class="mt-4">

                            <div class="send_text" style="font-size:13px;font-weight:bold">
                                <span>resend in
                                </span>
                                <span class="time_countdown">
                                    60
                                </span>
                                s
                                <br>
                                <p class="text-danger text-themecolor fw-light" style="font-size:16px">* Please contact
                                    administrator/customer service if not receiving the OTP</p>

                            </div>

                            <button
                                class='btn btn-sm btn-primary btn-block mt-4 mb-4 customBtn text-themecolor fw-light opt_verify_button text-center'>Verify
                                OTP</button>
                        </form>

                    </div>

                    <br>

                    <div class="container" style="float:left">
                        <h6 class="text-dark">Attempt : <span class="wrong_attempt_index text-danger"><b> {{ session()->get('attemp') }}</b></span>
                        </h6>
                        <h6 class="text-dark">Notes : Account suspended after wrong attempt 5 times</h6>
                    </div>

                    <br>

                    <br>
                    <button class="exit_otp_session">Exit OTP
                    </button>
                    <br>
                    <footer class="pt-5 text-themecolor fw-light">© {{ date('Y') }} {{ setting()->brand_name }}</footer>
                </div>
            </div>

        </div>

    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<link href="{{ asset('assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
<script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script type="text/javascript">
    $('.send_text').hide()
    $('.resend_otp').hide()
    $('.send_text').show()

    $('.clear-input').click(function() {

        $('.otp_1').val('');
        $('.otp_2').val('');
        $('.otp_3').val('');
        $('.otp_4').val('');
        $('.otp_5').val('');
        $('.otp_6').val('');

    })

    $('.exit_otp_session').click(function() {

        // exit OTP session
        Swal.fire({
            title: "<i>Exit OTP Session</i>",
            html: "<p>Are you sure to exit OTP session and return to login page ?</p>",
            confirmButtonText: "Confirm",
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then(function(conds) {
            if (conds.value) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'GET',
                    url: '/logout',
                    processData: false,
                    contentType: false,
                    success: function(data) {

                        window.location.href = "{{ url('/') }}"

                    },
                    error: function(data) {
                        console.log("Error: ", data);
                        console.log("Errors->", data.errors);
                    }
                });

            } else {}
        });
    })

    // global variable
    var g_token = `78a819bfa9f2a10fea782741d645dc8f`

    // for try again countdown
    count_down()

    let digitValidate = function(ele) {
        ele.value = ele.value.replace(/[^0-9]/g, '');
    }

    let tabChange = function(val) {

        if (val < 6) {

            let ele = document.querySelectorAll('input');
            if (ele[val - 1].value != '') {

                if (jQuery.inArray(val, ele)) {
                    ele[val].focus()
                }

            } else if (ele[val - 1].value == '') {
                ele[val - 2].focus()
            }

        }

    }

    function count_down() {

        var count_down = 60
        var retry_count_down = setInterval(function() {

            count_down -= 1;
            if (count_down <= 0) {

                clearInterval(retry_count_down);
                $('.resend_otp').show()
                $('.send_text').hide()
                count_down = 60;
                $('.time_countdown').html(count_down)

            } else {
                $('.time_countdown').html(count_down)
            }

        }, 1000);

    }

    // $('.reverify_button').click(function () {
    //
    //     // redirect_change_email
    //     Swal.fire({title: "<i>Verify Email</i>", html: "<p>Are you sure to update a new email for verification</p>", confirmButtonText: "Confirm", showCancelButton: true, cancelButtonText: "Cancel"}).then(function (conds) {
    //         if (conds.value) {
    //
    //             $.ajaxSetup({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 }
    //             });
    //             $.ajax({
    //                 type: 'GET',
    //                 url: '/redirect_change_email',
    //                 processData: false,
    //                 contentType: false,
    //                 success: function (data) {
    //
    //                     location.href = '/redirect_change_email';
    //                     return;
    //
    //                 },
    //                 error: function (data) {
    //                     console.log("Error: ", data);
    //                     console.log("Errors->", data.errors);
    //                 }
    //             });
    //
    //         } else {}
    //     });
    //
    // })

    $('.resend_otp').click(function(e) {

        e.preventDefault();
        $('.resend_otp').attr('disabled', true)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/retry_otp',
            type: "post",
            processData: false,
            contentType: false,
            success: function(data) {

                switch (data.status) {
                    case 0:
                        swal("Opps!", data.message, "error");
                        break;

                    case 1:
                        swal("Done", data.message, "success");
                        // update global token

                        // update otp prefix
                        if (data.otp_prefix != null) {
                            $('.otp_prefix_text').html(data.otp_prefix)
                        }

                        // clear input
                        $('.otp_1').val("");
                        $('.otp_2').val("");
                        $('.otp_3').val("");
                        $('.otp_4').val("");
                        $('.otp_5').val("");
                        $('.otp_6').val("");

                        $('.resend_otp').hide()
                        $('.send_text').show()
                        count_down()
                        break;

                    default:
                        break;

                }
                $('.resend_otp').attr('disabled', false)

            },
            error: function(error) {
                console.log('eror', error.responseText)
            }
        });

    })

    $('.opt_verify_button').click(function(e) {

        $('.opt_verify_button').attr('disabled', true)
        e.preventDefault();

        var otp_1 = $('.otp_1').val();
        var otp_2 = $('.otp_2').val();
        var otp_3 = $('.otp_3').val();
        var otp_4 = $('.otp_4').val();
        var otp_5 = $('.otp_5').val();
        var otp_6 = $('.otp_6').val();

        var otp = otp_1 + otp_2 + otp_3 + otp_4 + otp_5 + otp_6;

        var fd = new FormData();
        fd.append("otp", otp);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/otp_validate',
            type: "post",
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {

                switch (data.status) {
                    case 0:
                        swal("Opps!", data.message, "error");
                        break;

                    case 2:
                        swal("Opps!", data.message, "error");
                        $('.wrong_attempt_index').html(data.otp_attempt)
                        window.location.reload()
                        break;

                    case 4:
                        swal("Opps!", data.message, "error");
                        $('.wrong_attempt_index').html(data.otp_attempt)
                        break;

                    case 1:
                        swal("Done", data.message, "success");
                        location.href = '/dashboard';
                        return;
                        break;

                    default:
                        break;

                }
                $('.opt_verify_button').attr('disabled', false)

            },
            error: function(error) {
                console.log('eror', error.responseText)
            }
        });


    })
</script>
