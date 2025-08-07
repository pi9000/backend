@extends('layouts.main')
@section('panel')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h5 class="text-themecolor">Web Site Sliding Banner</h5>
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
                                            class="btn btn-sm btn-success btn-rounded" onclick="">New Banner</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover tright medium SlidingBannerTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Agent Id</th>
                                            <th>Banner Image</th>
                                            <th>Status</th>
                                            <th>Created On</th>
                                            <th>Updated On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center; color: black">
                                        @foreach ($data->data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->agent_id }}</td>

                                                <td>
                                                    <img src="{{ $item->gambar }}" class="img-thumbnail" width="250px" />
                                                </td>
                                                <td>{{ ucfirst($item->status) }}</td>
                                                <td>{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}</td>
                                                <td>{{ date('Y-m-d H:i:s', strtotime($item->updated_at)) }}</td>

                                                <td>
                                                    <div>
                                                        <a href="{{ url('Website/SlidingBanner/' . $item->id . '/delete') }}"
                                                            class="waves-effect waves-light btn btn-danger btn-sm btn-rounded"
                                                            onclick="return confirm('Are you sure want to delete this banner?');">
                                                            <i class="fas fa-trash-alt"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- The Modal -->
                    <div id="NewBanner_content" class="modal">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header bordered">
                                    <h4 class="modal-title">Add New Banner</h4>
                                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                </div>
                                <div class="modal-body">
                                    <form class="form-horizontal" role="form" method="POST"
                                        action="{{ url('Website/SlidingBanner/Create') }}" id="slidingBannerForm"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <label class="" style="padding-bottom:10px" for="mobile_banner">Image
                                        </label>

                                        <div class="form-group position-relative">
                                            <input class="dropify" name="banner_image" type="file"
                                                id="input-file-now-custom-1" data-plugin="dropify"
                                                data-default-file="" required/>
                                            <div class="position-absolute text-center"
                                                style="font-size: 12px; bottom: 20px; left: 50%; transform: translateX(-50%); color: gray;">

                                                <div class="text-danger">
                                                    *Required
                                                </div>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



                        <script>
                            $(document).ready(function() {
                                $('.dropify').dropify();
                            });

                            $('#slidingBannerForm').submit(function() {
                                $(this).find("button[type='submit']").prop('disabled', true);
                            });
                        </script>
                    </div>
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
                $("#NewBanner_content").modal("show");
            });
        });
    </script>
@endpush
