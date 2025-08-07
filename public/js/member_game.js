var input = "";
var player_id = "";

$(document).ready(function() {

    function muteButton() {
        $('.search_mini_loader').show();
        $('.member_game_search').attr('disabled', 'disabled');
    }

    function unmuteButton() {
        $('.search_mini_loader').hide();
        $('.member_game_search').removeAttr('disabled');
    }

    $('.member_game_search').click(function() {
        input = $('.member_code').val();
        muteButton();
        showMember();
    });

    function showMember() {
        var fd = new FormData();
        fd.append("input", input);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/get_member_list',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                unmuteButton();
                $('.member_game_list').html(data);
            },
            error: function(data) {
                console.log("Error: ", data);
                console.log("Errors->", data.errors);
            }
        });
    }

    $('.member_game_list').on('click', '.member_game_edit', function() {
        player_id = $(this).attr('data-player-id');
        showMemberGames();
    });

    function showMemberGames() {
        var fd = new FormData();
        fd.append("player_id", player_id);
        $('.member_game_table').html("");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/show_member_game_list',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                $('.member_game_table_' + player_id).html(data);
            },
            error: function(data) {
                console.log("Error: ", data);
                console.log("Errors->", data.errors);
            }
        });
    }



});
