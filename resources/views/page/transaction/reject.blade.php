<form action="{{ url('transactions/instant_transaction/reject/' . $id) }}" id='reject_form' method="post">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Reject Transaction</h4>
            <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <!-- modal body starts here-->
        <div class="modal-body">
            <!-- new row-->
            <div class="row">
                <div class="col-md-12">
                    @csrf
                    <input type="hidden" name="view_redirect" value="deposit">
                    <input type="hidden" name="amount" value="{{ request()->amount }}">
                    <input type="hidden" name="type" value="{{ request()->type }}">
                    Are you sure wan to reject this transaction?
                    <br>
                    <div>
                        <i class="text-danger">
                        </i>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-xs " onclick="hideModal()"
                data-dismiss="modal">Close</button>
            <input type="submit" name="rejectDeposit" class="btn btn-danger btn-xs " value="REJECT">
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {

        reurl = "{{ url('transactions/transaction_new_record_ajax') }}";
        redata = $('#searchtransaction').serialize();
        window.pause = true;

        function reject(e) {
            e.preventDefault();
            console.log('chec');
            let data = $(this).serialize();
            $.post($(this).attr('action'), data, function(d) {
                // console.log('subi', d);
                // hideModal();
                window.pause = false;
                $('#reject_form .close').click();
                toastMessage(d.s, d.m, '#ff6849', d.s);
                if (window.trans_ajax) {} else {
                    window.trans_ajax = $.ajax({
                        url: reurl + '?' + redata,
                        success: function(d) {
                            $('#load_tweets').html(d);
                            window.reload_trans = setTimeout(() => {
                                // if(!window.pause) {
                                reloadtransaction();
                                // }
                            }, 30000);
                            window.trans_ajax = undefined;
                        }
                    });
                }
                window.processed = (($('#__instant').html() == '' ? 0 : $('#__instant').html()) - 1);

                // $('#load_tweets').load('new_instanttransaction/ajax').fadeIn("slow");
                //  reloadtransaction();

            });
        }
        $('#reject_form').on('submit', reject);
        $('.modal').off('hidden.bs.modal');
        $('.modal').off('hide.bs.modal');
        $('.modal').on('hide.bs.modal', function() {
            $('#reject_form').off('submit', reject);
        })
        $('.modal').on('hidden.bs.modal', function() {
            $('.modal-special .modal-content').html('');
            reloadtransaction();
            window.pause = false;

        })
    })
</script>
