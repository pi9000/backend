@extends('layouts.main')
@section('panel')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h5 class="text-themecolor">Games List Management</h5>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="panel panel-bordered">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    Games List Management
                                </h3>
                            </div>
                            <div class="panel-body container-fluid">
                                <div class="example-wrap">
                                    <div class="" id="member_basic_details">
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
                                        <div class="table-responsive">
                                            <table
                                                class="table table-bordered table-hover tright medium BannerSettingTable">
                                                <thead>
                                                    <tr>
                                                        <th># </th>
                                                        <th> Provider </th>
                                                        <th width="120px;"> Provider API </th>
                                                        <th width="120px;"> Provider Code </th>
                                                        <th> Game Name </th>
                                                        <th> Game Image </th>
                                                        <th> Category </th>
                                                        <th> Sequence </th>
                                                        <th> Last Updated </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align:center;color:black">
                                                    @foreach ($data->data as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->Provider }}</td>
                                                        <td>{{ $item->provider_id == 1 ? 'NexusGGR' : 'Reviplay' }}
                                                        </td>
                                                        <td>{{ $item->ProviderCode }}</td>
                                                        <td>{{ $item->GameName }}</td>
                                                        <td>
                                                            <img src="{{ $item->Game_image }}" alt="Brand Logo"
                                                                class="img-thumbnail" width="125px">
                                                        </td>
                                                        <td>{{ $item->Category }}</td>
                                                        <td>{{ $item->sequence }}</td>
                                                        <td>{{ date('Y-m-d H:i:s', strtotime($item->updated_at)) }}</td>
                                                        <td>
                                                            <button type="button"
                                                                class="waves-effect waves-light btn btn-info btn-sm btn-rounded"
                                                                data-toggle="modal"
                                                                data-target="#editModal{{ $item->id }}"><i
                                                                    class="fas fa-pencil-alt"></i></button>

                                                            <div class="modal" id="editModal{{ $item->id }}"
                                                                tabindex="-1" role="dialog" data-backdrop="static"
                                                                aria-labelledby="exampleModalCenterTitle"
                                                                aria-hidden="true">
                                                                <div
                                                                    class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header bordered">
                                                                            <h4 class="modal-title">Edit Games
                                                                                <b>{{ $item->GameName }}</b>
                                                                            </h4>
                                                                            <button aria-hidden="true"
                                                                                data-dismiss="modal" class="close"
                                                                                type="button">×</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="form-horizontal" role="form"
                                                                                method="POST"
                                                                                action="{{ url('game_list_management/' . $template->id . '/update') }}"
                                                                                id="slidingBannerForm"
                                                                                enctype="multipart/form-data">
                                                                                @csrf
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $item->id }}">
                                                                                <div class="form-group pmd-textfield pmd-textfield-floating-label row"
                                                                                    align="center">
                                                                                    <label class="col-sm-2"
                                                                                        for="first-name">Provider</label>
                                                                                    <input type="text"
                                                                                        class="form-control col-sm-8"
                                                                                        value="{{ $item->Provider }}"
                                                                                        name="provider" disabled>
                                                                                </div>
                                                                                <div class="form-group pmd-textfield pmd-textfield-floating-label row"
                                                                                    align="center">
                                                                                    <label class="col-sm-2"
                                                                                        for="first-name">Provider
                                                                                        API</label>
                                                                                    <input type="text"
                                                                                        class="form-control col-sm-8"
                                                                                        id="name"
                                                                                        value="{{ $item->provider_id == 1 ? 'NexusGGR' : 'Reviplay' }}"
                                                                                        disabled>
                                                                                </div>
                                                                                <div class="form-group pmd-textfield pmd-textfield-floating-label row"
                                                                                    align="center">
                                                                                    <label class="col-sm-2"
                                                                                        for="first-name">Game
                                                                                        Name</label>
                                                                                    <input type="text"
                                                                                        class="form-control col-sm-8"
                                                                                        value="{{ $item->GameName }}"
                                                                                        name="game_name" disabled>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="form-group pmd-textfield pmd-textfield-floating-label row"
                                                                                    align="center">
                                                                                    <label class="col-sm-2"
                                                                                        for="first-name">Game
                                                                                        Image</label>
                                                                                    <input type="file"
                                                                                        class="form-control col-sm-8"
                                                                                        id="name" name="banner">
                                                                                    <input type="hidden"
                                                                                        name="game_image_url"
                                                                                        value="{{ $item->Game_image }}">
                                                                                </div>

                                                                                <div class="form-group pmd-textfield pmd-textfield-floating-label row"
                                                                                    align="center">
                                                                                    <label class="col-sm-2"
                                                                                        for="first-name">Sequence</label>
                                                                                    <input type="number"
                                                                                        class="form-control col-sm-8"
                                                                                        value="{{ $item->sequence }}"
                                                                                        name="sequence" required>
                                                                                </div>

                                                                                <div class="clearfix"></div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-default"
                                                                                        data-dismiss="modal"
                                                                                        class="close">Cancel</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary">Submit</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function() {
            $('.BannerSettingTable').DataTable({
                dom: 'lfrtip',
                lengthMenu: [
                    [50, 100, 150, 200, -1],
                    [50, 100, 150, 200, "All"]
                ],
                pageLength: 50,
                info: false,
                ordering: false,
            });
        });
</script>
@endpush
