@extends('layouts.main')
@section('panel')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h5 class="text-themecolor">New Member.</h3>
    </div>
</div>
<div class="row memberinfoform-wraper" id="validation">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <form id="reg_sm_agent_0" action="/new_member" method="post">
                    <fieldset>
                        @csrf
                        <div class="table-responsive tablewith-bordered">
                            <table class="table table-bordered table-hover tright medium">
                                <thead>
                                    <tr>
                                        <th>User Information</th>
                                        <th colspan="3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:150px"> Username : <span class="text-danger">*</span> </td>
                                        <td colspan="3">
                                            <div class="align-center">
                                                <div class="col-xl-5 p-0">
                                                    <div class="">
                                                        <input type="text" class="required" id="agent_id_1"
                                                            name="username" style="width: 50px;" required>
                                                    </div>
                                                </div>
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
                                        <td style="width:150px"> Mobile : <span class="text-danger">*</span></td>
                                        <td>
                                            +60
                                            <input type="number" class="" name="mobile" id="mobile" required>
                                        </td>
                                        <td style="width:150px"> Remark</td>
                                        <td>
                                            <input type="text" class="" name="remark" autocomplete="false">
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td style="width:150px" class="bank_table"> 2FA Status : <span
                                                class="text-danger">*</span> </td>
                                        <td class="bank_table">
                                            <select name="verified">
                                                <option value="1">Verifed</option>
                                                <option value="0">Need Verification</option>
                                            </select>
                                        </td>
                                        <td style="width:150px"> Currency : </td>
                                        <td>
                                            <input type="text" value="{{ auth()->user()->currency }}" readonly>

                                        </td>
                                    </tr>


                                    <tr class="">
                                        <td style="width:150px"> Upline Ref ID :
                                        </td>
                                        <td colspan="3">
                                            <input type="text" class="" id="ref_id" name="ref_id" value="">
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </fieldset>
                </form>

                <div class="row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-group">
                            <button class="waves-effect waves-light btn btn-info btn-md btn-block btn-rounded"
                                type="submit" id="submit" form="reg_sm_agent_0">Create</button>
                        </div>
                    </div>
                </div>
                <h3>Password Policy</h3>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            <li>
                                <p class="small">Your password must include a combination of alphabetic characters
                                    (uppercase or
                                    lowercase letters), numbers and symbols.</p>
                            </li>
                            <li>
                                <p class="small">Your password must not contain your login name, first and last name.
                                </p>
                            </li>
                            <li>
                                <p class="small">Your password must contain at least 8 characters.</p>
                            </li>
                        </ul>

                        <div class="text-danger">
                            <p><small>At {{ env('APP_TITLE') }}, we strive to protect your online privacy by following
                                    strong password security standards.</small><br />
                                <small>The first step you can take to protect your privacy is to create a strong
                                    password.
                                    Introducing
                                    complexity in your passwords will minimize the risk of a security breach.</small>
                            </p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('addon')
<div class="mess"></div>
@endpush

@push('script')
<script>
    $(document).ready(function() {
            $('#reg_sm_agent_0').on("submit", function(e) {
                e.preventDefault();
                let action = $(this).attr('action')
                let data = $(this).serialize();
                $('#submit').prop('disabled', 'disabled');
                $('#submit').html('Creating...');
                $.ajax({
                    type: 'POST',
                    url: action,
                    data: data,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastMessage('Success', response.message, '#ff6849', 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        } else {
                            toastMessage('Invalid', response.message, '#ff6849', 'error');
                        }
                        $('#submit').removeAttr('disabled');
                        $('#submit').html('Create');
                    },
                    error: function(xhr) {
                        toastMessage('Error', 'An error occurred. Please try again.', '#ff6849',
                            'error');
                        $('#submit').removeAttr('disabled');
                    }
                });
            });
        });

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
@endpush
