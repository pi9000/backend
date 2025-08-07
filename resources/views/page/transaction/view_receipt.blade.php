<div class="modal-header">
    <h5 class="modal-title">View Receipt</h5>
    <button type="button" class="close float-right" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
    <img src="{{ $id }}" width="100%"
        height="auto" onerror="this.style.display='none';">

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
</div>
<script>
    window.pause = true;
</script>
