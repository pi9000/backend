@extends('layouts.main')
@section('panel')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h5 class="text-themecolor">New Bank Account Settings</h5>
    </div>
</div>
<div class="row" id="validation">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title">

                </div>
                <form id="save_bank_account" action="{{ url('save_bank_account') }}" method="post" enctype="multipart/form-data">
                    <fieldset>
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless table-hover tright medium">
                                <col width="40%">
                                <col width="60%">
                                <thead>
                                    <tr>
                                        <th colspan="2">New Bank Account Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bank Name :
                                            <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <div style="float:left">
                                                <input type="text" class="" id="bank_name" name="bank_name"
                                                    required="required">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Account Name :
                                            <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <div style="float:left">
                                                <input type="text" class="" id="bank_acc_name" name="bank_acc_name"
                                                    required="required">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Account No. :
                                            <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <div style="float:left">
                                                <input type="text" class="" id="bank_acc_no" name="bank_acc_no"
                                                    required="required">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px">Bank Logo : <span class="text-danger">*</span></td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input style="width:500px" type="file" class="" id="logo" name="logo"
                                                    required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Currency :
                                            <span class="text-danger">*</span>
                                        </td>
                                        <td>
                                            <div style="float:left">
                                                <input type="text" class="" id="currency" name="currency"
                                                    value="{{ auth()->user()->currency }}" disabled="disabled">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </form>
                <div class="row justify-content-md-center">
                    <div class="col-md-2">
                        <div class="form-group">
                            <button class="waves-effect waves-light btn btn-info  btn-block btn-rounded" type="submit"
                                id="submit" form="save_bank_account">Create</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
