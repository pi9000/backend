<div class="text-sm-right">
    <a href="/new_bank_account" class="btn btn-sm btn-success btn-rounded mb-3" title="new_bank">New Bank Account</a>
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover tright medium" id="agent_bank_table">
        <thead class="text-center">
            <tr>
                <th> # </th>
                <th> Bank Name </th>
                <th> Account Name</th>
                <th> Account No.</th>
                <th> Bank Logo</th>
                <th> Action </th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse ($data->data as $item)
                <tr>
                    <td align="center"> {{ $loop->iteration }} </td>
                    <td align="center"> {{ $item->nama_bank }} </td>
                    <td align="center"> {{ $item->nama_pemilik }} </td>
                    <td align="center"> {{ $item->nomor_rekening }} </td>
                    <td align="center"> <img src="{{ $item->icon }}" class="img-thumbnail" width="100px"> </td>
                    <td align="center">
                        <a href="{{ url('edit_bank_account/'.$item->id) }}" class="btn btn-sm btn-rounded btn-primary"><i class="fas fa-edit"></i></a>
                        <a href="{{ url('edit_bank_account/'.$item->id.'/delete') }}" class="btn btn-sm btn-rounded btn-danger"
                            onclick="return confirm('Are you sure want to delete this Banks?');"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" align="center"> No Records Found. </td>
                </tr>
            @endforelse
        </tbody>
    </table>


</div>
