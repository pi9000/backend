<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ setting()->title }}</title>
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pages/login-register-lock.css?v=0.0.4') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css?v=0.3') }}" rel="stylesheet">
    <link href="{{ asset('css/colors/default-dark.css') }}" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="https://marcelodolza.github.io/iziToast/css/iziToast.css?v=150">
    <link rel="stylesheet" media="screen" href="{{ asset('js/particles/demo/css/style.css') }}">

    <style>
        .page-titles {
            position: absolute;

        }

        .centered {

            position: fixed;

            margin: 10% auto;
            /* Will not center vertically and won't work in IE6/7. */
            left: 0;
            right: 0;


        }

        .center-block {
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 15px;
        }

        .login {
            background-color: #6272a4 !important
        }

        #particles-js {
            background-color: #282a36 !important;
        }

        .m_logo {
            min-width: 120px;
            max-height: 80px;
        }

        .cloud-gaming {
            margin-top: 3%;
        }

        .cloud-gaming .m_logo {
            max-height: 200px;
            padding-bottom: 40px;
        }
    </style>
</head>

<body>


    <div id="particles-js" class="form-signin">
        <div class="row page-titles">
            <section class="centered {{ setting()->brand_name }}">

                <img src="{{ env('AWS_URL') }}{{ setting()->logo }}" alt="homepage"
                    class="img-fluid center-block animated fadeInDown m_logo" />

                <div class="login-box card animated fadeInUp border">
                    <div class="card-body">

                        <form class="form-horizontal form-material" id="loginform" action="/login">
                            @csrf
                            <p class="text-center text-secondary">
                                <b>WHITELABEL</b>
                            </p>
                            <div class="form-group m-t-40">
                                <input class="form-control" type="text" required="" name="u" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" required="" name="p" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" required="" name="v" placeholder="Validation"
                                    maxlength="6" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <div class="col align-self-center" style="text-align:center">
                                    <img src="{{ route('captcha') }}?" class="captcha"
                                        style="border:1px solid #CCC;cursor:pointer" data-toggle="tooltip"
                                        data-placement="bottom">
                                </div>
                            </div>

                            <div class="form-group text-center m-t-20">
                                <button class="btn btn-sm btn-block text-uppercase login text-light" type="submit">Log
                                    In</button>
                            </div>
                            <div class="form-group text-center m-t-20 text-danger">
                                Attempt : <span class="user_attempt_count">{{ session()->get('attemp') }}</span>
                            </div>

                        </form>


                        <form class="form-horizontal" id="second-password" action="/second-password">
                            @csrf
                            <div class="form-group ">
                                <h3>Secure Pin Code</h3>
                                <p class="text-muted">Please Entry your Secure Pin Code</p>
                            </div>
                            <div class="form-group ">
                                <div class="row sec_pass">

                                </div>
                            </div>
                            <div class="form-group button-group">
                                <div class="row">
                                    <div class="col-4">
                                        <input class="btn btn-primary btn-rounded btn-block btn-xl pinkey" type="button"
                                            value="1" onclick="numberPad(this.value)">
                                    </div>
                                    <div class="col-4">
                                        <input class="btn btn-primary btn-rounded btn-block btn-xl pinkey" type="button"
                                            value="2" onclick="numberPad(this.value)">
                                    </div>
                                    <div class="col-4">
                                        <input class="btn btn-primary btn-rounded btn-block btn-xl pinkey" type="button"
                                            value="3" onclick="numberPad(this.value)">
                                    </div>
                                    <div class="col-4">
                                        <input class="btn btn-primary btn-rounded btn-block btn-xl pinkey" type="button"
                                            value="4" onclick="numberPad(this.value)">
                                    </div>
                                    <div class="col-4">
                                        <input class="btn btn-primary btn-rounded btn-block btn-xl pinkey" type="button"
                                            value="5" onclick="numberPad(this.value)">
                                    </div>
                                    <div class="col-4">
                                        <input class="btn btn-primary btn-rounded btn-block btn-xl pinkey" type="button"
                                            value="6" onclick="numberPad(this.value)">
                                    </div>
                                    <div class="col-4">
                                        <input class="btn btn-primary btn-rounded btn-block btn-xl pinkey" type="button"
                                            value="7" onclick="numberPad(this.value)">
                                    </div>
                                    <div class="col-4">
                                        <input class="btn btn-primary btn-rounded btn-block btn-xl pinkey" type="button"
                                            value="8" onclick="numberPad(this.value)">
                                    </div>
                                    <div class="col-4">
                                        <input class="btn btn-primary btn-rounded btn-block btn-xl pinkey" type="button"
                                            value="9" onclick="numberPad(this.value)">
                                    </div>
                                    <div class="col-4">
                                        <input id='' class="btn btn-secondary btn-block text-uppercase btn-rounded"
                                            type="button" value="-" onclick="numberPad(this.value)" disabled>
                                    </div>
                                    <div class="col-4">
                                        <input class="btn btn-primary btn-block text-uppercase btn-rounded pinkey"
                                            type="button" value="0" onclick="numberPad(this.value)">
                                    </div>
                                    <div class="col-4">

                                        <input id='back_bt' class="btn btn-warning btn-block text-uppercase btn-rounded"
                                            type="button" value="RESET" onclick="numberPad(this.value)">
                                    </div>
                                </div>
                            </div>

                            <hr class="pb-3">

                            <div class="fa_section">
                                <div class="form-group">
                                    <h3>Two-Factor Authentication (2FA)</h3>
                                    <p class="text-muted">Please enter your 2FA access code</p>
                                    <small class="text-muted">* Kindly check on your authenticator application</small>
                                </div>
                                <div class="form-group ">
                                    <input type="text" id="fa_token" placeholder="" class="form-control"
                                        name="fa_token">
                                </div>

                                <hr class="pb-2">
                            </div>

                            <div class="col-12">
                                <button
                                    class="btn btn-success btn-block text-uppercase btn-rounded waves-effect waves-light pincodesubmit"
                                    type="submit">Submit</button>
                            </div>


                        </form>
                    </div>
                </div>

                <div class="text-center animated fadeInUpBig">
                    <code class="mt-5 mb-3 text-muted" style="font-size:15px">©
                        {{ date('Y') }} {{ setting()->brand_name }}</code>
                </div>

            </section>
            <!-- end login panel -->

        </div>
    </div>
    </div>
    <!-- end section -->

    <!-- scripts -->
    <script src="{{ asset('js/particles/particles.js') }}"></script>
    <script src="{{ asset('js/particles/demo/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
    <script src="{{ asset('assets/plugins/toast-master/js/jquery.toast.js') }}"></script>
    <script src="https://marcelodolza.github.io/iziToast/js/vendor/iziToast.js?v=150" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {





            $(".pinkey").click(function() {
                var value = $(this).val();

                // var value2 = $(this).find(".text2").text();
                if (value == 'Back') {
                    return;
                }
                $(".pincode").each(function() {
                    var a = $(this).val();
                    if (!a) {
                        $(this).val(value);
                        if ($(this).val().length == $(this).attr('maxlength')) {
                            if ($(this).nextAll('input:enabled:not([readonly])')[0]) {
                                $(this).nextAll('input:enabled:not([readonly])')[0].focus();
                            }
                        }
                        return false;
                    }
                });
            });

            $("#back_bt").click(function(e) {

                e.preventDefault();
                $($('.pincode:not([readonly])').get().reverse()).each(function() {
                    if ($(this).val()) {
                        $(this).val('');
                        $(this).focus();
                        return false;
                    }
                });
            });

        });

        var error = `Server is under maintenance , please login after 5 min .`;
        $(function() {
            $('#second-password').hide();
            $(".preloader").fadeOut();
        });
        // ============================================================== Login and Recover Password ==============================================================
        $('#loginform').on("submit", function(e) {
            e.preventDefault();
            $('.login').prop('disabled', 'disabled');
            //Warning Message
            let action = $(this).attr('action')
            let data = $(this).serialize();
            $.post(action, data, function(d, s, x) {
                if (d.s == 'r') {
                    location.href = '/register_setup';
                    return;
                } else if (d.hasOwnProperty('m') && d.m == 'Invalid  username or password.') {

                    if (d.hasOwnProperty('attempt')) {
                        $('.user_attempt_count').html(d.attempt)
                    }

                    $('.login').prop('disabled', false);
                    toastMessage('Invalid', d.m, '#ff6849', 'warning');
                    return;
                } else if (d.s == 'f') {
                    toastMessage('Invalid', d.m, '#ff6849', 'warning');
                    $('.login').removeAttr('disabled');
                    return false;
                } else if (d.hasOwnProperty('m') && d.m == 'Account Locked') {

                    if (d.hasOwnProperty('attempt')) {
                        $('.user_attempt_count').html(d.attempt)
                    }

                    $('.login').prop('disabled', false);
                    toastMessage('Invalid', d.m, '#ff6849', 'error');
                    return;
                }

                // if(d.agent!="COXGMAC"){
                    window.history.pushState('Secure Pin Code', 'Secure Pin Code', '/secure-pin-code');
                    generateRandomKey();
                    $("#loginform").slideUp();
                    //$("#second-password").fadeIn();
                    $("#second-password").css("display", "block");

                    $(".sec_pass").html(d.sp);

                    if(d.fa_enable == true){
                        $('.fa_section').show()
                    }else{
                        $('.fa_section').hide()
                    }

                });
        });

        $('#second-password').submit(function(e) {
            e.preventDefault();
            $('.pincodesubmit').prop('disabled', 'disabled');
            let action = $(this).attr('action')
            let data = $(this).serialize();
            let val = $('#secure_pin').val();

            data = `${data}&p=${val}`;
            $.post(action, data, function(d, s, x) {
                if (d.s === 'f') {
                    toastMessage('Invalid', d.m, '#ff6849', 'warning');
                    $('#secure_pin').val('');
                    $('.pincodesubmit').removeAttr('disabled');
                    return false;
                } else if (d.s === 'request_otp') {
                    location.href = '/request_otp';
                    return;
                } else if (d.s === 'l') {
                    toastMessage('Suspended', d.m, '#ff6849', 'error');
                    $('.pincodesubmit').removeAttr('disabled');
                    return false;
                } else if (x.status !== 200) {
                    sweetAlert(error);
                    $('.pincodesubmit').removeAttr('disabled');
                    return false;
                }
                location.href = '/';
            });

        });

        window.onpopstate = function(e) {
            e.preventDefault();
            $("#second-password").fadeOut();
            $("#loginform").slideDown();
        }

        numberPad = (val) => {
            if (val == 'RESET') {
                return $('#secure_pin').val('');
            }
            let current_padNumber = $('#secure_pin').val();
            if (current_padNumber.length < 6) {
                $('#secure_pin').val(current_padNumber + val);
            }
            return;
        }

        generateRandomKey = () => {
            let array = [
                0,
                1,
                2,
                3,
                4,
                5,
                6,
                7,
                8,
                9
            ];
            shuffle(array);
            let pin = $('.pinkey');
            pin.each(function(i) {
                let number = array[i];
                $(this).val(number);
            });
        }

        sweetAlert = (msg, chance) => {
            swal({
                title: "Warning",
                text: msg,
                type: "error",
                showConfirmButton: false
            });
        }

        shuffle = (array) => {
            let counter = array.length;
            while (counter > 0) {
                let index = Math.floor(Math.random() * counter);
                counter--;
                let temp = array[counter];
                array[counter] = array[index];
                array[index] = temp;
            }
            return array;
        }

        toastMessage = (title, text, color, icon) => {
            $.toast({
                heading: title,
                text: text,
                position: 'top-center',
                loaderBg: color,
                icon: icon,
                hideAfter: 3500,
                stack: 6
            });
        }
    </script>

</body>

</html>
