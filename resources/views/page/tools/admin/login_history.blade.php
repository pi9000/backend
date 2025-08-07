<div class="modal-dialog modal-dialog-centered modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header bordered">
            <h4>Login History <b>{{ $admin->username }}</b></h4>
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
        </div>
        <div class="modal-body container-fluid">
            <div class="table-responsive">
                <table id="login_history_table" class="table table-bordered table-hover toggle-circle table-primary">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Agent ID</th>
                            <th class="text-center">IP Address</th>
                            <th class="text-center">Country / City</th>
                            <th class="text-center">login_time</th>
                        </tr>
                    </thead>
                    <tbody style="background-color:white;">

                        @foreach ($loginHistory as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->agent_id }}</td>
                                <td class="text-center">{{ $item->ip_address }}</td>
                                <td class="text-center">{{ $item->country }}</td>
                                <td class="text-center">{{ $item->login_time }}</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
                <script>
                    $(document).ready(function() {
                                $('#login_history_table').DataTable({
                                    "info": false,
                                    "searching": false,
                                    "lengthChange": false,
                                    "ordering": false,
                                    "pageLength": 20,
                                });
                            });
                </script>
            </div>
        </div>
    </div>
</div>
