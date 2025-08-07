@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">WebSite HomePage Info</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col" id="account_table">

                    <style>
                        th {
                            text-align: center;
                        }

                        .control-label {
                            font-size: 0.8rem;
                        }

                        .form-control {
                            font-size: 0.8rem;
                            min-height: auto;
                        }

                        .filter-option {
                            font-size: 0.75rem;
                        }

                        .bootstrap-select .dropdown-menu li a span.text {
                            font-size: 0.75rem;
                        }

                        .dropdown-item.active,
                        .dropdown-item:active {
                            color: #fff !important;
                        }

                        .bootstrap-select .dropdown-menu li a:hover,
                        .bootstrap-select .dropdown-menu li a:focus {
                            color: #398bf7 !important;
                        }


                        label {
                            text-align: left;
                        }

                        .dropify-message p {
                            text-align: center;
                        }

                        .homebanner {
                            margin-left: 285px;
                            margin-top: -24px;
                        }
                    </style>
                    <!-- Trigger/Open The Modal -->


                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-title">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 align-center">
                                        <h5 class="m-0">Agent</h5>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 text-sm-right">
                                        <a href="javascript:void(0)" id="NewBanner"
                                            class="btn btn-sm btn-success btn-rounded btn-right" onclick="">Add</a>


                                        <div class="row">
                                            <label class="px-2 homebanner"><input type="checkbox" name="home_banner"
                                                    id="home_banner_1" onClick="submit_button(this.value)" value="1"
                                                    checked>
                                                Show Promotion Banner on HomePage
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover tright medium">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Title</th>
                                            <th> Type </th>
                                            <th> Banner Image </th>
                                            <th> Description </th>

                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;color:black">
                                        <tr>
                                            <td colspan="13" align="center"> No Records Found. </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div id="NewBanner_content" class="modal"></div>


                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(`#NewBanner`).click(function(e) {
                e.preventDefault();
                $('#NewBanner_content').load('HomePage/create');
                $('#NewBanner_content').modal("show");
            });



        });
    </script>



    <script type="text/javascript">
        function edit_banner(id) {
            $('#NewBanner_content').load(`HomePage/${id}/edit`);
            $('#NewBanner_content').modal("show");
        };

        function deleteModel(id) {
            $('#NewBanner_content').load(`HomePage/create?id=${id}`);
            $('#NewBanner_content').modal("show");
        };

        function submit_button(val) {

            var value = 0;
            if ($("#home_banner_1").prop('checked') == true) {
                value = 1;
            } else {
                value = 0;
            }
            $.ajax({
                url: '/Website/update_home_promotion_banner/' + value,
                type: "get",
                success: function(data) {
                    console.log(data);
                    swal({
                        text: data,
                        icon: "success",
                    })
                },
                error: function(error) {
                    console.log('eror', error.responseText)
                }
            });

        }


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endpush
