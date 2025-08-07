<div class="modal-dialog modal-dialog-centered">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header bordered">
            <h4 class="modal-title">Confirm delete</h4>
            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" role="form" method="POST" action="/agent_promo_settings/delete/{{ request()->id }}" id="slidingBannerForm"
                enctype="multipart/form-data">
                @csrf
                <p>Are you sure to delete this Promotion?</p>
                <small class="text-danger">* You can't recover this data anymore</small>
                <div class="clearfix"></div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Delete</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
