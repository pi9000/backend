@extends('layouts.main')
@section('panel')
<style>
    /* .container-fluid {
                                                            max-width: 1170px;
                                                            } */
    /* .newTmpl{
                                                            background-color:#f9f6f6;
                                                            } */
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
        <h5 class="text-themecolor">Web Site Setting</h5>
    </div>
</div>

<div class="row" id="validation">
    <div class="col-12">


        <div class="card shadow">
            <div class="card-body">

                <div class="card-title">
                </div>
                <form id="update_webSettings" action="{{ url('/Website/WebSetting/Update') }}" method="post"
                    enctype="multipart/form-data">

                    <fieldset>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless table-hover tright medium">
                                <thead>
                                    <tr>
                                        <th colspan="2">Website Setting Information </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:150px">Brand Name <button on type="button" class="btn btn-link"
                                                data-toggle="popover" title="Info"
                                                data-content="Please key in alhpanumeric only with length not more than 200 letters">
                                                <i class="mdi mdi-information-outline"></i>
                                            </button> :
                                            <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input style="width:500px" type="text" class="" id="judul" name="judul"
                                                    value="{{ $data->web->judul }}" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px">Website Logo : <span class="text-danger">*</span></td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input style="width:500px" type="file" class="" id="logo" name="logo">
                                                <img src="{{ $data->web->logo }}" class="img-thumbnail" width="165px" />
                                                <input type="hidden" name="logo_url" value="{{ $data->web->logo }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px">Default Website Title <button on type="button"
                                                class="btn btn-link" data-toggle="popover" title="Info"
                                                data-content="Mobile End of Page Footer Box title">
                                                <i class="mdi mdi-information-outline"></i>
                                            </button>: </td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <textarea name="title" id="" cols="30" rows="10"
                                                    required>{{ $data->web->title }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:150px">Description <button on type="button"
                                                class="btn btn-link" data-toggle="popover" title="Info"
                                                data-content="Mobile End of Page Footer Box title">
                                                <i class="mdi mdi-information-outline"></i>
                                            </button>: </td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <textarea name="deskripsi" id="" cols="30" rows="10"
                                                    required>{{ $data->web->deskripsi }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:150px">Keywords:</td>
                                        <td colspan="4">
                                            <div class="livechat-container" style="float:left">
                                                <textarea rows="4" cols="140" style="width:500px" class="" id="keyword"
                                                    name="keyword">{{ $data->web->keyword }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:150px">Website Favicon : <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input style="width:500px" type="file" class="" id="icon_web"
                                                    name="icon_web">
                                                <img src="{{ $data->web->icon_web }}" class="img-thumbnail"
                                                    width="100px" />
                                                <input type="hidden" name="icon_web_url"
                                                    value="{{ $data->web->icon_web }}">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:250px">Announcement: <span class="text-danger">*</span></td>
                                        <td colspan="4">
                                            <div style="float:left">
                                                <textarea rows="4" cols="140" style="width:500px" class=""
                                                    id="notif_bar"
                                                    name="notif_bar">{{ $data->web->notif_bar }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:150px">Whatsapp No :</td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input style="width:500px" type="text" class="" id="no_whatsapp"
                                                    name="no_whatsapp" value="{{ $data->contact->no_whatsapp }}">
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:250px">Livechat Script: <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="4">
                                            <div style="float:left">
                                                <textarea rows="20" cols="140" style="width:500px" class="" id="script"
                                                    name="script">{{ $data->contact->script }}</textarea>
                                            </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td style="width:150px">Telegram Group ID:</td>
                                        <td colspan="4">
                                            <div class="livechat-container" style="float:left">
                                                <textarea rows="4" cols="140" style="width:500px" class=""
                                                    id="telegram_chat_id"
                                                    name="telegram_chat_id">{{ $data->web->telegram_chat_id }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Minimal Deposit Amount:
                                        </td>
                                        <td>
                                            <input id="min_depo" type="number" name="min_depo"
                                                value="{{ $data->web->min_depo }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Minimal Withdraw Amount:
                                        </td>
                                        <td>
                                            <input id="min_wd" type="number" name="min_wd"
                                                value="{{ $data->web->min_wd }}">
                                        </td>
                                    </tr>

                                    @if (auth()->user()->brand_id == 2)
                                    <tr class=" newTmpl" style="line-height: 2.5;">
                                        <td style="width:150px">Website Style (New) : <span class="text-danger">*</span>

                                        </td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <select id="websiteStyles2" name="web_styles" style="width:500px"
                                                    required>
                                                    <option value="">Please Choose</option>
                                                    <option value="style" {{ $data->web->warna == 'style' ? 'selected' : ''}}>
                                                        One Night </option>
                                                    <option value="style2" {{ $data->web->warna == 'style2' ? 'selected' :
                                                        ''}}> Green </option>
                                                    <option value="style3" {{ $data->web->warna == 'style3' ? 'selected' :
                                                        ''}}> Dark Purple </option>
                                                    <option value="style4" {{ $data->web->warna == 'style4' ? 'selected' :
                                                        ''}}> Ash </option>
                                                    <option value="style5" {{ $data->web->warna == 'style5' ? 'selected' :
                                                        ''}}> Pink </option>
                                                    <option value="style7" {{ $data->web->warna == 'style7' ? 'selected' :
                                                        ''}}> Black </option>
                                                    <option value="style14" {{ $data->web->warna == 'style14' ? 'selected' :
                                                        ''}}> Red </option>
                                                    <option value="style15" {{ $data->web->warna == 'style15' ? 'selected' :
                                                        ''}}> Red2 </option>
                                                    <option value="style25" {{ $data->web->warna == 'style25' ? 'selected' :
                                                        ''}}> Brown </option>
                                                    <option value="style10" {{ $data->web->warna == 'style10' ? 'selected' :
                                                        ''}}> Black 2 </option>
                                                    <option value="style30" {{ $data->web->warna == 'style30' ? 'selected' :
                                                        ''}}> Pink 2 </option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <input type="hidden" name="web_styles" value="{{ $data->web->warna }}">
                                    @endif

                                    <tr>
                                        <td style="width:150px">Tutorial Register Videos:</td>
                                        <td colspan="4">
                                            <div class="livechat-container" style="float:left">
                                                <textarea rows="4" cols="140" style="width:500px" class=""
                                                    id="tutorial_register"
                                                    name="tutorial_register">{{ $data->web->tutorial_register }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:150px">Tutorial Deposit Videos:</td>
                                        <td colspan="4">
                                            <div class="livechat-container" style="float:left">
                                                <textarea rows="4" cols="140" style="width:500px" class=""
                                                    id="tutorial_deposit"
                                                    name="tutorial_deposit">{{ $data->web->tutorial_deposit }}</textarea>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:150px">Tutorial Withdraw Videos:</td>
                                        <td colspan="4">
                                            <div class="livechat-container" style="float:left">
                                                <textarea rows="4" cols="140" style="width:500px" class=""
                                                    id="tutorial_withdraw"
                                                    name="tutorial_withdraw">{{ $data->web->tutorial_withdraw }}</textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:250px">Snowfake / Custom Script: <span
                                                class="text-danger">*</span>
                                        </td>
                                        <td colspan="4">
                                            <div style="float:left">
                                                <textarea rows="25" cols="140" style="width:500px" class=""
                                                    id="costum_script"
                                                    name="costum_script">{{ $data->web->costum_script }}</textarea>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Home Footer:
                                        </td>
                                        <td>
                                            <textarea class="txtEditor" id="custom_menu_mobile_lang" name="home_footer"
                                                rows="15" cols="50">{!! $data->web->home_footer !!}</textarea>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover tright medium">
                                <thead>
                                    <tr>
                                        <th colspan="2">Payment Gateway Settings (OMPAY)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:150px">Merchant Code</td>
                                        <td colspan="3">
                                            <input style="width:500px" type="text" class="" id="gateway_merchant"
                                                name="gateway_merchant" value="{{ $data->web->gateway_merchant }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px">Key</td>
                                        <td colspan="3">
                                            <input style="width:500px" type="text" class="" id="gateway_apikey"
                                                name="gateway_apikey" value="{{ $data->web->gateway_apikey }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px">Secret</td>
                                        <td colspan="3">
                                            <input style="width:500px" type="text" class="" id="gateway_secretkey"
                                                name="gateway_secretkey" value="{{ $data->web->gateway_secretkey }}">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px">Endpoint</td>
                                        <td colspan="3">
                                            <input style="width:500px" type="text" class="" id="gateway_endpoint"
                                                name="gateway_endpoint" value="{{ $data->web->gateway_endpoint }}">
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

@foreach ($data->api as $item)
<div class="row" id="validations{{ $item->id }}">
    <div class="col-12">


        <div class="card shadow">
            <div class="card-body">

                <div class="card-title">
                </div>
                <form id="update_webSettings_pg{{ $item->id }}" action="{{ url('/Website/WebSetting/UpdateApi') }}"
                    method="post" enctype="multipart/form-data">

                    <fieldset>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover tright medium">
                                <thead>
                                    <tr>
                                        <th colspan="2">Api Settings {{ $item->provider }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:150px">
                                            {{ $item->provider == 'NexusGGR' ? 'Agent Code' : 'Secure Login' }}
                                        </td>
                                        <td colspan="3">
                                            <input style="width:500px" type="text" class="" id="apikey" name="apikey"
                                                value="{{ $item->apikey }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px">
                                            {{ $item->provider == 'NexusGGR' ? 'Agent Token' : 'Secret Key' }}</td>
                                        <td colspan="3">
                                            <input style="width:500px" type="text" class="" id="secretkey"
                                                name="secretkey" value="{{ $item->secretkey }}" required>
                                        </td>
                                    </tr>
                                    <tr {{ $item->provider == 'NexusGGR' ? '' : 'style="display:none;"' }}>
                                        <td style="width:150px">
                                            {{ $item->provider == 'NexusGGR' ? 'Secret Key' : 'Agent Code' }}</td>
                                        <td colspan="3">
                                            <input style="width:500px" type="text" class="" id="agentcode"
                                                name="agentcode" value="{{ $item->agentcode }}" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:150px">Api URl</td>
                                        <td colspan="3">
                                            <input style="width:500px" type="text" class="" id="url" name="url"
                                                value="{{ $item->url }}" required>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </fieldset>
                </form>


                <div class="row mt-2 justify-content-md-center">
                    <div class="col-md-2">
                        <div class="form-group">
                            <button class="waves-effect waves-light btn btn-info  btn-block btn-rounded" type="submit"
                                id="submit" form="update_webSettings_pg{{ $item->id }}">Save Changes </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
@push('script')
<script type="text/javascript">
    var c_Italic = function(context) {
            var ui = $.summernote.ui;

            // create button
            var button = ui.button({
                contents: '<i class="note-icon-italic"></i>',
                tooltip: 'custom',
                click: function() {
                    var text = context.invoke('editor.getSelectedText');
                    var $node = $('<span style="font-style:italic">' + text + '<span>');
                    context.invoke('editor.insertNode', $node[0]);
                }
            });

            return button.render(); // return button as jquery object
        }
        $(document).ready(function() {
            $('.input-daterange').daterangepicker({
                startDate: moment(),
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm:ss',
                    cancelLabel: 'Clear'
                }
            });

            $('.input-daterange').on('cancel.daterangepicker', function(ev, picker) {
                //do something, like clearing an input
                $('.input-daterange').val('');
            });
            $(".txtEditor").summernote({
                height: 300,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['mybutton', ['custom']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],
                buttons: {
                    custom: c_Italic
                }
            });

            $('input[type="radio"][name="is_custom_maint"]').change(function() {
                var v = $(this).val();
                v = $('input[type="radio"][name="is_custom_maint"]:checked').val();
                if (v == '0' || !v) {
                    $('#maint_reason_wrap').hide();
                } else {
                    $('#maint_reason_wrap').show();
                }

            });
            $('input[type="radio"][name="is_custom_maint"]').change();

        });
</script>
@endpush
