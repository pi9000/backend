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
        <h5 class="m-0">Brand Management</h5>
    </div>
    <div class="col-lg-6 col-sm-6  text-sm-right">
        <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-sm btn-success btn-rounded">
            <i class="fas fa-plus"></i>
            New
            Brand / Website</button>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-hover tright medium BannerSettingTable">
        <thead>
            <tr>
                <th># </th>
                <th> Brand / Agent ID </th>
                <th width="120px;"> Brand Title </th>
                <th width="120px;"> Brand Logo </th>
                <th width="120px;"> Brand Icon </th>
                <th> Template </th>
                <th> Created At </th>
                <th> Updated At </th>
                <th> Action </th>
            </tr>
        </thead>
        <tbody style="text-align:center;color:black">
            @foreach ($data->data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->agent_id }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>
                        <img src="{{ $item->logo }}" alt="Brand Logo" class="img-thumbnail" width="125px">
                    </td>
                    <td>
                        <img src="{{ $item->icon_web }}" alt="Brand Logo" class="img-thumbnail" width="100px">
                    </td>
                    <td>{{ $template->name }}</td>
                    <td>{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}</td>
                    <td>{{ date('Y-m-d H:i:s', strtotime($item->updated_at)) }}</td>
                    <td>
                        @if ($item->id == 1)
                            <button type="button" class="waves-effect waves-light btn btn-danger btn-sm btn-rounded"
                                disabled><i class="fas fa-trash-alt"></i></button>
                        @else
                            <a href="{{ url('brand_management/' . $item->agent_id . '/delete?brand_id=' . $template->id) }}"
                                class="waves-effect waves-light btn btn-danger btn-sm btn-rounded"
                                onclick="return confirm('Are you sure want to delete this brand?');">
                                <i class="fas fa-trash-alt"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
<div class="modal" id="addModal" tabindex="-1" role="dialog" data-backdrop="static"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bordered">
                <h4 class="modal-title">Add New Brand</h4>
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST"
                    action="{{ url('brand_management/create') }}" id="slidingBannerForm">
                    @csrf
                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">Brand Title</label>
                        <input type="text" class="form-control col-sm-8" id="name" name="title" required>
                    </div>
                    <hr>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">Username</label>
                        <input type="text" class="form-control col-sm-8" id="name" name="username" required>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">Email</label>
                        <input type="email" class="form-control col-sm-8" id="name" name="email" required>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">Password</label>
                        <input type="text" class="form-control col-sm-8" id="password" name="password" required>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">Credit</label>
                        <input type="number" class="form-control col-sm-8" id="balance" name="balance" value="0"
                            required>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">Pin</label>
                        <input type="number" class="form-control col-sm-8" id="pin" name="pin"
                            value="000000" disabled>
                    </div>
                    <hr>

                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">Agent Code NexusGGR</label>
                        <input type="text" class="form-control col-sm-8" id="apikey_nexusggr"
                            name="apikey_nexusggr" required>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">Agent Token NexusGGR</label>
                        <input type="text" class="form-control col-sm-8" id="agentcode_nexusggr"
                            name="agentcode_nexusggr" required>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">SecretKey NexusGGR</label>
                        <input type="text" class="form-control col-sm-8" id="secretkey_nexusggr"
                            name="secretkey_nexusggr" required>
                    </div>
                    <hr>

                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">Agent Code Reviplay</label>
                        <input type="text" class="form-control col-sm-8" id="apikey_reviplay"
                            name="apikey_reviplay" required>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">Agent Token Reviplay</label>
                        <input type="text" class="form-control col-sm-8" id="agentcode_reviplay"
                            name="agentcode_reviplay" required>
                    </div>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="first-name">SecretKey Reviplay</label>
                        <input type="text" class="form-control col-sm-8" id="secretkey_reviplay"
                            name="secretkey_reviplay" required>
                    </div>
                    <hr>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label row" align="center">
                        <label class="col-sm-2" for="sequence">Frontend Template </label>
                        <select class="form-control col-sm-8" id="template" name="template" required>
                            <option value="">-- Select Template --</option>
                            @foreach ($template_list as $item)
                                <option value="{{ $item->id }}" {{ $item->status == 0 ? 'disabled' : '' }}>
                                    {{ $item->name }}
                                    {{ $item->status == 0 ? '- Not Active' : '' }}</option>
                            @endforeach
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



<script>
    $('#slidingBannerForm').submit(function() {
        $(this).find("button[type='submit']").prop('disabled', true);
    });
</script>
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
