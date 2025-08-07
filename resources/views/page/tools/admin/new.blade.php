@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">New Alias Account</h5>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/alias_account">Alias Accounts</a> </li>
                <li class="breadcrumb-item active"> New Alias Account </li>
            </ol>
        </div>
    </div>
    <div class="row" id="validation">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <form id="new_admin" action="/new_admin_post" method="post">
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
                                                {{ auth()->user()->agent_id }}@<input type="text" class=""
                                                    id="user_name" name="user_name" required>
                                                <input type="hidden" value="{{ auth()->user()->agent_id }}@"
                                                    name="pre_name">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Password : <span class="text-danger">*</span> </td>
                                        <td>
                                            <input type="password" class="" id="pwd" name="pwd" required
                                                autocomplete="false">
                                        </td>
                                        <td style="width:150px"> Confirm Password : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="password" class="" id="pwd_com" name="pwd_com" required
                                                autocomplete="false">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>
                                            <span class="otp_email">Email</span><span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <span class="otp_email_input">
                                                <input type="text" class="" id="email" name="email"
                                                    value="" required>
                                            </span>
                                        </td>
                                        <td style="width:150px"> Full Name : <span class="text-danger">*</span> </td>
                                        <td>
                                            <input type="text" class="" id="first_name" name="first_name" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Security PIN : <span class="text-danger">*</span> </td>
                                        <td>
                                            <input type="text" class="" id="secpwd" name="secpwd" required
                                                autocomplete="false" onkeypress='isNum(event)' minlength="6"
                                                maxlength="6">
                                            <p style="color:red; font-size:11px;"> Max 6 Digit</p>
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
                                                    name="alias_otp_toggle" disabled readonly checked>
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
                                        <th colspan="7"><input type="checkbox" class="check_all_edit_permission">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">

                                        <td style="width:150px"> Create Account : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_new">
                                        </td>
                                        <td style="width:150px"> Edit Account : <span class="text-danger">*</span> </td>
                                        <td>
                                            Status:
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_status_edit">
                                            <br>
                                            Suspend:
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_suspend_edit">
                                            <br>
                                            Name:
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_name_edit">
                                            <br>
                                            Email:
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_email_edit">
                                            <br>
                                            Mailing Subscription:
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_mail_sub_edit">
                                            <br>
                                            Phone:
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_phone_edit">
                                            <br>
                                            Identity:
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_identity_edit">

                                        </td>
                                        <td style="width:150px"> Edit Account Banking : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_acc_banking">
                                        </td>

                                    </tr>
                                    <tr class="">

                                        <td style="width:150px"> Member Details: <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_detail">
                                        </td>

                                        <td style="width:150px"> Member Phone : <span class="text-danger">*</span> </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_mobile">
                                        </td>
                                        <td style="width:150px"> Member Email: <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_account_email">
                                        </td>

                                    </tr>
                                    <tr class="">
                                        <td style="width:150px"> Comm Setting : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_commission">
                                        </td>
                                        <td style="width:150px"> Auto Toggle Bank : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_autobankgrouptoggle">
                                        </td>
                                        <td style="width:150px">
                                            <!--Effective PT Edit: <span class="text-danger">*</span>-->
                                        </td>
                                        <td>

                                        </td>

                                    </tr>

                                    <tr class="">

                                        <td style="width:150px"> Approve/Reject Transaction : <span
                                                class="text-danger">*</span></td>
                                        <td>
                                            Approve Transaction:
                                            <input type="checkbox" class="edit_permission" name="chkbox_apptrans">
                                            <br>
                                            Reject Transaction:
                                            <input type="checkbox" class="edit_permission" name="chkbox_rejecttrans">
                                            <br>
                                        </td>
                                        <td style="width:150px"> Create / Edit Agent Banking : <span
                                                class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_banking">
                                        </td>
                                        <td style="width:150px"> View Bank Listing : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_bank_listing">
                                        </td>


                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Bet Settings : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_betting">
                                        </td>
                                        <td style="width:150px">Member Level : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission"
                                                name="chkbox_account_memberlevel">
                                        </td>
                                        <td style="width:150px"> Edit Password : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_password_edit">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Create Affiliate : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_af_create">
                                        </td>
                                        <td style="width:150px"> Edit Affiliate : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_af_edit">
                                        </td>
                                        <td style="width:150px"> Edit Own Username : <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_username_edit">
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Bonus Release : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="chkbox_bonus_release">
                                        </td>

                                        <td style="width:150px"> Fund method listing page checkbox access : <span
                                                class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="pulsa_checkbox">
                                            Pulsa checkbox
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="ewallet_checkbox">
                                            E-wallet checkbox
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="crypto_checkbox">
                                            Crypto checkbox
                                        </td>

                                        <td style="width:150px"> Referral KYC : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="view_permission_referral_kyc"
                                                name="referral_kyc_view">
                                            <strong>View </strong>
                                            <br>
                                            <input type="checkbox" class="edit_permission_referral_kyc"
                                                name="referral_kyc_edit">
                                            <strong>Edit </strong>
                                            <br>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="width:150px"> Domain Settings permission : <span
                                                class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="view_domain_checkbox">
                                            View Domain
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="create_domain_checkbox">
                                            Create Domain
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="edit_domain_checkbox">
                                            Edit Domain
                                        </td>
                                        <td style="width:150px"> Update App logo & Favicon : <span
                                                class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="edit_applogo_favicon">
                                        </td>
                                        <td style="width:150px">last 5 Digit Showing for member bank account : <span
                                                class="text-danger">*</span></td>
                                        <td>
                                            <span class="px-3">
                                                <input id="member_bank_no_hide_yes" type="radio"
                                                    name="member_bank_no_hide">
                                                <label for="member_bank_no_hide_yes">
                                                    Yes
                                                </label>
                                            </span>
                                            <span class="px-3">
                                                <input id="member_bank_no_hide_no" type="radio"
                                                    name="member_bank_no_hide">
                                                <label for="member_bank_no_hide_no">
                                                    No
                                                </label>
                                            </span>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="width:150px"> Transaction : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="copy_transaction">
                                            Copy
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="excel_transaction">
                                            Excel
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="print_transaction">
                                            Print
                                        </td>
                                        <td style="width:150px"> Instant Transaction / <br>Deposit / <br>Withdraw Page :
                                            <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="quick_withdraw_toggle">
                                            Quick Withdraw Process Toggle
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="mark_high_trans_toggle">
                                            Mark High Transactions Toggle

                                        </td>
                                        <td style="width:150px"> Relase Turnover : <span class="text-danger">*</span></td>
                                        <td>
                                            <input type="checkbox" class="edit_permission" name="release_promotion">
                                            Promotion
                                            <br>
                                            <input type="checkbox" class="edit_permission" name="release_bonus"> Bonus

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
                                            <input type="checkbox" id="chkmodule_0" onclick="chkall(this)">
                                            Total Bet :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_0_0" class="mod module_0"
                                                onclick="chkall_2()" name="sub_sidebar[Total Bet][SBO-Sport]">
                                            SBO-Sport </br>
                                            <input type="checkbox" id="module_0_1" class="mod module_0"
                                                onclick="chkall_2()" name="sub_sidebar[Total Bet][BTI-Sport]">
                                            BTI-Sport </br>
                                            <input type="checkbox" id="module_0_2" class="mod module_0"
                                                onclick="chkall_2()" name="sub_sidebar[Total Bet][UG-Sport]">
                                            UG-Sport </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_1" onclick="chkall(this)">
                                            Member Mgmt :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_1_0" class="mod module_1"
                                                onclick="chkall_2()" name="sub_sidebar[Member Mgmt][New Member]">
                                            New Member </br>
                                            <input type="checkbox" id="module_1_2" class="mod module_1"
                                                onclick="chkall_2()" name="sub_sidebar[Member Mgmt][Account List]">
                                            Member List </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_2" onclick="chkall(this)">
                                            Report :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_2_5" class="mod module_2"
                                                onclick="chkall_2()" name="sub_sidebar[Report][Running Report]">
                                            Summary </br>
                                            <input type="checkbox" id="module_2_4" class="mod module_2"
                                                onclick="chkall_2()" name="sub_sidebar[Report][Daily Report]">
                                            Member Summary </br>
                                            <input type="checkbox" id="module_2_1" class="mod module_2"
                                                onclick="chkall_2()" name="sub_sidebar[Report][Win/Lose]">
                                            Win/Lose Report </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_3" onclick="chkall(this)">
                                            Tools :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_3_0" class="mod module_3"
                                                onclick="chkall_2()" name="sub_sidebar[Tools][Promotion Settings]">
                                            Promotion & Bonus Settings </br>
                                            <input type="checkbox" id="module_3_1" class="mod module_3"
                                                onclick="chkall_2()" name="sub_sidebar[Tools][Admin Accounts]">
                                            Admin Accounts </br>
                                            <input type="checkbox" id="module_3_2" class="mod module_3"
                                                onclick="chkall_2()" name="sub_sidebar[Tools][Create Admin]">
                                            Create Admin </br>
                                            <input type="checkbox" id="module_3_7" class="mod module_3"
                                                onclick="chkall_2()" name="sub_sidebar[Tools][Admin Balance]">
                                            Admin Balance </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_4" onclick="chkall(this)">
                                            Transactions :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_4_0" class="mod module_4"
                                                onclick="chkall_2()" name="sub_sidebar[Transactions][Transaction]">
                                            Transaction </br>
                                            <input type="checkbox" id="module_4_1" class="mod module_4"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Transactions][Transaction Old Record]">
                                            Transaction Old Record
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_5" onclick="chkall(this)">
                                            Fund :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_5_0" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Referral Settings]">
                                            Referral Settings </br>
                                            <input type="checkbox" id="module_5_1" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Referral Process]">
                                            Referral Process </br>
                                            <input type="checkbox" id="module_5_2" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Referral Log]">
                                            Referral Log </br>
                                            <input type="checkbox" id="module_5_3" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Referral Process New]">
                                            Referral Process New </br>
                                            <input type="checkbox" id="module_5_4" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Commision Rebate]">
                                            Commision Rebate </br>
                                            <input type="checkbox" id="module_5_5" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Commision Rebate Settings]">
                                            Commision Rebate Settings </br>
                                            <input type="checkbox" id="module_5_6" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Commision Rebate Log]">
                                            Commision Rebate Log </br>
                                            <input type="checkbox" id="module_5_7" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Winlose Rebate]">
                                            Winlose Rebate </br>
                                            <input type="checkbox" id="module_5_8" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Winlose Rebate Settings]">
                                            Winlose Rebate Settings </br>
                                            <input type="checkbox" id="module_5_9" class="mod module_5"
                                                onclick="chkall_2()" name="sub_sidebar[Fund][Winlose Rebate Log]">
                                            Winlose Rebate Log </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_6" onclick="chkall(this)">
                                            Banking :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_6_0" class="mod module_6"
                                                onclick="chkall_2()" name="sub_sidebar[Banking][Fund Method Listing]">
                                            Fund Method Listing </br>
                                            <input type="checkbox" id="module_6_1" class="mod module_6"
                                                onclick="chkall_2()" name="sub_sidebar[Banking][Ban Account]">
                                            Ban Account </br>
                                            <input type="checkbox" id="module_6_2" class="mod module_6"
                                                onclick="chkall_2()" name="sub_sidebar[Banking][Payment Gateway]">
                                            Payment Gateway </br>
                                            <input type="checkbox" id="module_6_3" class="mod module_6"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Banking][Fund Method Accounts Listing]">
                                            Fund Method Accounts Listing </br>
                                            <input type="checkbox" id="module_6_4" class="mod module_6"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Banking][Fund Method Group Settings]">
                                            Fund Method Group Settings </br>
                                            <input type="checkbox" id="module_6_5" class="mod module_6"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Banking][Fund Method Summary Report]">
                                            Fund Method Summary Report </br>
                                            <input type="checkbox" id="module_6_6" class="mod module_6"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Banking][Fund Method Summary ReportV2]">
                                            Fund Method Summary ReportV2 </br>
                                            <input type="checkbox" id="module_6_7" class="mod module_6"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Banking][Fund Method Transaction Report]">
                                            Fund Method Transaction Report </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_7" onclick="chkall(this)">
                                            Website :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_7_0" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][HomePage Info]">
                                            HomePage Info </br>
                                            <input type="checkbox" id="module_7_1" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Web Settings]">
                                            Web Settings </br>
                                            <input type="checkbox" id="module_7_2" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Domain Settings]">
                                            Domain Settings </br>
                                            <input type="checkbox" id="module_7_3" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Domain Settings]">
                                            Domain Settings </br>
                                            <input type="checkbox" id="module_7_4" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][SEO Settings]">
                                            SEO Settings </br>
                                            <input type="checkbox" id="module_7_5" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Custom SEO Settings]">
                                            Custom SEO Settings </br>
                                            <input type="checkbox" id="module_7_6" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Custom SEO Settings]">
                                            Custom SEO Settings </br>
                                            <input type="checkbox" id="module_7_7" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Custom SEO Settings]">
                                            Custom SEO Settings </br>
                                            <input type="checkbox" id="module_7_8" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Custom Canonicals]">
                                            Custom Canonicals </br>
                                            <input type="checkbox" id="module_7_9" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Sliding Banner Settings]">
                                            Sliding Banner Settings </br>
                                            <input type="checkbox" id="module_7_10" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Contact Settings]">
                                            Contact Settings </br>
                                            <input type="checkbox" id="module_7_11" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Banner Setting]">
                                            Banner Setting </br>
                                            <input type="checkbox" id="module_7_12" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Bank Logo]">
                                            Bank Logo </br>
                                            <input type="checkbox" id="module_7_13" class="mod module_7"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Website][Site Users Notifications]">
                                            Site Users Notifications </br>
                                            <input type="checkbox" id="module_7_14" class="mod module_7"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Website][Users Secure Login Image]">
                                            Users Secure Login Image </br>
                                            <input type="checkbox" id="module_7_15" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Website Layout]">
                                            Website Layout </br>
                                            <input type="checkbox" id="module_7_16" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Edit Site Content]">
                                            Edit Site Content </br>
                                            <input type="checkbox" id="module_7_17" class="mod module_7"
                                                onclick="chkall_2()" name="sub_sidebar[Website][Terms and Condition]">
                                            Terms and Condition </br>
                                            <input type="checkbox" id="module_7_18" class="mod module_7"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Website][Member Level Notification Content]">
                                            Member Level Notification Content </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_8" onclick="chkall(this)">
                                            Memo :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_8_0" class="mod module_8"
                                                onclick="chkall_2()" name="sub_sidebar[Memo][Site Memo]">
                                            Site Memo </br>
                                        </td>
                                        <td colspan="3">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:200px;vertical-align: top !important;">
                                            &nbsp;
                                            <input type="checkbox" id="chkmodule_9" onclick="chkall(this)">
                                            Tutorials :
                                        </td>
                                        <td style="width:300px">
                                            <input type="checkbox" id="module_9_0" class="mod module_9"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Tutorials][What to do before upload your banner images]">
                                            What to do before upload your banner images </br>
                                            <input type="checkbox" id="module_9_1" class="mod module_9"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Tutorials][Domain activation guide]">
                                            Domain activation guide </br>
                                            <input type="checkbox" id="module_9_2" class="mod module_9"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Tutorials][How to set commission rebate settings]">
                                            How to set commission rebate settings </br>
                                            <input type="checkbox" id="module_9_3" class="mod module_9"
                                                onclick="chkall_2()"
                                                name="sub_sidebar[Tutorials][How to set winlose rebate]">
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
                                    type="submit" id="submit" form="new_admin">Create</button>
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

        input.primary:+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:+.slider:before {
            -webkit-transform: translateX(17px);
            -ms-transform: translateX(17px);
            transform: translateX(17px);
        }

        input:not(:)+.slider:before {
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

        //   $.validator.addMethod(
        //     "pwcheck",
        //     function(value) {
        //       return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
        //         &&
        //         /[a-z]/.test(value) // has a lowercase letter
        //         &&
        //         /\d/.test(value) // has a digit
        //     },
        //     jQuery.validator.format("Invalid Password requirement")
        //   );
        var value = $("#pwd").val();
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

                rules: {
                    user_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 15,
                        remote: {
                            url: "/checkusername",
                            data: {
                                user_name: function() {
                                    return $("[name='pre_name']").val() + $("[name='user_name']").val();
                                }
                            }
                        }
                    },
                    email: {
                        required: true
                    },
                    first_name: {
                        required: true,
                        maxlength: 50
                    },
                    pwd: {
                        required: true,
                        minlength: 8,
                        maxlength: 50,
                        checkdigit: true
                    },
                    secpwd: {
                        required: true,
                    },
                    pwd_com: {
                        required: true,
                        equalTo: '#pwd'
                    },
                },

                messages: {
                    pwd: {
                        pwcheckspechars: "The Password need atleast 1 uppercase alphabet & Symbol , Example Aa123456@",
                        pwcheck: "The Password need atleast 1 uppercase alphabet & Symbol , Example Aa123456@",
                        checklower: "The Password need atleast 1 uppercase alphabet & Symbol , Example Aa123456@",
                        checkupper: "The Password need atleast 1 uppercase alphabet & Symbol , Example Aa123456@",
                        checkdigit: "The Password need atleast 1 uppercase alphabet & Symbol , Example Aa123456@"
                    },
                    user_name: {
                        remote: function() {
                            return $.validator.format("{0} is already taken.", $("#user_name").val())
                        }
                    }
                },

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
                            document.getElementById("new_admin").reset();
                        } else {
                            toastMessage('Error on load', 'Please refresh this page', '#ff6849',
                                'error');
                        }
                    })

                    // $('button[type="submit"]').attr('disabled', 'disabled');
                    // formPostData('#newagent', $(form).serialize(), '/allmagentlist', 'POST');
                    return 0;
                }

            });
            $('#pwd').rules('add', "pwcheck");

            // for OTP
            $('.otp_email').show()
            $('.otp_email_input').show()
            // $('.alias_otp_toggle').click(function(){

            //   if (typeof ori_toggle === "undefined" || ori_toggle == null || ori_toggle == "") {
            //       var ori_toggle = 0
            //   }

            //   if($(this).prop("checked") == true || $('.alias_reset_pw_toggle').prop('checked', this.checked) == true){
            //     // if toggle on
            //     $('.otp_email').show()
            //     $('.otp_email_input').show()
            //   }else{
            //     // if toggle off
            //     $('.otp_email').show()
            //     $('.otp_email_input').show()
            //   }

            // })

            // // Force reset password toggle
            // $('.alias_reset_pw_toggle').click(function(){

            //     if($(this).prop("checked") == true || $('.alias_otp_toggle').prop('checked', this.checked) == true){
            //         // if toggle on
            //         $('.otp_email').show()
            //         $('.otp_email_input').show()
            //     }else{
            //         // if toggle off
            //         $('.otp_email').hide()
            //         $('.otp_email_input').hide()
            //     }

            // })

        });
    </script>
@endpush
