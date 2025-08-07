@extends('layouts.main')
@section('panel')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h5 class="text-themecolor">{{ $pageTitle }}</h5>
        <input type="hidden" value="">
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item active">{{ $pageTitle }} {{ request()->getClientIp() }}</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered table-hover medium">
                            <thead>
                                <tr>
                                    <th colspan="2"> My Personal Detail </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:180px"> Agent Level </td>
                                    <td class="text-right">{{ auth()->user()->roles == 0 ? 'Master' : 'Agent' }} </td>
                                </tr>
                                <tr>
                                    <td> Agent ID </td>
                                    <td class="text-right"> {{ auth()->user()->agent_code }} </td>
                                </tr>
                                <tr>
                                    <td> Username </td>
                                    <td class="text-right"> {{ auth()->user()->username }} </td>
                                </tr>
                                <tr>
                                    <td> Fullname </td>
                                    <td class="text-right"> {{ auth()->user()->fullname }} </td>
                                </tr>

                                <tr>
                                    <td> Currency </td>
                                    <td class="text-right"> {{ auth()->user()->currency }}</td>
                                </tr>
                                <tr>
                                    <td> Credit Balance </td>
                                    <td class="text-right">
                                        {{ currencyFormat(auth()->user()->balance, 0) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td> Total Member Balance </td>
                                    <td class="text-right">
                                        {{ currencyFormat($total_balance_member, 2) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered table-hover medium">
                            <thead>
                                <tr>
                                    <th colspan="2"> Information </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td title="86">Total Member</td>
                                    <td id="me_count" class="text-right"></td>
                                </tr>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                            ajaxGetTotal('_get_me_count', 'me_count');
                                    });
                                </script>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <style media="screen">
                            .sub-heading {
                                font-size: 12px;
                                color: black;
                                font-family: "Montserrat" !important;
                                font-weight: 500 !important;
                            }

                            .main-heading {
                                font-weight: bold !important;
                                font-size: 14px;
                            }
                        </style>
                        <h3 class="main-heading golden-yellow">General Regulations<span class="text-secondary">{{
                                env('APP_TITLE') }}</span>Platform</h3>
                        <p>
                        <ol class="sub-heading" type="1">
                            <li>
                                <p class="sub-heading">Regulations</p>
                                <p>
                                    For Whitelabel Clients <span class="text-secondary">{{ setting()->brand_name
                                        }}</span><br>
                                    The platform is strictly prohibited from engaging in phishing activities targeting
                                    other users of
                                    <span class="text-secondary">{{ setting()->brand_name }}</span> or other platforms
                                    such as:
                                </p>
                                <ol type="a" class="sub-heading">
                                    <li>Creating content or articles containing the name or branding keywords of another
                                        person's website</li>
                                    <li>Writing reviews about another person's website without the owner's permission
                                    </li>
                                    <li>Creating banners or ads for another person's website without the owner's
                                        permission</li>
                                    <li>Any actions that indicate an attempt to harm others by using another person's
                                        name or brand</li>
                                </ol>
                            </li>
                            <li>
                                <p class="sub-heading">Sanctions</p>
                                <p>
                                    If any of the above violations are found, the service provider will apply the
                                    following sanctions:
                                </p>
                                <ol type="a" class="sub-heading">
                                    <li>First offense: A first warning will be issued</li>
                                    <li>Second offense: A fine of IDR 10,000,000 (Ten Million Rupiah) will be imposed
                                    </li>
                                    <li>Third offense: A fine of IDR 50,000,000 (Fifty Million Rupiah) will be imposed
                                        and/or server/service termination</li>
                                </ol>
                            </li>
                            <li>
                                <p class="sub-heading">Advisory</p>
                                <p>
                                    From the Service Provider <span class="text-secondary">{{ setting()->brand_name
                                        }}</span>,<br>
                                    We urge everyone to maintain, comply with, and respect the intellectual property
                                    rights of others
                                    in order to ensure the smooth operation of each business.
                                </p>
                            </li>
                            <p class="sub-heading">
                                Regards,<br>
                                <span class="text-secondary"><b>{{ setting()->brand_name }}</b></span>
                            </p>
                        </ol>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
