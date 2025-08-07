<style>
    .sidebar-nav ul li a {
        color: white !important;
    }

    .mini-sidebar .scroll-sidebar {
        padding-bottom: 0px;
        position: relative;
        margin: 0 auto;
        max-width: 1200px;
        padding: 0;
    }

    @media (max-width: 992px) {
        .left-sidebar {
            overflow-y: auto;
        }
    }
</style>
<aside class="left-sidebar shadow">
    <div class="container-fluid">
        <div class="customscroll-sidebar">
            <nav class="navbar navbar-expand-lg sidebar-nav">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 p-0" id="navbarSupportedContent">
                    <ul id="sidebarnav">
                        <li class="active">
                            <a class="waves-effect waves-light" href="{{ route('index') }}" aria-expanded="false">
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        @if (auth()->user()->hasPermission('sub_sidebar.Member Mgmt.*'))
                            <li class="dropdown">
                                <a class="has-arrow waves-effect waves-light dropdown-toggle" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    1.
                                    <span class="hide-menu">Member Management</span>
                                </a>
                                <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
                                    @if (auth()->user()->hasPermission('sub_sidebar.Member Mgmt.New Member'))
                                        <li class="dropdown-item waves-effect waves-light"><a class=""
                                                href="/new_member">1.1
                                                New Member </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasPermission('sub_sidebar.Member Mgmt.Account List'))
                                        <li class="dropdown-item waves-effect waves-light"><a class=""
                                                href="/account_listing">1.2 Member List </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('sub_sidebar.Report.*'))
                            <li class="dropdown">
                                <a class="has-arrow waves-effect waves-light dropdown-toggle" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    2.
                                    <span class="hide-menu">Report</span>
                                </a>
                                <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
                                    @if (auth()->user()->hasPermission('sub_sidebar.Report.Running Report'))
                                        <li class="dropdown-item waves-effect waves-light"><a class=""
                                                href="/summary_report">2.1 Summary </a></li>
                                    @endif

                                    @if (auth()->user()->hasPermission('sub_sidebar.Report.Daily Report'))
                                        <li class="dropdown-item waves-effect waves-light"><a class=""
                                                href="/member_summary">2.2 Member Summary </a></li>
                                    @endif

                                    @if (auth()->user()->hasPermission('sub_sidebar.Report.Win/Lose'))
                                        <li class="dropdown-item waves-effect waves-light"><a class=""
                                                href="/game_summary">2.4
                                                Win/Lose Report </a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('sub_sidebar.Tools.*'))
                            <li class="dropdown">
                                <a class="has-arrow waves-effect waves-light dropdown-toggle" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    3.
                                    <span class="hide-menu">Tools</span>
                                </a>
                                <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
                                    @if (auth()->user()->hasPermission('sub_sidebar.Tools.Promotion Settings'))
                                        <li class="dropdown-item waves-effect waves-light"><a class=""
                                                href="/agent_promo_settings">3.1 Promotion & Bonus Settings </a>
                                        </li>
                                    @endif

                                    @if (auth()->user()->hasPermission('sub_sidebar.Tools.Admin Accounts'))
                                        <li class="dropdown-item waves-effect waves-light"><a class=""
                                                href="/alias_account">3.3
                                                Admin Accounts </a>
                                        </li>
                                    @endif

                                    <li class="dropdown-item waves-effect waves-light"><a class=""
                                            href="/game_control">3.4
                                            Game Controll </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <!--  -->
                        @if (auth()->user()->hasPermission('sub_sidebar.Transactions.*'))
                            <li class="dropdown">
                                <a class="has-arrow waves-effect waves-light dropdown-toggle" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    4.
                                    <span class="hide-menu">Transactions</span>
                                </a>
                                <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">


                                    @if (auth()->user()->hasPermission('sub_sidebar.Transactions.Transaction'))
                                        <li class="dropdown-item waves-effect waves-light">
                                            <a class="" href="/transactions/transaction">4.1 Transaction
                                            </a>
                                        </li>
                                    @endif

                                    @if (auth()->user()->hasPermission('sub_sidebar.Transactions.Transaction Old Record'))
                                        <li class="dropdown-item waves-effect waves-light">
                                            <a class="" href="/transactions/transaction_record">4.2
                                                Transaction Record
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if (auth()->user()->hasPermission('sub_sidebar.Banking.*'))
                            <li class="dropdown">
                                <a class="has-arrow waves-effect waves-light dropdown-toggle" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    5.
                                    <span class="hide-menu">Banking</span>
                                </a>
                                @if (auth()->user()->hasPermission('sub_sidebar.Banking.Fund Method Listing'))
                                    <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">

                                        <li class="dropdown-item waves-effect waves-light"><a class=""
                                                href="/agent_banks">5.1
                                                Fund Method Listing </a>
                                        </li>
                                    </ul>
                                @endif
                            </li>
                        @endif
                        <!--  -->
                        @if (auth()->user()->hasPermission('sub_sidebar.Website.*'))
                            <li class="dropdown">
                                <a class="has-arrow waves-effect waves-light dropdown-toggle" href="#"
                                    role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    6.
                                    <span class="hide-menu">Website</span>
                                </a>
                                <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
                                    @if (auth()->user()->hasPermission('sub_sidebar.Website.Web Settings'))
                                        <li class="dropdown-item waves-effect waves-light"><a class=""
                                                href="/Website/WebSetting">6.1 Web Settings </a>
                                        </li>
                                    @endif

                                    @if (auth()->user()->hasPermission('sub_sidebar.Website.Domain Settings'))
                                        <li class="dropdown-item waves-effect waves-light"><a class=""
                                                href="/Website/DomainSettings">6.2 Domain Settings </a>
                                        </li>
                                    @endif

                                    @if (auth()->user()->hasPermission('sub_sidebar.Website.Sliding Banner Settings'))
                                        <li class="dropdown-item waves-effect waves-light"><a class=""
                                                href="/Website/SlidingBanner">6.3 Sliding Banner Settings </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        <!--  -->
                        <li class="dropdown">
                            <a class="has-arrow waves-effect waves-light dropdown-toggle" href="#"
                                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                7.
                                <span class="hide-menu">Tutorials</span>
                            </a>
                            <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">


                                <li class="dropdown-item waves-effect waves-light"><a class=""
                                        href="/img_upload_guide">7.1 What to do before upload your banner
                                        images </a>
                                </li>


                                <li class="dropdown-item waves-effect waves-light"><a class=""
                                        href="/domain_activattion_guide">7.2 Domain Activation Guide </a>
                                </li>

                            </ul>
                        </li>
                        @if (auth()->user()->roles == 0)
                            <li>
                                <a class="waves-effect waves-light" href="/brand_management" aria-expanded="false">
                                    <span class="hide-menu">8. Brand Management</span>
                                </a>
                            </li>
                            <li>
                                <a class="waves-effect waves-light" href="/account_management" aria-expanded="false">
                                    <span class="hide-menu">9. Account Management</span>
                                </a>
                            </li>
                            <li>
                                <a class="waves-effect waves-light" href="/game_providers" aria-expanded="false">
                                    <span class="hide-menu">10. Games Providers</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</aside>
