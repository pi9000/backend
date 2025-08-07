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


<div class="row mt-3">
    <div class="col-lg-6 col-sm-6 align-center">
        <h5 class="m-0">Providers Management</h5>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover tright medium BannerSettingTable">
        <thead>
            <tr>
                <th># </th>
                <th> Provider </th>
                <th width="120px;"> Provider API </th>
                <th width="120px;"> Provider Code </th>
                <th> Type </th>
                <th> Icon </th>
                <th> Banner </th>
                <th> Status </th>
                <th> Game List </th>
                <th> Action </th>
            </tr>
        </thead>
        <tbody style="text-align:center;color:black">
            @foreach ($data->data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->provider }}</td>
                    <td>{{ $item->provider_id == 1 ? 'NexusGGR' : 'Reviplay' }}</td>
                    <td>{{ $item->ProviderCode }}</td>
                    <td>{{ $item->type }}</td>
                    <td>
                        <img src="{{ $item->icon }}" alt="Brand Logo" class="img-thumbnail" width="125px">
                    </td>
                    <td>
                        <img src="{{ $item->banner }}" alt="Brand Logo" class="img-thumbnail" width="100px">
                    </td>
                    <td>
                        @if ($item->status != 1)
                            <span class="label label-warning">Maintenance</span>
                        @else
                            <span class="label label-success">Active</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('game_providers/game_list_management?i=' . $item->id) }}&t={{ $template->id }}" target="_blank" class="waves-effect waves-light btn btn-primary btn-sm btn-rounded"><i
                                class="fas fa-eye"></i></a>
                    </td>
                    <td>
                        <button type="button" class="waves-effect waves-light btn btn-info btn-sm btn-rounded"
                            data-toggle="modal" data-target="#editModal{{ $item->id }}"><i
                                class="fas fa-pencil-alt"></i></button>

                        <div class="modal" id="editModal{{ $item->id }}" tabindex="-1" role="dialog"
                            data-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header bordered">
                                        <h4 class="modal-title">Edit Providers <b>{{ $item->provider }}</b></h4>
                                        <button aria-hidden="true" data-dismiss="modal" class="close"
                                            type="button">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" role="form" method="POST"
                                            action="{{ url('game_providers_table/' . $template->id . '/update') }}"
                                            id="slidingBannerForm" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <div class="form-group pmd-textfield pmd-textfield-floating-label row"
                                                align="center">
                                                <label class="col-sm-2" for="first-name">Provider</label>
                                                <input type="text" class="form-control col-sm-8"
                                                    value="{{ $item->provider }}" name="provider" disabled>
                                            </div>
                                            <div class="form-group pmd-textfield pmd-textfield-floating-label row"
                                                align="center">
                                                <label class="col-sm-2" for="first-name">Provider API</label>
                                                <input type="text" class="form-control col-sm-8" id="name"
                                                    value="{{ $item->provider_id == 1 ? 'NexusGGR' : 'Reviplay' }}"
                                                    disabled>
                                            </div>
                                            <hr>
                                            <div class="form-group pmd-textfield pmd-textfield-floating-label row"
                                                align="center">
                                                <label class="col-sm-2" for="first-name">Banner</label>
                                                <input type="file" class="form-control col-sm-8" id="name"
                                                    name="banner">
                                                <input type="hidden" name="banner_url" value="{{ $item->banner }}">
                                            </div>
                                            <div class="form-group pmd-textfield pmd-textfield-floating-label row"
                                                align="center">
                                                <label class="col-sm-2" for="first-name">Icon</label>
                                                <input type="file" class="form-control col-sm-8" id="icon"
                                                    name="icon">
                                                <input type="hidden" name="icon_url" value="{{ $item->icon }}">
                                            </div>
                                            <div class="form-group pmd-textfield pmd-textfield-floating-label row"
                                                align="center">
                                                <label class="col-sm-2" for="sequence">Status </label>
                                                <select class="form-control col-sm-8" id="status" name="status"
                                                    required>
                                                    <option value="">-- Select status --</option>
                                                    <option value="1"
                                                        {{ $item->status == '1' ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="0"
                                                        {{ $item->status == '0' ? 'selected' : '' }}>
                                                        Maintenance
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"
                                                    class="close">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Submit</button>
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
