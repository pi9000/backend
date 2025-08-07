@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-12 align-self-center d-flex justify-content-between">
            <h5 class="text-themecolor">{{ $pageTitle }}</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">{{ $pageTitle }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="/myprofile">View Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Account Access Log</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span class="text-danger mb-3"> * last 10 invalid access IP </span>
                    <br>
                    <span class="invalid_account_table"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->

    <div class="row">
        <!-- content -->
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">

                    <table class="table table-sm table-bordered table-hover text-center">
                        <thead>
                            <th width="500px">Details</th>
                            <th width="500px">Information</th>
                            <th width="50px">Action</th>
                        </thead>

                        <tbody class="profile_table_body">

                            <tr>
                                <td class="table-light"> Username</td>
                                <td class="_profile_username">{{ auth()->user()->username }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary btn-block"
                                        disabled data-toggle="modal" data-target="#updateUsernameModalCenter"
                                        data-backdrop="static">Update Username</button>

                                    <!-- Modal -->
                                    <div class="modal" id="updateUsernameModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="updateUsernameModalCenter" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        Update Username</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group only_enable_otp text-secondary">
                                                        Noted: You need to verify OTP to update new password
                                                    </div>

                                                    <div class="form-group only_enable_otp">
                                                        <label for="exampleInputPassword1" class="float-left">
                                                            OTP Send to <span class="verify_method"></span>
                                                            - <span class="verify_destination text-danger"></span>
                                                        </label>
                                                        <input class="otp_verify_username form-control form-control-sm"
                                                            type="text" name="otp_verify_username"
                                                            id="otp_verify_username" value="" placeholder="Enter OTP">

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1" class="float-left">New
                                                            Username</label>
                                                        <input type="text"
                                                            class="form-control form-control-sm new_username"
                                                            id="new_username" name="new_username" placeholder=""
                                                            required="required">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input class="otp_username_update_token" type="text" value=""
                                                        hidden>
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-primary update_profile_username">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Modal -->
                                </td>
                            </tr>

                            <tr>
                                <td class="table-light">Security PIN</td>
                                <td>* * * * * *</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary btn-block btn_updatePinModalCenter"
                                        type="button" data-toggle="modal" data-target="#updatePINModalCenter"
                                        data-backdrop="static">Update
                                        PIN</a>

                                    <!-- Modal -->
                                    <div class="modal " id="updatePINModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="updatePINModalCenter" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        Update Security PIN</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group only_enable_otp text-secondary">
                                                        Noted: You need to verify OTP to update new second
                                                        PIN
                                                    </div>

                                                    <div class="form-group only_enable_otp">
                                                        <label for="exampleInputPassword1" class="float-left">
                                                            OTP Send to <span class="verify_method"></span>
                                                            - <span class="verify_destination text-danger"></span>
                                                        </label>
                                                        <input class="otp_verify_pin form-control form-control-sm"
                                                            type="text" name="otp_verify_pin" id="otp_verify_pin"
                                                            value="" placeholder="Enter OTP">

                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1" class="float-left">New
                                                            PIN</label>
                                                        <input type="text" class="form-control form-control-sm new_pin"
                                                            id="new_pin" name="new_pin" placeholder=""
                                                            required="required">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input class="otp_pin_update_token" type="text" value=""
                                                        hidden>
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-primary update_profile_pin">Save
                                                        changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Modal -->

                                </td>
                            </tr>

                            <tr>
                                <td class="table-light">Password</td>
                                <td>* * * * * *</td>
                                <td>
                                    <a href="#"
                                        class="btn btn-sm btn-primary btn-block btn_updatePasswordModalCenter"
                                        type="button" data-toggle="modal"
                                        data-target="#updatePasswordModalCenter">Update
                                        Password</a>

                                    <!-- Modal -->
                                    <div class="modal " id="updatePasswordModalCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="updatePasswordModalCenter" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        Update Password</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="updatePasswordForm">

                                                        <div class="form-group only_enable_otp text-secondary">
                                                            Noted: You need to verify OTP to update new
                                                            password
                                                        </div>

                                                        <div class="form-group only_enable_otp">
                                                            <label for="exampleInputPassword1" class="float-left">
                                                                OTP Send to <span class="verify_method"></span> - <span
                                                                    class="verify_destination text-danger"></span>
                                                            </label>
                                                            <input class="otp_verify_password form-control form-control-sm"
                                                                type="text" name="otp_verify_password"
                                                                id="otp_verify_password" value=""
                                                                placeholder="Enter OTP">

                                                        </div>
                                                        <hr>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1" class="float-left">Old
                                                                Password</label>
                                                            <input type="password"
                                                                class="form-control form-control-sm old_password"
                                                                id="old_password" name="old_password" placeholder=""
                                                                required="required">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1" class="float-left">New
                                                                Password</label>
                                                            <input type="password"
                                                                class="form-control form-control-sm new_password"
                                                                id="new_password" name="new_password" placeholder=""
                                                                required="required">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1" class="float-left">Confirm
                                                                New
                                                                Password</label>
                                                            <input type="password"
                                                                class="form-control form-control-sm confirm_password"
                                                                id="confirm_password" name="confirm_password"
                                                                placeholder="" required="required">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <input class="otp_password_update_token" type="text"
                                                        value="" hidden>
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-primary update_profile_password">Save
                                                        changes</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Modal -->

                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END content -->
        <!-- content -->
        <!-- END content -->
        <!-- content -->
        <div class="col-12">

            <div class="row page-titles">
                <div class="col-md-12 align-self-center d-flex justify-content-between">
                    <h5 class="text-themecolor">Admin Settings</h5>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-body">

                    <table class="table table-sm table-bordered table-hover text-center">
                        <thead>
                            <th width="500px">App Details</th>
                            <th width="500px">App Information</th>
                            <th width="50px">Action</th>
                        </thead>

                        <tbody class="profile_table_body">

                            <tr>
                                <td class="table-light">App Logo</td>
                                <td class="_app_logo">
                                    @if(auth()->user()->logo != null)
                                    <img src="{{ auth()->user()->logo }}" class="img-thumbnail" width="100px" />
                                    @else
                                    <span class="text-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary btn-block" type="button"
                                        data-toggle="modal" data-target="#updateAdminLogoCenter">Update
                                        Admin Logo</a>

                                    <!-- Modal -->
                                    <div class="modal " id="updateAdminLogoCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="updateAdminLogoCenter" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        Update Admin Logo</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" id="upload-appicon-form"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1" class="float-left">Admin
                                                                Logo</label>
                                                            <br>
                                                            <br>

                                                            <p class="text-danger">* Only allowed image
                                                                types ( jpeg, png, jpg, gif, svg, webp )</p>
                                                            <p class="text-danger">* Only image less than
                                                                2mb</p>
                                                            <div class="form-group">
                                                                <input type="file" name="file" class="form-control"
                                                                    id="image-input" accept="image/*">
                                                                <input type="hidden" name="title" value="appLogo">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Modal -->

                                </td>
                            </tr>
                            <tr>
                                <td class="table-light">App Favicon</td>
                                <td class="_app_logo">
                                    @if(auth()->user()->favicon != null)
                                    <img src="{{ auth()->user()->favicon }}" class="img-thumbnail" width="60px" />
                                    @else
                                    <span class="text-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary btn-block" type="button"
                                        data-toggle="modal" data-target="#updateFaviconCenter">Update Admin
                                        Favicon</a>

                                    <!-- Modal -->
                                    <div class="modal " id="updateFaviconCenter" tabindex="-1" role="dialog"
                                        aria-labelledby="updateFaviconCenter" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">
                                                        Update Admin Favicon</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" id="upload-favicon-form"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1" class="float-left">Admin
                                                                Favicon</label>
                                                            <br>
                                                            <br>

                                                            <p class="text-danger">* Only allowed image
                                                                types ( jpeg, png, jpg )</p>
                                                            <p class="text-danger">* Only image less than
                                                                200 kb</p>
                                                            <div class="form-group">
                                                                <input type="file" name="file" class="form-control"
                                                                    id="image-input" accept="image/*">
                                                                <input type="hidden" name="title" value="favicon">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-sm btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Upload</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Modal -->

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END content -->



    </div>

    <!-- OTP method -->
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-hover tright medium">
                <thead>
                    <tr>
                        <th colspan="4">OTP Authorization Method</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td style="width:200px" colspan="3" rowspan="2">

                            <div class="form-check">
                                Method - <span class="current_otp_method ">Email</span>
                            </div>

                        </td>

                        <td>
                            <button type="button" style="font-size:10px;float: right;"
                                class="waves-effect change-btn-otp-method waves-light btn btn-info btn-sm btn-rounded"
                                data-toggle="modal" data-target="#otpmethod" data-backdrop="static"
                                disabled="disabled">Change
                                Method</button>

                            <!-- Modal -->
                            <div class="modal " id="otpmethod" tabindex="-1" role="dialog"
                                aria-labelledby="otpmethodLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="otpmethodLabel">Change OTP Method
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <span class="text-secondary only_enable_otp">Noted: You need to
                                                verify OTP to update the authorization method</span>
                                            <table class="table table-lg">
                                                <tr class="only_enable_otp">
                                                    <td style="width:200px">
                                                        OTP Send to <span class="verify_method"></span> -
                                                        <span class="verify_destination text-danger"></span>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="otp_verify_code" type="text"
                                                                name="otp_verify_code" id="otp_verify_code"
                                                                value="">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr class="">
                                                    <td style="width:200px">

                                                        Choose Method

                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="otp_method" id="otp_method1" value="1"
                                                                checked>
                                                            <label class="form-check-label" for="otp_method1">
                                                                Email
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                name="otp_method" id="otp_method2" value="2">
                                                            <label class="form-check-label" for="otp_method2">
                                                                Phone (SMS)
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <input class="otp_update_token" type="text" value="" hidden>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary btn-otp-method" disabled>Save
                                                changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Modal -->
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- OTP method -->

    <!-- 2FA -->
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-hover tright medium">
                <thead>
                    <tr>
                        <th colspan="4">
                            Two Factor Authentication (2FA)

                            <!-- Button trigger modal -->
                            <i class="fas fa-question-circle pointer pl-1" data-toggle="modal"
                                data-target="#exampleModalLong"></i>

                            <!-- Modal -->
                            <div class="modal " id="exampleModalLong" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-dark" id="exampleModalLongTitle">
                                                Guildline for Two Factor Authentication (2FA)</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-dark">
                                            <h5><b>Step 1: Download Google Authenticator</b>
                                                <h5>
                                                    <p style="text-align:justify;">Android users can
                                                        download Google Authenticator from the Google Play
                                                        Store or search for "Google Authenticator" to
                                                        download from Google. iOS users will need to login
                                                        to the Apple App Store and search for "Google
                                                        Authenticator"</p>

                                                    <br>
                                                    <h5><b>Step 2: Bind your Google Authenticator to your UG
                                                            account for 2FA</b>
                                                        <h5>

                                                            <ul>
                                                                <li>
                                                                    In UG system, Click enable the Two
                                                                    Factor Authentication (2FA). The QR code
                                                                    will be generated.
                                                                </li>
                                                                <li>
                                                                    Open your Authenticator Application,
                                                                    then Click scan the barcode
                                                                </li>
                                                                <li>
                                                                    After scanning success, your
                                                                    Authenticator Application will showing
                                                                    2FA records with dynamic OTP code
                                                                </li>
                                                                <li>
                                                                    Provide the dynamic OTP code and your
                                                                    current password to verify your 2FA
                                                                    account
                                                                </li>
                                                                <li>
                                                                    The dynamic OTP code also will be the
                                                                    2FA access code when you want to login
                                                                    UG system
                                                                </li>
                                                            </ul>
                                                            <hr>
                                                            <div class="p-2 align-middle text-center">
                                                                <img src="https://files.sitestatic.net/rewards_prize/202406190203060000002d2d275a340__2488x1187.png"
                                                                    alt="" width="100%" height="100%">
                                                                <small class="text-secondary">Figure 1 -
                                                                    Enable the 2FA in UG system, the QR code
                                                                    will be generated</small>
                                                            </div>
                                                            <br>
                                                            <div class="p-2 align-middle text-center">
                                                                <img src="https://files.sitestatic.net/rewards_prize/2024061901513200000062507b604a0__1582x933.JPG"
                                                                    alt="" width="100%" height="100%">
                                                                <small class="text-secondary">Figure 2 -
                                                                    Scan the QR code using Authenticator
                                                                    Application</small>
                                                            </div>
                                                            <br>
                                                            <div class="p-2 align-middle text-center">
                                                                <img src="https://files.sitestatic.net/rewards_prize/2024061911244100000064037b07b90__824x916.png"
                                                                    alt="" width="100%" height="100%">
                                                                <small class="text-secondary">Figure 3 - The
                                                                    dynamic OTP in Authenticator Application
                                                                    will be the 2FA access code when login
                                                                    to UG system</small>
                                                            </div>
                                                            <br>



                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Button trigger modal -->


                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td style="width:200px" colspan="3" rowspan="2">

                            <span class="enable_text"><b class="text-success"><i class="fas fa-check"></i>
                                    You have enabled two factor authentication.</b></span>
                            <span class="disable_text"><b class="text-danger"><i class="fas fa-times"></i>
                                    You have not enabled two factor authentication. </b></span>

                        </td>

                        <td>

                            <button type="button" style="font-size:10px;float: right;"
                                class="enable_button_modal waves-effect enable-2fa-btn waves-light btn btn-info btn-sm btn-rounded"
                                data-toggle="modal" data-target="#enable2FA" data-backdrop="static" disabled="disabled">
                                Enable
                            </button>
                            <!-- Modal -->
                            <div class="modal " id="enable2FA" tabindex="-1" role="dialog"
                                aria-labelledby="enable2FALabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="enable2FALabel">Enable 2FA</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-lg">
                                                <tr>
                                                    <td width="60%">Current Password</td>
                                                    <td>
                                                        <small class="text-danger">*Please provide your
                                                            current password</small>
                                                        <input class="qr_current_password" type="password"
                                                            name="qr_current_password" id="qr_current_password">
                                                    </td>
                                                </tr>

                                                <tr class="only_enable_otp">
                                                    <td style="width:200px">
                                                        OTP Send to <span class="verify_method"></span> -
                                                        <span class="verify_destination text-danger"></span>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="otp_verify_2fa_code" type="text"
                                                                name="otp_verify_2fa_code" id="otp_verify_2fa_code"
                                                                value="">
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td width="60%">
                                                        <span class="text-danger qr_code_image">2FA QR code
                                                            loading...</span>
                                                    </td>
                                                    <td>
                                                        <p class="text-muted">
                                                            To finish enabling two factor
                                                            authentication.<br>
                                                            Scan the following QR code using your
                                                            authenticator application,<br>
                                                            then provide the generated 2FA OTP code<br>
                                                        </p>
                                                        <small class="text-danger">*2FA code</small>
                                                        <input class="verify_code_2fa" type="text"
                                                            name="verify_code_2fa" id="verify_code_2fa">
                                                    </td>
                                                </tr>
                                            </table>


                                        </div>
                                        <div class="modal-footer">
                                            <input class="otp_2fa_update_token" type="text" value="" hidden>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn save-2fa-btn btn-primary">Save
                                                changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" style="font-size:10px;float: right;"
                                class="disable_button_modal waves-effect disable-2fa-btn waves-light btn btn-danger btn-sm btn-rounded"
                                data-toggle="modal" data-target="#disable2FA">
                                Disable
                            </button>
                            <!-- Modal -->
                            <div class="modal " id="disable2FA" tabindex="-1" role="dialog"
                                aria-labelledby="disable2FALabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="disable2FALabel">Disable 2FA</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-lg">
                                                <tr>
                                                    <td width="60%">Current Password</td>
                                                    <td>
                                                        <small class="text-danger">*Please provide your
                                                            current password</small>
                                                        <input class="qr_remove_current_password" type="password"
                                                            name="qr_remove_current_password"
                                                            id="qr_remove_current_password">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td width="60%">Current 2FA code</td>
                                                    <td>
                                                        <small class="text-danger">*Please provide your
                                                            current 2FA code</small>
                                                        <input class="_2fa" type="test" name="_2fa"
                                                            id="_2fa">
                                                    </td>
                                                </tr>
                                            </table>
                                            <p>Are you sure to disable this 2FA records?</p>
                                            <small class="text-secondary">* You able to enable again with
                                                new 2FA records</small>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" class="btn delete-2fa-btn btn-danger">Disable</button>
                                        </div>
                                    </div>
                                </div>
                            </div>





                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- End 2FA -->
@endsection
@push('script')
    <script>
        $(document).ready(function() {

            if (`` == 1) {
                $('.enable_text').show()
                $('.disable_text').hide()

                $('.enable_button_modal').hide()
                $('.disable_button_modal').show()

            } else {
                $('.enable_text').hide()
                $('.disable_text').show()

                $('.enable_button_modal').show()
                $('.disable_button_modal').hide()
            }

            $('.enable-2fa-btn').click(function() {
                _loadQRcode();
            })

            function _loadQRcode() {
                $('.qr_code_image').html('QR code is loading...')
                $('.qr_current_password').val('')
                $('.verify_code_2fa').val('')

                $('.otp_verify_2fa_code').val('')
                $('.verify_destination').val('')
                $('.verify_method').val('')

                var fd = new FormData();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/show_2fa_qrcode',
                    type: "post",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        _sentOTPcode();
                        $('.qr_code_image').html(data)
                    },
                    error: function(error) {
                        try {
                            let errorResponse = JSON.parse(error.responseText);
                            toastMessage('Something Went Wrong', errorResponse.message, '#ff6849',
                                'error');
                        } catch (e) {
                            toastMessage('Something Went Wrong', error.responseText, '#ff6849',
                            'error');
                        }
                    }
                });
            }

            function _sentOTPcode() {
                $('.enable-2fa-btn').attr("disabled", true)



                $('.verify_destination').val('')
                $('.verify_method').val('')

                var fd = new FormData();
                fd.append("path", "/verify_2fa_qrcode");
                fd.append("update_details", "Enable 2FA Authentication");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/request_update_otp_session',
                    type: "post",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(data) {

                        switch (data.status) {
                            case -1:
                                $('.only_enable_otp').hide()
                                $('.enable-2fa-btn').attr("disabled", false)
                                break;

                            case 0:
                                $('.only_enable_otp').show()
                                swal("Opps!", data.message, "error");
                                break;

                            case 1:
                                $('.only_enable_otp').show()
                                $('.verify_destination').html(data.destination)
                                $('.verify_method').html(data.method)
                                $('.enable-2fa-btn').attr("disabled", false)
                                $('.otp_2fa_update_token').val(data.token)
                                break;
                            default:
                        }

                    },
                    error: function(error) {
                        try {
                            let errorResponse = JSON.parse(error.responseText);
                            toastMessage('Something Went Wrong', errorResponse.message, '#ff6849',
                                'error');
                        } catch (e) {
                            toastMessage('Something Went Wrong', error.responseText, '#ff6849',
                            'error');
                        }
                    }
                });
            }



            $('.save-2fa-btn').click(function() {
                var fd = new FormData();

                var qr_current_password = $('.qr_current_password').val();
                var verify_code_2fa = $('.verify_code_2fa').val();
                var otp_2fa_update_token = $('.otp_2fa_update_token').val();
                var otp_verify_2fa_code = $('.otp_verify_2fa_code').val();


                fd.append("qr_current_password", qr_current_password);
                fd.append("verify_code_2fa", verify_code_2fa);
                fd.append("otp_2fa_update_token", otp_2fa_update_token);
                fd.append("otp_verify_2fa_code", otp_verify_2fa_code);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/verify_2fa_qrcode',
                    type: "post",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(data) {

                        switch (data.status) {
                            case 0:
                                swal("Opps!", data.message, "error");
                                break;

                            case 1:
                                swal("Verify Done", data.message, "success");

                                $('.enable_text').show()
                                $('.disable_text').hide()

                                $('#enable2FA').modal('toggle');

                                $('.enable_button_modal').hide()
                                $('.disable_button_modal').show()


                                break;
                            default:

                        }

                    },
                    error: function(error) {
                        try {
                            let errorResponse = JSON.parse(error.responseText);
                            toastMessage('Something Went Wrong', errorResponse.message,
                                '#ff6849', 'error');
                        } catch (e) {
                            toastMessage('Something Went Wrong', error.responseText, '#ff6849',
                                'error');
                        }
                    }
                });
            })

            $('.delete-2fa-btn').click(function() {
                var fd = new FormData();

                var qr_remove_current_password = $('.qr_remove_current_password').val();
                var _2fa = $('._2fa').val();

                fd.append("qr_remove_current_password", qr_remove_current_password);
                fd.append("_2fa", _2fa);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/disable_2fa_qrcode',
                    type: "post",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(data) {

                        switch (data.status) {
                            case 0:
                                swal("Opps!", data.message, "error");
                                break;

                            case 1:
                                swal("Success", data.message, "success");

                                $('.enable_text').hide()
                                $('.disable_text').show()

                                $('#disable2FA').modal('toggle');

                                $('.enable_button_modal').show()
                                $('.disable_button_modal').hide()


                                break;
                            default:

                        }

                    },
                    error: function(error) {
                        try {
                            let errorResponse = JSON.parse(error.responseText);
                            toastMessage('Something Went Wrong', errorResponse.message,
                                '#ff6849', 'error');
                        } catch (e) {
                            toastMessage('Something Went Wrong', error.responseText, '#ff6849',
                                'error');
                        }
                    }
                });
            })


            var value = $("#pwd").val();
            $.validator.addMethod("checklower", function(value) {
                return /[a-z]/.test(value);
            });
            $.validator.addMethod("checkupper", function(value) {
                return /[A-Z]/.test(value);
            });
            $.validator.addMethod("checkdigit", function(value) {
                return /[0-9]/.test(value);
            });
            $.validator.addMethod("pwcheck", function(value) {
                return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) && /[a-z]/.test(value) && /\d/.test(value) &&
                    /[A-Z]/.test(value);
            });
            $.validator.addMethod("pwcheckspechars", function(value) {
                return /[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value)
            });


            $('.btn_updatePasswordModalCenter').click(function() {

                $('.update_profile_password').attr("disabled", true)
                $('.otp_verify_password').val('')
                $('.old_password').val('')
                $('.new_password').val('')
                $('.confirm_password').val('')

                $('.verify_destination').val('')
                $('.verify_method').val('')

                var fd = new FormData();
                fd.append("path", "/update_profile_password");
                fd.append("update_details", "Update Password");

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '/request_update_otp_session',
                    type: "post",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function(data) {

                        switch (data.status) {
                            case -1:
                                $('.only_enable_otp').hide()
                                $('.update_profile_password').attr("disabled", false)
                                break;

                            case 0:
                                $('.only_enable_otp').show()
                                swal("Opps!", data.message, "error");
                                break;

                            case 1:
                                $('.only_enable_otp').show()
                                $('.verify_destination').html(data.destination)
                                $('.verify_method').html(data.method)
                                $('.update_profile_password').attr("disabled", false)
                                $('.otp_password_update_token').val(data.token)
                                break;
                            default:
                        }

                    },
                    error: function(error) {
                        try {
                            let errorResponse = JSON.parse(error.responseText);
                            toastMessage('Something Went Wrong', errorResponse.message,
                                '#ff6849', 'error');
                        } catch (e) {
                            toastMessage('Something Went Wrong', error.responseText, '#ff6849',
                                'error');
                        }
                    }
                });

            })

            $("#updatePasswordForm").validate({
                rules: {
                    old_password: {
                        required: true,
                    },
                    new_password: {
                        required: true,
                        pwcheckspechars: true,
                        minlength: 8,
                        maxlength: 50,
                        checklower: true,
                        checkupper: true,
                        checkdigit: true
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "#new_password"
                    }
                },
                messages: {
                    old_password: {
                        required: "Please enter your old password",
                    },
                    new_password: {
                        pwcheckspechars: "The Password need atleast 1 uppercase alphabet & Symbol , Example Aa123456@",
                        pwcheck: "The Password need atleast 1 uppercase alphabet & Symbol , Example Aa123456@",
                        checklower: "The Password need atleast 1 uppercase alphabet & Symbol , Example Aa123456@",
                        checkupper: "The Password need atleast 1 uppercase alphabet & Symbol , Example Aa123456@",
                        checkdigit: "The Password need atleast 1 uppercase alphabet & Symbol , Example Aa123456@"
                    },
                    confirm_password: {
                        required: "Please confirm your new password",
                        equalTo: "Please enter the same password as above"
                    }
                },
                submitHandler: function(form) {

                    var old_password = $('#old_password').val();
                    var new_password = $('#new_password').val();
                    var confirm_password = $('#confirm_password').val();
                    var otp_verify_password = $('.otp_verify_password').val();
                    var otp_password_update_token = $('.otp_password_update_token').val()

                    var fd = new FormData();
                    var old_password = old_password;
                    var new_password = new_password;
                    var confirm_password = confirm_password;
                    var otp_verify_password = otp_verify_password;
                    var otp_password_update_token = otp_password_update_token;

                    fd.append("old_password", old_password);
                    fd.append("new_password", new_password);
                    fd.append("confirm_password", confirm_password);
                    fd.append("otp_verify_password", otp_verify_password);
                    fd.append("otp_password_update_token", otp_password_update_token);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: '/update_profile_password',
                        data: fd,
                        processData: false,
                        contentType: false,
                        success: function(data) {

                            if (data.status == 200) {
                                toastMessage('Update success', data.m, '#ff6849',
                                'success');
                                $('#updatePasswordModalCenter').modal('toggle');
                                $('#old_password').val("");
                                $('#new_password').val("");
                                $('#confirm_password').val("");

                            } else {
                                toastMessage('Something Went Wrong', data.m, '#ff6849',
                                    'error');
                            }
                        },
                        error: function(data) {
                            console.log("Error: ", data);
                            console.log("Errors->", data.errors);
                        }
                    });

                }
            });

            $(".update_profile_password").click(function() {
                $("#updatePasswordForm").submit();
            });
        });
    </script>

    <script type="text/javascript">
        $('.profile_table_body tr').hover(function() {
            $('.table-light').removeClass('text-primary font-weight-bold');
            $(this).find('.table-light').addClass('text-primary font-weight-bold');
        }, function() {
            $(this).removeClass('text-primary font-weight-bold');
        });

        $('.change-btn-otp-method').click(function() {

            $('.btn-otp-method').attr("disabled", true)
            $('.otp_verify_code').val('')
            $('.verify_destination').val('')
            $('.verify_method').val('')

            var fd = new FormData();
            fd.append("path", "/update_otp_method");
            fd.append("update_details", "Update OTP Authorization Method");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/request_update_otp_session',
                type: "post",
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {

                    switch (data.status) {
                        case -1:
                            $('.only_enable_otp').hide()
                            $('.btn-otp-method').attr("disabled", false)
                            break;

                        case 0:
                            $('.only_enable_otp').show()
                            swal("Opps!", data.message, "error");
                            break;

                        case 1:
                            $('.only_enable_otp').show()
                            $('.verify_destination').html(data.destination)
                            $('.verify_method').html(data.method)
                            $('.btn-otp-method').attr("disabled", false)
                            $('.otp_update_token').val(data.token)

                            break;
                        default:
                    }

                },
                error: function(error) {
                    try {
                        let errorResponse = JSON.parse(error.responseText);
                        toastMessage('Something Went Wrong', errorResponse.message, '#ff6849', 'error');
                    } catch (e) {
                        toastMessage('Something Went Wrong', error.responseText, '#ff6849', 'error');
                    }
                }
            });

        })

        $('.btn-otp-method').click(function() {
            var checked_method = $('input[name="otp_method"]:checked').val();
            var otp_verify_code = $('.otp_verify_code').val();
            var otp_update_token = $('.otp_update_token').val();

            var fd = new FormData();
            fd.append("checked_method", checked_method);
            fd.append("otp_verify_code", otp_verify_code);
            fd.append("otp_update_token", otp_update_token);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/update_otp_method',
                type: "post",
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {

                    if (data.status == 200) {
                        toastMessage('Update success', data.m, '#ff6849', 'success');
                        $('#otpmethod').modal('toggle');
                        $('.current_otp_method').html(data.n)


                    } else {
                        toastMessage('Something Went Wrong', data.m, '#ff6849', 'error');
                    }


                },
                error: function(error) {
                    try {
                        let errorResponse = JSON.parse(error.responseText);
                        toastMessage('Something Went Wrong', errorResponse.message, '#ff6849', 'error');
                    } catch (e) {
                        toastMessage('Something Went Wrong', error.responseText, '#ff6849', 'error');
                    }
                }
            });
        });

        $('.btn_updateUsernameModalCenter').click(function() {

            $('.update_profile_username').attr("disabled", true)
            $('.otp_verify_username').val('')
            $('.new_username').val('')
            $('.verify_destination').val('')
            $('.verify_method').val('')

            var fd = new FormData();
            fd.append("path", "/update_profile_username");
            fd.append("update_details", "Update Username");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/request_update_otp_session',
                type: "post",
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {
                    switch (data.status) {
                        case -1:
                            $('.only_enable_otp').hide()
                            $('.update_profile_username').attr("disabled", false)
                            break;

                        case 0:
                            $('.only_enable_otp').show()
                            swal("Opps!", data.message, "error");
                            break;
                        case 1:
                            $('.only_enable_otp').show()
                            $('.verify_destination').html(data.destination)
                            $('.verify_method').html(data.method)
                            $('.update_profile_username').attr("disabled", false)
                            $('.otp_username_update_token').val(data.token)

                            break;
                        default:
                    }

                },
                error: function(error) {
                    try {
                        let errorResponse = JSON.parse(error.responseText);
                        toastMessage('Something Went Wrong', errorResponse.message, '#ff6849', 'error');
                    } catch (e) {
                        toastMessage('Something Went Wrong', error.responseText, '#ff6849', 'error');
                    }
                }
            });

        })

        $('.update_profile_username').click(function() {
            var new_username = $('#new_username').val();
            var otp_verify_username = $('.otp_verify_username').val()
            var otp_username_update_token = $('.otp_username_update_token').val()

            var fd = new FormData();
            var new_username = new_username;
            fd.append("new_username", new_username);
            fd.append("otp_verify_username", otp_verify_username);
            fd.append("otp_username_update_token", otp_username_update_token);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/update_profile_username',
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {

                    if (data.status == 200) {
                        toastMessage('Update success', data.m, '#ff6849', 'success');
                        $('._profile_username').html(data.n)
                        $('#updateUsernameModalCenter').modal('toggle');
                        $('#new_username').val("");
                    } else {
                        toastMessage('Something Went Wrong', data.m, '#ff6849', 'error');
                    }
                },
                error: function(error) {
                    try {
                        let errorResponse = JSON.parse(error.responseText);
                        toastMessage('Something Went Wrong', errorResponse.message, '#ff6849', 'error');
                    } catch (e) {
                        toastMessage('Something Went Wrong', error.responseText, '#ff6849', 'error');
                    }
                }
            });
        })

        $('.update_app_brand').click(function() {
            var new_app_brand = $('#app_brand').val();
            var fd = new FormData();
            var new_app_brand = new_app_brand;
            fd.append("new_app_brand", new_app_brand);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/update_new_app_brand',
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {

                    if (data.status == 200) {
                        toastMessage('Update success', data.m, '#ff6849', 'success');
                        $('._app_brand').html(data.n)
                        $('#updateAppBrandModalCenter').modal('toggle');
                    } else {
                        toastMessage('Something Went Wrong', data.m, '#ff6849', 'error');
                    }
                },
                error: function(error) {
                    try {
                        let errorResponse = JSON.parse(error.responseText);
                        toastMessage('Something Went Wrong', errorResponse.message, '#ff6849', 'error');
                    } catch (e) {
                        toastMessage('Something Went Wrong', error.responseText, '#ff6849', 'error');
                    }
                }
            });
        })

        $('.update_complaint_email').click(function() {
            var new_complaint_email = $('#app_complaint_email').val();
            var new_mu = $('#app_complaint_email_mu').val();
            var fd = new FormData();
            var new_complaint_email = new_complaint_email;
            fd.append("complaint_email", new_complaint_email);
            fd.append("mu", new_mu);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/update_complaint_email',
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {

                    if (data.status == 200) {
                        toastMessage('Update success', data.m, '#ff6849', 'success');
                        $('._complaint_email').html(data.n)
                        $('#updateComplaintEmailModalCenter').modal('toggle');
                    } else {
                        toastMessage('Something Went Wrong', data.m, '#ff6849', 'error');
                    }
                },
                error: function(error) {
                    try {
                        let errorResponse = JSON.parse(error.responseText);
                        toastMessage('Something Went Wrong', errorResponse.message, '#ff6849', 'error');
                    } catch (e) {
                        toastMessage('Something Went Wrong', error.responseText, '#ff6849', 'error');
                    }
                }
            });
        })



        $('.btn_updatePinModalCenter').click(function() {

            $('.update_profile_pin').attr("disabled", true)
            $('.otp_verify_pin').val('')
            $('.new_pin').val('')
            $('.verify_destination').val('')
            $('.verify_method').val('')

            var fd = new FormData();
            fd.append("path", "/update_profile_pin");
            fd.append("update_details", "Update Second PIN");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/request_update_otp_session',
                type: "post",
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {

                    switch (data.status) {
                        case -1:
                            $('.only_enable_otp').hide()
                            $('.update_profile_pin').attr("disabled", false)
                            break;

                        case 0:
                            $('.only_enable_otp').show()
                            swal("Opps!", data.message, "error");
                            break;

                        case 1:
                            $('.only_enable_otp').show()
                            $('.verify_destination').html(data.destination)
                            $('.verify_method').html(data.method)
                            $('.update_profile_pin').attr("disabled", false)
                            $('.otp_pin_update_token').val(data.token)

                            break;
                        default:
                    }

                },
                error: function(error) {
                    try {
                        let errorResponse = JSON.parse(error.responseText);
                        toastMessage('Something Went Wrong', errorResponse.message, '#ff6849', 'error');
                    } catch (e) {
                        toastMessage('Something Went Wrong', error.responseText, '#ff6849', 'error');
                    }
                }
            });

        })

        $('.update_profile_pin').click(function() {
            var new_pin = $('#new_pin').val();
            var otp_verify_pin = $('.otp_verify_pin').val();
            var otp_pin_update_token = $('.otp_pin_update_token').val();

            var fd = new FormData();
            var new_pin = new_pin;

            fd.append("new_pin", new_pin);
            fd.append("otp_verify_pin", otp_verify_pin);
            fd.append("otp_pin_update_token", otp_pin_update_token);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/update_profile_pin',
                data: fd,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == 200) {
                        toastMessage('Update success', data.m, '#ff6849', 'success');
                        $('#updatePINModalCenter').modal('toggle');
                        $('#new_pin').val("");

                    } else {
                        toastMessage('Something Went Wrong', data.m, '#ff6849', 'error');
                    }

                },
                error: function(error) {
                    try {
                        let errorResponse = JSON.parse(error.responseText);
                        toastMessage('Something Went Wrong', errorResponse.message, '#ff6849', 'error');
                    } catch (e) {
                        toastMessage('Something Went Wrong', error.responseText, '#ff6849', 'error');
                    }
                }
            });
        })
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.invalid_account_table_button').click(function() {
            $('.invalid_account_table').html('')
            $.ajax({
                type: 'GET',
                url: `/account_access_log`,
                contentType: false,
                processData: false,
                success: (data) => {
                    console.log(data)
                    $('.invalid_account_table').html(data)
                },
                error: function(error) {
                    try {
                        let errorResponse = JSON.parse(error.responseText);
                        toastMessage('Something Went Wrong', errorResponse.message, '#ff6849', 'error');
                    } catch (e) {
                        toastMessage('Something Went Wrong', error.responseText, '#ff6849', 'error');
                    }
                }
            });
        });

        $('#upload-image-form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: `/upload_app_logo_images`,
                data: formData,
                contentType: false,
                processData: false,
                success: (data) => {
                    if (data.status == 200) {
                        toastMessage('Update success', data.m, '#ff6849', 'success');
                        $('#updateAppLogoCenter').modal('toggle');
                    } else {
                        toastMessage('Something Went Wrong', data.m, '#ff6849', 'error');
                    }
                },
                error: function(error) {
                    try {
                        let errorResponse = JSON.parse(error.responseText);
                        toastMessage('Something Went Wrong', errorResponse.message, '#ff6849', 'error');
                    } catch (e) {
                        toastMessage('Something Went Wrong', error.responseText, '#ff6849', 'error');
                    }
                }
            });
        });

        $('#upload-appicon-form, #upload-favicon-form').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: `/upload_admin_logo_images`,
                data: formData,
                contentType: false,
                processData: false,
                success: (data) => {
                    if (data.status == 200) {
                        toastMessage('Update success', data.m, '#ff6849', 'success');
                        $('#updateAdminLogoCenter').modal('hide');
                        $('#updateFaviconCenter').modal('hide');
                        setTimeout(function() {
                            window.location.reload()
                        }, 1000);

                    } else {
                        toastMessage('Something Went Wrong', data.m, '#ff6849', 'error');
                    }
                },
                error: function(error) {
                    try {
                        let errorResponse = JSON.parse(error.responseText);
                        toastMessage('Something Went Wrong', errorResponse.message, '#ff6849', 'error');
                    } catch (e) {
                        toastMessage('Something Went Wrong', error.responseText, '#ff6849', 'error');
                    }
                }
            });
        });
    </script>
@endpush
