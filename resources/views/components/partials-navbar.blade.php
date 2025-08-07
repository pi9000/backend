<style media="screen">
    .notification-panel {
        opacity: 0.94;
        width: 280px !important;
        transition: all 0.5s ease;
        /* max-height: 155px;
        overflow: hidden; */
    }

    /* .notification-panel::after{
    content: "";
    pointer-events: none;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-top: 8px solid #6c757d8a;
    bottom: 0;
    animation: bounce 1s infinite;
    }
    @keyframes  bounce {
    0% {
    bottom: 0;
    }
    50% {
    bottom: 5px;
    }
    100% {
    bottom: 0;
    }
    } */
    .notification-panel:hover {
        opacity: 1;
        border-style: dotted;
        max-height: 300px;

    }

    .notification-panel li a {
        font-size: 14px;
        padding: 2px !important;
    }
</style>
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light d-md-flex justify-content-between">
        <div class="">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <div class="px-2 text-left">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ env('AWS_URL') }}{{ applogo()->logo }}" alt="homepage" class="img-fluid"
                        style="min-width:100px; max-height:45px;" />
                    <!-- <img src="{{ env('AWS_URL') }}{{ applogo()->logo }}"
                alt="homepage" class="img-fluid" style="min-width:100px; max-height:60px;" /> -->
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
        </div>
        <div class="">
            <div class="navbar-collapse">
                <div class="d-md-flex align-items-center ">
                    <div class="position-relative text-right">
                        <div>
                            <a href="javascript:void(0)" onclick="return livechatPopup()" data-toggle="tooltip"
                                data-placement="bottom" title="" style="height: 50px" data-original-title="{{ __('nav.livechat') }}">
                                <span class="text-warning d-none d-md-inline">{{ __('nav.livechat_problem') }}</span>
                                <span class="text-warning"><span class="d-md-none">{{ __('nav.livechat') }}</span> <i
                                        class="fas fa-comments"></i></span>
                            </a>
                        </div>
                        <div>
                            <small id="time" class="text-white">

                            </small>
                        </div>
                    </div>
                    <div class="">
                        <div class="navbar-nav mr-auto text-white justify-end">
                            <div class="agentinfo-wraper">
                                <div class="welcomemsg-wraper">
                                    <span>{{ __('nav.welcomemsg') }}, </span>
                                    <span class="agent-name">
                                        {{ strtoupper(auth()->user()->username) }}
                                    </span>
                                    <img src="https://files.sitestatic.net/assets/imgs/verify_sm.png" alt=""
                                        class="mb-1">
                                </div>

                                <div class="creditinfo-wraper">
                                    <span class="credit-label">{{ __('nav.creditlabel') }}</span> <span
                                        class=" d-md-none d-lg-none d-xl-none"><img
                                            src="{{ asset('/assets/images/icon/card.png') }}" alt="user"
                                            class="" /></span> :
                                    <span class="__api_credit_balance creditamount"> Loading </span>

                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <div class="">
                        <ul class="navbar-nav my-lg-0 align-center justify-end">

                            <li id="__notification" class="nav-item dropdown position-static">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="javascript:void(0)"
                                    onclick="$(`.notify`).html('');" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="mdi mdi-message"></i>
                                    <div class="notify">
                                        <!-- <span class="heartbit"></span> <span class="point"></span>  -->
                                    </div>
                                </a>
                                <div class="notification-panel dropdown-menu dropdown-menu-right mailbox shadow">

                                    <ul>
                                        <li>
                                            <div class="py-1 drop-title" style="font-size:13px">
                                                {{ __('nav.notification') }}
                                                <!-- close button -->
                                                <button type="button" class="close" aria-label="Close"
                                                    id="__notification_close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <!-- close button End -->
                                            </div>
                                        </li>
                                        <li>
                                            <a class="nav-link py-1 text-center"
                                                href="/transactions/transaction">
                                                <strong>@lang('nav.__instant_depo')</strong>
                                                <span class="badge badge-pill badge-danger font-weight-bold"
                                                    id="__instant_depo"></span> </a>
                                        </li>
                                        <li>
                                            <a class="nav-link py-1 text-center"
                                                href="/transactions/transaction">
                                                <strong>@lang('nav.__instant_withd')</strong>
                                                <span class="badge badge-pill badge-danger font-weight-bold"
                                                    id="__instant_withd"></span> </a>
                                        </li>

                                        <li>
                                            <a class="nav-link py-1 text-center" href="/action_logs">
                                                <strong>@lang('nav.__action')</strong> <span
                                                    class="badge badge-pill badge-danger font-weight-bold"
                                                    id="__action"></span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('/assets/images/icon/staff.png') }}" alt="user"
                                        class="profile-pic" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow">
                                    <ul class="dropdown-user">
                                        <li>
                                            <div class="dw-user-box">
                                                <div class="u-text">
                                                    <h4>
                                                        {{ auth()->user()->agent_id }} - {{ auth()->user()->fullname }}
                                                        <!--   -->
                                                    </h4>
                                                    <p class="text-muted">
                                                        {{ censor_email(auth()->user()->email) }}
                                                        <img src="https://files.sitestatic.net/assets/imgs/verify_sm.png"
                                                            alt="">
                                                    </p>
                                                    <a href="/myprofile" class="btn btn-rounded btn-danger btn-xs">@lang('nav.viewprofile')</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="#"><i class="ti-user"></i>
                                                {{ auth()->user()->fullname }}</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="ti-id-badge"></i> @lang('nav.agent')</a>
                                        </li>

                                        <li>
                                            <a href="/agent_credit_logs"><i class="ti-wallet"></i> <span
                                                    class="__api_credit_balance"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="ti-money"></i>{{ auth()->user()->currency }}</a>
                                        </li>
                                        <li role="separator" class="divider"></li>
                                        <li>
                                            <a href="/logout"><i class="fa fa-power-off"></i>@lang('nav.logout')</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item mobilemenu-trigger">
                                <!-- Collapse button -->
                                <button class="navbar-toggler first-button" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent20" aria-controls="navbarSupportedContent20"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <div class="animated-icon1"><span></span><span></span><span></span></div>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<script>
    setInterval(function() {

        document.getElementById('time').innerHTML = "(@lang('nav.timezone') GMT <span>+8</span>) <span>" + new Date()
            .toLocaleTimeString([], {
                timeZone: 'Asia/Hong_kong',
                hour: "2-digit",
                minute: "2-digit"
            }) + "</span>";
    }, 100);
</script>
