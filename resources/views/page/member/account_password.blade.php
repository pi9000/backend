<style>
    .custom_input_icon {
        position: absolute;
        right: 1px;
        top: 1px;
        background-color: #ededed;
        padding: 3px;
    }

    .icon-eye.slash:after {
        position: absolute;
        width: 10px;
        height: 2px;
        background-color: #5a5a5a;
        content: "";
        right: 4px;
        transform: rotate(-45deg);
        top: 10px;
    }
</style>
<div class="modal-header">
    <h4 class="modal-title">
        Edit Password:
    </h4>
    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">x</span>
    </button>
</div>
<div class="modal-body">
    <form action="account_password_edit" id="summary-submit" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
        <input type="hidden" name="agent_id" value="{{ $agent_id }}">
        <input type="hidden" name="user_name" value="{{ $user_name }}">
        <div class="row my-3">
            <div class="col-sm-8 offset-sm-2 text-center">
                <small>Change password</small>
                <div class="input-group">
                    <input type="password" id="chg_password_{{ $agent_id }}" name="player_password" class="w-100"
                        title="change password">
                    <span class="custom_input_icon"><i class="icon-eye toggle-password"
                            input_id="#chg_password_{{ $agent_id }}"></i></span>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="pass btn btn-success">Submit</button>

        </div>
    </form>
</div>
<script>
    /*password hide and show*/
    $(".toggle-password").click(function() {
        $(this).toggleClass("slash");
        var input = $($(this).attr("input_id"));
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
        return false;

    });
    /*end*/
    $(document).ready(function() {

        $('#summary-submit').submit(function(e) {
            e.preventDefault();
            $('button[type="submit"].pass').attr('disabled', true)

            if (!confirm('Confirm to change the password?')) {
                $('button[type="submit"]').attr('disabled', false)
                return false;
            }
            let data = $(this).serialize();

            $.post($(this).attr('action'), data, function(d, c, x) {
                //console.log(d);
                hideModal();
                if (d.s == 'success') {
                    toastMessage(d.t, d.m, '#ff6849', d.s);
                } else {
                    toastMessage('Something Went Wrong', 'Please Login Again', '#ff6849',
                        'error');
                }
            });
        })
    });
</script>
