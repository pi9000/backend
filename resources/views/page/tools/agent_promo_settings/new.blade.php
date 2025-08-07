@extends('layouts.main')
@section('panel')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h5 class="text-themecolor">New Promotion</h5>
    </div>
</div>
<div class="row" id="validation">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-body">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 align-center">
                            <h5 class="m-0">Agent</h5>

                        </div>
                        <div class="col-lg-6 col-sm-6  text-sm-right">

                            <a href="{{ url('agent_promo_settings') }}" class="btn btn-sm btn-danger"
                                title="banner_settings"> <i class="fa fa-angle-left"></i> Back</a>

                        </div>
                    </div>

                </div>
                <form id="save_banners" action="{{ route('agent_promo_settings_creates') }}" method="POST"
                    enctype="multipart/form-data">
                    <fieldset>
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless table-hover tright medium">
                                <thead>
                                    <tr>
                                        <th colspan="3">New Promotion Information</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:200px">Promotion Title : <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input style="width:250px" type="text"
                                                    class="form-control input-sm col-sm-3" id="title" name="judul"
                                                    required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:200px">Minimum Deposit Amt : <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="3">

                                            <input style="width:250px" type="number"
                                                class="form-control input-sm col-sm-3" value='' id="minimal_depo"
                                                name="minimal_depo" required />

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:200px">Bonus Percentage : <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="3">

                                            <input style="width:250px" type="number"
                                                class="form-control input-sm col-sm-3" value='' id="bonus" name="bonus"
                                                required />

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:200px">Max Claim : <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="3">

                                            <input style="width:250px" type="number"
                                                class="form-control input-sm col-sm-3" value='' id="max_bonus"
                                                name="max_bonus" required />

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:200px">Claim Limit: <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="3">

                                            <input style="width:250px" type="number"
                                                class="form-control input-sm col-sm-3" value='' id="max_claim"
                                                name="max_claim" required />

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:200px">Turnover: <span class="text-danger">*</span>
                                        </td>
                                        <td colspan="3">

                                            <input style="width:250px" type="number"
                                                class="form-control input-sm col-sm-3" value='' id="to"
                                                name="to" required />

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:250px">Is Promo Show At Deposit Page: <span
                                                class="text-danger">*</span></td>
                                        <td colspan="3">

                                            <select id="type" name="type"
                                                class="form-control input-sm col-sm-3">
                                                <option value="2" selected>Yes</option>
                                                <option value="1">No</option>
                                            </select>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:250px"> Promotion Type : <span class="text-danger"></span>
                                        </td>
                                        <td colspan="3">
                                            <select id="type" name="bonus_type" class="form-control input-sm col-sm-3">
                                                <option value=""> Select </option>
                                                <option value="1">Welcome Bonus</option>
                                                <option value="2">First Deposit</option>
                                                <option value="3">First Deposit Daily</option>
                                                <option value="4">Redeposit</option>
                                                <option value="5">Anytime</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:250px"> Status : <span class="text-danger"></span> </td>
                                        <td colspan="3">
                                            <select id="status" name="status" class="form-control input-sm col-sm-3">
                                                <option value="active"> Active </option>
                                                <option value="not"> Inactive </option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:200px">Sequence : <span class="text-danger">*</span></td>
                                        <td colspan="3">

                                            <input style="width:250px" type="number"
                                                class="form-control input-sm col-sm-3" value='1' id="sequence"
                                                name="sequence" required />

                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="width:150px">Promo Image : <span class="text-danger">*</span></td>
                                        <td colspan="3">
                                            <div style="float:left">
                                                <input style="width:500px" type="file" class="img-thumbnail" id="homoPromoImgSrc"
                                                    name="file" required>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr class="row_txtEdit">
                                        <td colspan="3">
                                            <div class="cus_lbl">Content</div>
                                            <textarea id="txtEditorLang" class="banner_txtEditor"
                                                name="deskripsi"></textarea>

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
                                id="submit" form="save_banners">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
            $(".banner_txtEditor").summernote({
                height: 300,

                callbacks: {
                    onImageUpload: function(files) {
                        $(files).each(function(ind) {
                            var img_link = $(".note-editor .note-image-url").val();
                            let reader = new FileReader();
                            reader.readAsDataURL(files[ind]);
                            reader.addEventListener('load', (e) => {
                                if (img_link.length > 0) {
                                    $img = $('<a href="' + img_link +
                                        '" target="_blank"><img src="' + e.target
                                        .result + '"></a>');
                                } else {
                                    $img = $('<img src="' + e.target.result + '">');
                                }
                                //console.log($img[0]);
                                $(".banner_txtEditor").summernote('insertNode', $img[
                                    0]);
                                // alert("3");
                            });
                            //console.log(reader);
                        });
                    },
                    onImageLinkInsert: function(url) {}
                },
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['style']],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['mybutton', ['custom']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],

            });
        });
</script>
@endpush
