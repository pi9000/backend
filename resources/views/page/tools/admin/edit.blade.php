@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Edit Admin {{ $admin->username }}</h5>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/alias_account">Alias Accounts</a> </li>
                <li class="breadcrumb-item active"> Edit Admin </li>
            </ol>
        </div>
    </div>
    <div class="row" id="validation">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <form id="new_admin" action="/edit_admin_post/{{ $admin->id }}" method="post">
                        <fieldset>
                            @csrf
                            <input type="hidden" value="{{ auth()->user()->agent_id }}" name="mu">
                            <table class="table table-bordered table-hover tright medium">
                                <thead>
                                    <tr>
                                        <th colspan="2">New Admin Information</th>
                                        <th colspan="2"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:150px">Username : <span class="text-danger">*</span></td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input type="text" class="" id="user_name" name="user_name"
                                                    value="{{ $admin->username }}" disabled>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>
                                            <span class="otp_email">Email</span><span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <span class="otp_email_input">
                                                <input type="text" class="" id="email" name="email"
                                                    value="{{ $admin->email }}" required>
                                            </span>
                                        </td>
                                        <td style="width:150px"> Full Name : <span class="text-danger">*</span> </td>
                                        <td>
                                            <input type="text" class="" id="first_name" name="first_name"
                                                value="{{ $admin->fullname }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Password : </td>
                                        <td>
                                            <button type="button"
                                                onclick="resetPass(`/reset_password/{{ $admin->id }}`)"
                                                class="btn btn-xs btn-dark btn-rounded reset-btn" title="Reset Password">Reset Password</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Security PIN : </td>
                                        <td>
                                            <button type="button"
                                                onclick="resetPass(`/reset_pin/{{ $admin->id }}`)"
                                                class="btn btn-xs btn-dark btn-rounded reset-btn" title="Reset PIN">Reset PIN</button>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:150px"> OTP Toggle :
                                            <i class="pl-1 fas fa-question-circle fa-lg pointer text-secondary"
                                                data-toggle="tooltip" data-placement="top"
                                                title="Toggle ON for alias agent to provide OTP when login"></i>
                                        </td>
                                        <td>
                                            <label class="switch">
                                                <input type="checkbox" class="primary alias_otp_toggle"
                                                    name="alias_otp_toggle" checked disabled readonly>
                                                <span class="slider round2"></span>
                                            </label>
                                        </td>

                                    </tr>

                                    </tr>

                                </tbody>
                            </table>
                            <table class="table table-bordered table-hover tright medium">
                                <thead>
                                    <tr>
                                        <th style="float:left">Edit Permission</th>
                                        <th colspan="7"><input type="checkbox" class="check_all_edit_permission" checked>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">

                                        <td style="width:150px"> Create Account : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_new"
                                                {{ $admin->hasPermission('chkbox_account_new') ? 'checked' : '' }}>
                                        </td>
                                        <td style="width:150px"> Edit Account : <span class="text-danger">*</span> </td>
                                        <td>
                                            Status:
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_status_edit"
                                                checked>
                                            <br>
                                            Suspend:
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_suspend_edit"
                                                {{ $admin->hasPermission('chkbox_account_suspend_edit') ? 'checked' : '' }}>
                                            <br>
                                            Name:
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_name_edit"
                                                {{ $admin->hasPermission('chkbox_account_name_edit') ? 'checked' : '' }}>
                                            <br>
                                            Email:
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_email_edit"
                                                {{ $admin->hasPermission('chkbox_account_email_edit') ? 'checked' : '' }}>
                                            <br>
                                            Mailing Subscription:
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_mail_sub_edit"
                                                {{ $admin->hasPermission('chkbox_account_mail_sub_edit') ? 'checked' : '' }}>
                                            <br>
                                            Phone:
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_phone_edit"
                                                {{ $admin->hasPermission('chkbox_account_phone_edit') ? 'checked' : '' }}>
                                            <br>
                                            Identity:
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_identity_edit"
                                                {{ $admin->hasPermission('chkbox_account_identity_edit') ? 'checked' : '' }}>

                                        </td>
                                        <td style="width:150px"> Edit Account Banking : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_acc_banking"
                                                {{ $admin->hasPermission('chkbox_acc_banking') ? 'checked' : '' }}>
                                        </td>

                                    </tr>
                                    <tr class="">

                                        <td style="width:150px"> Member Details: <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_detail"
                                                {{ $admin->hasPermission('chkbox_account_detail') ? 'checked' : '' }}>
                                        </td>

                                        <td style="width:150px"> Member Phone : <span class="text-danger">*</span> </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_mobile"
                                                {{ $admin->hasPermission('chkbox_account_mobile') ? 'checked' : '' }}>
                                        </td>
                                        <td style="width:150px"> Member Email: <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_email"
                                                {{ $admin->hasPermission('chkbox_account_email') ? 'checked' : '' }}>
                                        </td>

                                    </tr>
                                    <tr class="">
                                        <td style="width:150px"> Comm Setting : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_commission"
                                                {{ $admin->hasPermission('chkbox_commission') ? 'checked' : '' }}>
                                        </td>
                                        <td style="width:150px"> Auto Toggle Bank : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_autobankgrouptoggle"
                                                {{ $admin->hasPermission('chkbox_autobankgrouptoggle') ? 'checked' : '' }}>
                                        </td>
                                        <td style="width:150px">
                                        </td>
                                        <td>

                                        </td>

                                    </tr>

                                    <tr class="">

                                        <td style="width:150px"> Approve/Reject Transaction : <span
                                                class="text-danger">*</span></td>
                                        <td>
                                            Approve Transaction:
                                            <input type="checkbox" class="edit_permission" name="chkbox_apptrans"
                                                {{ $admin->hasPermission('chkbox_apptrans') ? 'checked' : '' }}>
                                            <br>
                                            Reject Transaction:
                                            <input type="checkbox" class="edit_permission" name="chkbox_rejecttrans"
                                                {{ $admin->hasPermission('chkbox_rejecttrans') ? 'checked' : '' }}>
                                            <br>
                                        </td>
                                        <td style="width:150px"> Create / Edit Agent Banking : <span
                                                class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_banking"
                                                {{ $admin->hasPermission('chkbox_banking') ? 'checked' : '' }}>
                                        </td>
                                        <td style="width:150px"> View Bank Listing : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_bank_listing"
                                                {{ $admin->hasPermission('chkbox_bank_listing') ? 'checked' : '' }}>
                                        </td>


                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Bet Settings : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_betting"
                                                {{ $admin->hasPermission('chkbox_betting') ? 'checked' : '' }}>
                                        </td>
                                        <td style="width:150px">Member Level : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_memberlevel"
                                                {{ $admin->hasPermission('chkbox_account_memberlevel') ? 'checked' : '' }}>
                                        </td>
                                        <td style="width:150px"> Edit Password : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_password_edit"
                                                {{ $admin->hasPermission('chkbox_password_edit') ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Create Affiliate : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_af_create"
                                                {{ $admin->hasPermission('chkbox_af_create') ? 'checked' : '' }}>
                                        </td>
                                        <td style="width:150px"> Edit Affiliate : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_af_edit"
                                                {{ $admin->hasPermission('chkbox_af_edit') ? 'checked' : '' }}>
                                        </td>
                                        <td style="width:150px"> Edit Own Username : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_username_edit"
                                                {{ $admin->hasPermission('chkbox_username_edit') ? 'checked' : '' }}>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Bonus Release : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_bonus_release"
                                                {{ $admin->hasPermission('chkbox_bonus_release') ? 'checked' : '' }}>
                                        </td>

                                        <td style="width:150px"> Fund method listing page checkbox access : <span
                                                class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="pulsa_checkbox"
                                                {{ $admin->hasPermission('pulsa_checkbox') ? 'checked' : '' }}>
                                            Pulsa checkbox
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="ewallet_checkbox"
                                                {{ $admin->hasPermission('ewallet_checkbox') ? 'checked' : '' }}>
                                            E-wallet checkbox
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="crypto_checkbox"
                                                {{ $admin->hasPermission('crypto_checkbox') ? 'checked' : '' }}>
                                            Crypto checkbox
                                        </td>

                                        <td style="width:150px"> Referral KYC : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="view_permission_referral_kyc"
                                                name="referral_kyc_view"
                                                {{ $admin->hasPermission('referral_kyc_view') ? 'checked' : '' }}>
                                            <strong>View </strong>
                                            <br>
                                            <input type="checkbox" class="edit_permission_referral_kyc"
                                                name="referral_kyc_edit"
                                                {{ $admin->hasPermission('referral_kyc_edit') ? 'checked' : '' }}>
                                            <strong>Edit </strong>
                                            <br>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Domain Settings permission : <span
                                                class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="view_domain_checkbox"
                                                {{ $admin->hasPermission('view_domain_checkbox') ? 'checked' : '' }}> View
                                            Domain
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="create_domain_checkbox"
                                                {{ $admin->hasPermission('create_domain_checkbox') ? 'checked' : '' }}>
                                            Create Domain
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="edit_domain_checkbox"
                                                {{ $admin->hasPermission('edit_domain_checkbox') ? 'checked' : '' }}> Edit
                                            Domain
                                        </td>
                                        <td style="width:150px"> Update App logo & Favicon : <span
                                                class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="edit_applogo_favicon"
                                                {{ $admin->hasPermission('edit_applogo_favicon') ? 'checked' : '' }}>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="width:150px"> Instant Transaction / <br>Deposit / <br>Withdraw Page :
                                            <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="quick_withdraw_toggle"
                                                {{ $admin->hasPermission('quick_withdraw_toggle') ? 'checked' : '' }}>
                                            Quick Withdraw Process Toggle
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="mark_high_trans_toggle"
                                                {{ $admin->hasPermission('mark_high_trans_toggle') ? 'checked' : '' }}>
                                            Mark High Transactions Toggle

                                        </td>
                                        <td style="width:150px"> Relase Turnover : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="release_promotion"
                                                {{ $admin->hasPermission('release_promotion') ? 'checked' : '' }}>
                                            Promotion
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="release_bonus"
                                                {{ $admin->hasPermission('release_bonus') ? 'checked' : '' }}>
                                            Bonus

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <table class="table table-bordered table-hover tright medium">
                                <thead>
                                    <tr>
                                        <th style="float:left">Modules View</th>
                                        <th colspan="7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_0" checked onclick="chkall(this)">
                                            Total Bet :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_0_0" class="mod module_0"
                                                onclick="chkall_2()" name="sub_sidebar[Total Bet][SBO-Sport]"
                                                {{ $admin->hasPermission('sub_sidebar.Total Bet.SBO-Sport') ? 'checked' : '' }}>
                                            SBO-Sport </br>
                                            <input type="checkbox" id="module_0_1" class="mod module_0"
                                                onclick="chkall_2()" name="sub_sidebar[Total Bet][BTI-Sport]"
                                                {{ $admin->hasPermission('sub_sidebar.Total Bet.BTI-Sport') ? 'checked' : '' }}>
                                            BTI-Sport </br>
                                            <input type="checkbox" id="module_0_2" class="mod module_0"
                                                onclick="chkall_2()" name="sub_sidebar[Total Bet][UG-Sport]"
                                                {{ $admin->hasPermission('sub_sidebar.Total Bet.UG-Sport') ? 'checked' : '' }}>
                                            UG-Sport </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_1" checked onclick="chkall(this)">
                                            Member Mgmt :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_1_0" class="mod module_1"
                                                onclick="chkall_2()" name="sub_sidebar[Member Mgmt][New Member]"
                                                {{ $admin->hasPermission('sub_sidebar.Member Mgmt.New Member') ? 'checked' : '' }}>
                                            New Member </br>
                                            <input type="checkbox" id="module_1_2" class="mod module_1"
                                                onclick="chkall_2()" name="sub_sidebar[Member Mgmt][Account List]"
                                                {{ $admin->hasPermission('sub_sidebar.Member Mgmt.Account List') ? 'checked' : '' }}>
                                            Member List </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_2" checked onclick="chkall(this)">
                                            Report :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_2_5" class="mod module_2"
                                                onclick="chkall_2()" name="sub_sidebar[Report][Running Report]"
                                                {{ $admin->hasPermission('sub_sidebar.Report.Running Report') ? 'checked' : '' }}>
                                            Summary </br>
                                            <input type="checkbox" id="module_2_4" class="mod module_2"
                                                onclick="chkall_2()" name="sub_sidebar[Report][Daily Report]"
                                                {{ $admin->hasPermission('sub_sidebar.Report.Daily Report') ? 'checked' : '' }}>
                                            Member Summary </br>
                                            <input type="checkbox" id="module_2_1" class="mod module_2"
                                                onclick="chkall_2()" name="sub_sidebar[Report][Win/Lose]"
                                                {{ $admin->hasPermission('sub_sidebar.Report.Win/Lose') ? 'checked' : '' }}>
                                            Win/Lose Report </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_3" checked onclick="chkall(this)">
                                            Tools :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_3_0" class="mod module_3"
                                                onclick="chkall_2()" name="sub_sidebar[Tools][Promotion Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Tools.Promotion Settings') ? 'checked' : '' }}>
                                            Promotion & Bonus Settings </br>
                                            <input type="checkbox" id="module_3_1" class="mod module_3"
                                                onclick="chkall_2()" name="sub_sidebar[Tools][Admin Accounts]"
                                                {{ $admin->hasPermission('sub_sidebar.Tools.Admin Accounts') ? 'checked' : '' }}>
                                            Admin Accounts </br>
                                            <input type="checkbox" id="module_3_2" class="mod module_3"
                                                onclick="chkall_2()" name="sub_sidebar[Tools][Create Admin]"
                                                {{ $admin->hasPermission('sub_sidebar.Tools.Create Admin') ? 'checked' : '' }}>
                                            Create Admin </br>
                                            Game Settings </br>
                                            <input type="checkbox" id="module_3_7" class="mod module_3"
                                                onclick="chkall_2()" name="sub_sidebar[Tools][Admin Balance]"
                                                {{ $admin->hasPermission('sub_sidebar.Tools.Admin Balance') ? 'checked' : '' }}>
                                            Admin Balance </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_4" checked onclick="chkall(this)">
                                            Transactions :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_4_0" class="mod module_4"
                                                onclick="chkall_2()" name="sub_sidebar[Transactions][Transaction]"
                                                {{ $admin->hasPermission('sub_sidebar.Transactions.Transaction') ? 'checked' : '' }}>
                                            Transaction </br>
                                            <input type="checkbox" id="module_4_1" class="mod module_4"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Transactions][Transaction Old Record]"
                                                {{ $admin->hasPermission('sub_sidebar.Transactions.Transaction Old Record') ? 'checked' : '' }}>
                                            Transaction Old Record </br>
                                            <input type="checkbox" id="module_4_2" class="mod module_4"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Transactions][Transaction New Record]"
                                                {{ $admin->hasPermission('sub_sidebar.Transactions.Transaction New Record') ? 'checked' : '' }}>
                                            Transaction New Record </br>
                                            <input type="checkbox" id="module_4_3" class="mod module_4"
                                                onclick="chkall_2()" name="sub_sidebar[Transactions][Instant Transaction]"
                                                {{ $admin->hasPermission('sub_sidebar.Transactions.Instant Transaction') ? 'checked' : '' }}>
                                            Instant Transaction </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_5" checked onclick="chkall(this)">
                                            Fund :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_5_0" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Referral Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Fund.Referral Settings') ? 'checked' : '' }}>
                                            Referral Settings </br>
                                            <input type="checkbox" id="module_5_1" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Referral Process]"
                                                {{ $admin->hasPermission('sub_sidebar.Fund.Referral Process') ? 'checked' : '' }}>
                                            Referral Process </br>
                                            <input type="checkbox" id="module_5_2" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Referral Log]"
                                                {{ $admin->hasPermission('sub_sidebar.Fund.Referral Log') ? 'checked' : '' }}>
                                            Referral Log </br>
                                            <input type="checkbox" id="module_5_3" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Referral Process New]"
                                                {{ $admin->hasPermission('sub_sidebar.Fund.Referral Process New') ? 'checked' : '' }}>
                                            Referral Process New </br>
                                            <input type="checkbox" id="module_5_4" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Commision Rebate]"
                                                {{ $admin->hasPermission('sub_sidebar.Fund.Commision Rebate') ? 'checked' : '' }}>
                                            Commision Rebate </br>
                                            <input type="checkbox" id="module_5_5" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Commision Rebate Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Fund.Commision Rebate Settings') ? 'checked' : '' }}>
                                            Commision Rebate Settings </br>
                                            <input type="checkbox" id="module_5_6" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Commision Rebate Log]"
                                                {{ $admin->hasPermission('sub_sidebar.Fund.Commision Rebate Log') ? 'checked' : '' }}>
                                            Commision Rebate Log </br>
                                            <input type="checkbox" id="module_5_7" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Winlose Rebate]"
                                                {{ $admin->hasPermission('sub_sidebar.Fund.Winlose Rebate') ? 'checked' : '' }}>
                                            Winlose Rebate </br>
                                            <input type="checkbox" id="module_5_8" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Winlose Rebate Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Fund.Winlose Rebate Settings') ? 'checked' : '' }}>
                                            Winlose Rebate Settings </br>
                                            <input type="checkbox" id="module_5_9" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Winlose Rebate Log]"
                                                {{ $admin->hasPermission('sub_sidebar.Fund.Winlose Rebate Log') ? 'checked' : '' }}>
                                            Winlose Rebate Log </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_6" checked onclick="chkall(this)">
                                            Banking :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_6_0" class="mod module_6"
                                                onclick="chkall_2()" name="sub_sidebar[Banking][Fund Method Listing]"
                                                {{ $admin->hasPermission('sub_sidebar.Banking.Fund Method Listing') ? 'checked' : '' }}>
                                            Fund Method Listing </br>
                                            <input type="checkbox" id="module_6_1" class="mod module_6"
                                                onclick="chkall_2()" name="sub_sidebar[Banking][Ban Account]"
                                                {{ $admin->hasPermission('sub_sidebar.Banking.Ban Account') ? 'checked' : '' }}>
                                            Ban Account </br>
                                            <input type="checkbox" id="module_6_2" class="mod module_6"
                                                onclick="chkall_2()" name="sub_sidebar[Banking][Payment Gateway]"
                                                {{ $admin->hasPermission('sub_sidebar.Banking.Payment Gateway') ? 'checked' : '' }}>
                                            Payment Gateway </br>
                                            <input type="checkbox" id="module_6_3" class="mod module_6"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Banking][Fund Method Accounts Listing]"
                                                {{ $admin->hasPermission('sub_sidebar.Banking.Fund Method Accounts Listing') ? 'checked' : '' }}>
                                            Fund Method Accounts Listing </br>
                                            <input type="checkbox" id="module_6_4" class="mod module_6"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Banking][Fund Method Group Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Banking.Fund Method Group Settings') ? 'checked' : '' }}>
                                            Fund Method Group Settings </br>
                                            <input type="checkbox" id="module_6_5" class="mod module_6"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Banking][Fund Method Summary Report]"
                                                {{ $admin->hasPermission('sub_sidebar.Banking.Fund Method Summary Report') ? 'checked' : '' }}>
                                            Fund Method Summary Report </br>
                                            <input type="checkbox" id="module_6_6" class="mod module_6"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Banking][Fund Method Summary ReportV2]"
                                                {{ $admin->hasPermission('sub_sidebar.Banking.Fund Method Summary ReportV2') ? 'checked' : '' }}>
                                            Fund Method Summary ReportV2 </br>
                                            <input type="checkbox" id="module_6_7" class="mod module_6"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Banking][Fund Method Transaction Report]"
                                                {{ $admin->hasPermission('sub_sidebar.Banking.Fund Method Transaction Report') ? 'checked' : '' }}>
                                            Fund Method Transaction Report </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_7" checked onclick="chkall(this)">
                                            Website :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_7_0" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][HomePage Info]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.HomePage Info') ? 'checked' : '' }}>
                                            HomePage Info </br>
                                            <input type="checkbox" id="module_7_1" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Web Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Web Settings') ? 'checked' : '' }}>
                                            Web Settings </br>
                                            <input type="checkbox" id="module_7_2" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Domain Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Domain Settings') ? 'checked' : '' }}>
                                            Domain Settings </br>
                                            <input type="checkbox" id="module_7_3" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Domain Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Domain Settings') ? 'checked' : '' }}>
                                            Domain Settings </br>
                                            <input type="checkbox" id="module_7_4" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][SEO Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.SEO Settings') ? 'checked' : '' }}>
                                            SEO Settings </br>
                                            <input type="checkbox" id="module_7_5" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Custom SEO Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Custom SEO Settings') ? 'checked' : '' }}>
                                            Custom SEO Settings </br>
                                            <input type="checkbox" id="module_7_6" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Custom SEO Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Custom SEO Settings') ? 'checked' : '' }}>
                                            Custom SEO Settings </br>
                                            <input type="checkbox" id="module_7_7" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Custom SEO Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Custom SEO Settings') ? 'checked' : '' }}>
                                            Custom SEO Settings </br>
                                            <input type="checkbox" id="module_7_8" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Custom Canonicals]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Custom Canonicals') ? 'checked' : '' }}>
                                            Custom Canonicals </br>
                                            <input type="checkbox" id="module_7_9" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Sliding Banner Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Sliding Banner Settings') ? 'checked' : '' }}>
                                            Sliding Banner Settings </br>
                                            <input type="checkbox" id="module_7_10" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Contact Settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Contact Settings') ? 'checked' : '' }}>
                                            Contact Settings </br>
                                            <input type="checkbox" id="module_7_11" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Banner Setting]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Banner Setting') ? 'checked' : '' }}>
                                            Banner Setting </br>
                                            <input type="checkbox" id="module_7_12" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Bank Logo]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Bank Logo') ? 'checked' : '' }}>
                                            Bank Logo </br>
                                            <input type="checkbox" id="module_7_13" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Site Users Notifications]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Site Users Notifications') ? 'checked' : '' }}>
                                            Site Users Notifications </br>
                                            <input type="checkbox" id="module_7_14" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Users Secure Login Image]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Users Secure Login Image') ? 'checked' : '' }}>
                                            Users Secure Login Image </br>
                                            <input type="checkbox" id="module_7_15" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Website Layout]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Website Layout') ? 'checked' : '' }}>
                                            Website Layout </br>
                                            <input type="checkbox" id="module_7_16" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Edit Site Content]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Edit Site Content') ? 'checked' : '' }}>
                                            Edit Site Content </br>
                                            <input type="checkbox" id="module_7_17" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Terms and Condition]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Terms and Condition') ? 'checked' : '' }}>
                                            Terms and Condition </br>
                                            <input type="checkbox" id="module_7_18" class="mod module_7"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Website][Member Level Notification Content]"
                                                {{ $admin->hasPermission('sub_sidebar.Website.Member Level Notification Content') ? 'checked' : '' }}>
                                            Member Level Notification Content </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_8" checked onclick="chkall(this)">
                                            Memo :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_8_0" class="mod module_8"
                                                onclick="chkall_2()" name="sub_sidebar[Memo][Site Memo]"
                                                {{ $admin->hasPermission('sub_sidebar.Memo.Site Memo') ? 'checked' : '' }}>
                                            Site Memo </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_9" checked onclick="chkall(this)">
                                            Tutorials :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_9_0" class="mod module_9"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Tutorials][What to do before upload your banner images]"
                                                {{ $admin->hasPermission('sub_sidebar.Tutorials.What to do before upload your banner images') ? 'checked' : '' }}>
                                            What to do before upload your banner images </br>
                                            <input type="checkbox" id="module_9_1" class="mod module_9"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Tutorials][Domain activation guide]"
                                                {{ $admin->hasPermission('sub_sidebar.Tutorials.Domain activation guide') ? 'checked' : '' }}>
                                            Domain activation guide </br>
                                            <input type="checkbox" id="module_9_2" class="mod module_9"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Tutorials][How to set commission rebate settings]"
                                                {{ $admin->hasPermission('sub_sidebar.Tutorials.How to set commission rebate settings') ? 'checked' : '' }}>
                                            How to set commission rebate settings </br>
                                            <input type="checkbox" id="module_9_3" class="mod module_9"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Tutorials][How to set winlose rebate]"
                                                {{ $admin->hasPermission('sub_sidebar.Tutorials.How to set winlose rebate') ? 'checked' : '' }}>
                                            How to set winlose rebate </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </fieldset>
                    </form>
                    <div class="row justify-content-md-center">
                        <div class="col-md-4">
                            <div class="form-group">
                                <button class="waves-effect waves-light btn btn-info btn-sm btn-block btn-rounded"
                                    type="submit" id="submit" form="new_admin">Submit</button>
                            </div>
                        </div>
                    </div>
                    <p class="card-title">Password Policy</p>
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                                <li>
                                    <p class="small">Your password must include a combination of alphabetic characters
                                        (uppercase or
                                        lowercase letters), numbers and symbols.</p>
                                </li>
                                <li>
                                    <p class="small">Your password must not contain your login name, first and last
                                        name.</p>
                                </li>
                                <li>
                                    <p class="small">Your password must contain at least 8 characters.</p>
                                </li>
                            </ul>

                            <p style="font-size:13px;color:red">At {{ setting()->brand_name }}, we strive to protect your
                                online privacy by
                                following
                                strong password security standards.
                                The first step you can take to protect your privacy is to create a strong password.
                                Introducing
                                complexity in your passwords will minimize the risk of a security breach.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        /* .container-fluid {
                                                        max-width: 900px;
                                                      } */
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
@endpush
@push('script')
    <script type="text/javascript">
        function chkall(e) {
            let module = $(e).attr('id').split('_')[1];
            $(`.module_${module}`).prop('checked', e.checked);
        }

        //validate max transaction
        function isNum(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }

        function chkall_2() {
            $('.mod').each(function(i, v) {
                let checked = true;
                $('.' + $(v).attr('class').split(' ')[1]).each(function(ii, vv) {
                    if (!$(vv).is(':checked')) {
                        checked = false;
                    }
                });
                $(`#chk${$(v).attr('class').split(' ')[1]}`).prop('checked', checked);
            });
        }
        $.validator.addMethod("checkdigit", function(value) {
            return /[0-9]/.test(value);
        });
        $.validator.addMethod("pwcheck", function(value) {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) && /[a-z]/.test(value) && /\d/.test(value) && /[A-Z]/
                .test(value);
        });

        $.validator.addMethod("noRepeatingDigits", function(value, element) {
            // Ensure the input is exactly 6 digits long
            if (value.length !== 6) {
                return false;
            }

            // Check for repeating digits
            var digits = value.split('');
            var uniqueDigits = new Set(digits);

            // If the number of unique digits is less than 6, there are repeating digits
            return uniqueDigits.size === 6;
        });
        $(document).ready(function() {

            $('.check_all_edit_permission').click(function() {
                $('.edit_permission').prop('checked', this.checked);
            });

            chkall_2();

            $('#new_admin').submit(function(e) {
                e.preventDefault();
            }).validate({

                errorElement: 'small',
                errorPlacement: function(error, element) {
                    error.addClass('help-block text-danger form-text');
                    if (element.prop('type') === 'checkbox') {
                        error.insertAfter(element.parent('label'));
                    } else {
                        error.insertAfter(element);
                    }
                },

                highlight: function(element, errorClass, validClass) {
                    $(element).parents('.form-group').addClass('has-error form-text').removeClass(
                        'has-success');
                },

                unhighlight: function(element, errorClass, validClass) {
                    $(element).parents('.form-group').addClass('has-success form-text').removeClass(
                        'has-error');
                },
                submitHandler: function(form) {

                    $('button[type="submit"]').attr('disabled', 'disabled');
                    $.post($(form).attr('action'), $(form).serialize(), function(h, x, d) {
                        if (h.s == 'success') {
                            toastMessage(h.t, h.m, 'ff6849', h.s);
                            $('button[type="submit"]').removeAttr('disabled');
                            // location.reload();
                        } else {
                            toastMessage('Error on load', 'Please refresh this page', '#ff6849',
                                'error');
                        }
                    })
                }

            });

        });

        function resetPass(link) {
            $('.reset-btn').attr('disabled', 'disabled');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: link,
                type: "post",
                success: function(data) {
                    if (data.s == 'success') {
                        toastMessage(data.t, data.m, '#ff6849','success');
                        location.reload();
                    } else {
                        toastMessage(data.t, data.m, '#ff6849', 'warning');
                    }
                    $('.reset-btn').removeAttr('disabled');

                },
                error: function(error) {
                    console.log('eror', error.responseText)
                }
            });
        }
    </script>
@endpush
