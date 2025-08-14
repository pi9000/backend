@extends('layouts.main')
@section('panel')
<style>
    .card {
        width: 100% !important;
    }

    .cus_menu_opt.active {
        color: #26a69a;
        display: flex;
    }

    .cus_menu_opt.active>i {
        display: block;
        padding-top: 5px;
    }

    .cus_menu_opt>i {
        display: none;
    }

    .option_div {
        display: flex;
    }

    .field-weburl [type=checkbox] {
        opacity: 0;
        position: absolute;
        left: -9999px;
    }

    .field-weburl input {
        max-width: 370px !important;
        width: 370px !important;
        font-size: 0.8rem;
        min-height: 30px;
    }

    .u-flex {
        display: flex;
        align-items: center;
        align-content: center;
    }

    .custom-meta {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .analytic-container {
        max-width: 1000px;
    }

    [type="checkbox"].no-style+label:before,
    [type="checkbox"].no-style:not(.filled-in)+label:after {
        content: none;
        /* Remove the content */
        border: none;
        /* Remove the border styling */
    }
</style>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
        float: right;
        margin: 0 10px 0 0;
    }

    /* Hide default HTML checkbox */
    .switch input {
        display: none;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
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

<style>
    thead tr:hover {
        background: initial !important;
    }
</style>

<style>
    .txtEditor {
        resize: none !important;
    }


    .button-view {
        display: flex;
        position: absolute;
        right: 20px;
        top: 3px;
    }
</style>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h5 class="text-themecolor">Luckyspin Prize Setting</h5>
    </div>
</div>

<div class="row" id="validation">
    <div class="col-12">

        <div class="card shadow">
            <div class="card-body">

                <div class="card-title">
                </div>
                <form id="update_webSettings" action="{{ url('luckyspin_settings_create') }}" method="post"
                    enctype="multipart/form-data">

                    <fieldset>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless table-hover tright medium">
                                <thead>
                                    <tr>
                                        <th colspan="2">Luckyspin Prize Information </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:150px">Title:
                                            <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input style="width:500px" type="text" class="" id="title" name="title" required>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:150px">Image : <span class="text-danger">*</span></td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input style="width:500px" type="file" class="" id="image" name="image">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:150px">Win Rate:
                                            <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input style="width:500px" type="number" class="" id="probability" name="probability" required>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:150px">Win Amount:
                                            <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input style="width:500px" type="number" class="" id="win" name="win" required>
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
                                id="submit" form="update_webSettings">Save Changes </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
