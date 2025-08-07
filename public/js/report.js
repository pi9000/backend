// global default variable
var date_range = $('.date_range').val();
var filter_date_start;
var filter_date_end;
var category = $('.category_selector').find(":selected").val();
var provider = $('.provider_selector').find(":selected").val();
var market   = $('.market_selector').val();
var report_view = $('.report_view_selector').find(":selected").val();
var sorted_by = $('#sorted_by').find(":selected").val();
var player_remark=$('#player_remark').find(":selected").val();
var filter_by = $('#filter_by').find(":selected").val();
var filter_field = $('#filter_field').val();



//var global_link           = `{{ $global_link }}`;
//var currency              = "{{ $currency }}";
var _token = $('meta[name=csrf-token]').attr('content');

var _selected_agent_id = "";
var _selected_affiliate = "";
var _selected_agent_type_id = "";
var _global_provider_id = "";
var _bool_simple_view = false;
var _connection = $('.connection_selector').find(":selected").val();


// set global variable
$('.date_range').change(function() {
    date_range = $('.date_range').val();
    _updateDateFormat();
});

// for daily report calender
$('.daily_date_range').change(function() {
    date_range = $('.daily_date_range').val();
    _updateDateFormat();
});

$('.category_selector').change(function() {
    category = $("option:selected", this).val();

    var provider_selected_option = $('.provider_selector option:selected').val();

    if(category == 9 && provider_selected_option == "KING4D TOGEL"){

      $('.market_filter').show()
      market = $('.market_selector option:selected').val();
    }else{
      $('.market_filter').hide()
    }
});

$('.provider_selector').change(function() {
    provider = $("option:selected", this).val();

    var category_selected_option = $('.category_selector option:selected').val();

    if(category_selected_option == 9 && provider == "KING4D TOGEL"){

      $('.market_filter').show()
      market = $('.market_selector option:selected').val();
    }else{
      $('.market_filter').hide()
    }
});

$('.market_selector').change(function() {
    market = $("option:selected", this).val();
});

$('.report_view_selector').change(function() {
    report_view = $("option:selected", this).val();
});

$(`#sorted_by`).change(function () {
    sorted_by = $(" option:selected ", this).val();

});

$(`#player_remark`).change(function () {
    player_remark = $(" option:selected ", this).val();
});


$('#filter_by').change(function () {
    var option = $(this).val();
    if (option == '0') {
        $('#filter_field').val('')
    }
    if(option == '0'){
        $("#filter_by_div").css("display","none");
    } else {
        $("#filter_by_div").css("display","block");
    }
    filter_by = $('#filter_by').val();
})

// to highlight selected player report table row
$('.winlose_data_result').on('click', '.check_player_report', function() {
    $('.table_data_row').removeClass('light_yellow_back')
    $(this).closest( "td" ).closest( "tr" ).addClass('light_yellow_back')
});

// to highlight selected player bet details table row
$('.player_game_table').on('click', '.check_player_bet_details', function() {

    $('.table_report_data_row').removeClass('light_yellow_back')
    $(this).closest( "td" ).closest( "tr" ).addClass('light_yellow_back')
});


function _updateDateFormat(){
  var new_          = date_range.split(' - ');
  var date_from     = new_[0];
  var date_to       = new_[1];
  date_to = new Date(date_to);
  date_to.setDate(date_to.getDate() + 1);
  mm = date_to.getMonth() + 1;
  filter_date_start = date_from;
  filter_date_end   = ((mm)<10?('0'+mm):mm)+'/'+date_to.getDate()+'/'+date_to.getFullYear();
//   filter_date_end   = date_to;

}

// calender date setup
$(document).ready(function() {
    $('.date_range').daterangepicker({
        autoApply: true,
        startDate: moment().subtract(12, 'hours'),
        endDate: moment().subtract(12, 'hours'),

        // minDate: moment().startOf('month').subtract(3, 'months').format('MM/DD/YYYY 00:00:00'),
        maxDate:moment().format('MM/DD/YYYY 23:59:59'),

        ranges: {
            'Today': [moment().subtract(12, 'hours'), moment().subtract(12, 'hours')],
            'Yesterday': [moment().subtract(1, 'days').subtract(12, 'hours'), moment().subtract(1, 'days').subtract(12, 'hours')],
            'Last 7 Days': [moment().subtract(6, 'days').subtract(12, 'hours'), moment().subtract(12, 'hours')],
            'Last 30 Days': [moment().subtract(29, 'days').subtract(12, 'hours'), moment().subtract(12, 'hours')],
            'This Month': [moment().startOf('month'), moment().endOf('month').subtract(12, 'hours')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month').subtract(12, 'hours')]

        }
    }, function (start, end, label) {


            data.date = start.format('YYYY-MM-DD');
            data.date_end = end.format('YYYY-MM-DD');

            $('#paginator').find('a').removeClass('dp-selected'); //the blue highlight makes it confusing

        });


    // date selector for daily report
    $('.daily_date_range').daterangepicker({
        autoApply: true,
        startDate: moment().subtract(6, 'days').subtract(12, 'hours'),
        endDate: moment().subtract(12, 'hours'),
        // maxDate: moment().subtract(12, 'hours'),

        minDate: moment().startOf('month').subtract(3, 'months').format('MM/DD/YYYY 00:00:00'),
        maxDate:moment().format('MM/DD/YYYY 23:59:59'),

        ranges: {
           // 'Today': [moment().subtract(12, 'hours'), moment().subtract(12, 'hours')],
           // 'Yesterday': [moment().subtract(1, 'days').subtract(12, 'hours'), moment().subtract(1, 'days').subtract(12, 'hours')],
           'Last 7 Days': [moment().subtract(6, 'days').subtract(12, 'hours'), moment().subtract(1, 'days')],
           'Last 30 Days': [moment().subtract(29, 'days').subtract(12, 'hours'), moment().subtract(1, 'days')],
           'This Month': [moment().startOf('month'), moment().endOf('month').subtract(12, 'hours')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month').subtract(12, 'hours')]
        }
    } , function (start, end, label) {


        data.date = start.format('YYYY-MM-DD');
        data.date_end = end.format('YYYY-MM-DD');

        $('#paginator').find('a').removeClass('dp-selected'); //the blue highlight makes it confusing

    });

    });

$(document).ready(function() {

    // mute & unmute button
    function muteButton() {
        $('.search_mini_loader').show();
        $('.agent_code_downline_winlose').addClass('disabled');
        $('.agent_code_downline_winlose_new').addClass('disabled');
        $('.affliate_downline_winlose').addClass('disabled');
        $('.game_code_downline_winlose').addClass('disabled');
        $('.agent_code_downline_simple_winlose').addClass('disabled');
		$('.daily_downline_check').addClass('disabled');
        $('.win_lose_search').attr('disabled', 'disabled');
		$('.bet_search').attr('disabled', 'disabled');
		$('.settlement_search').attr('disabled', 'disabled');
        $('.win_lose_summary_search').attr('disabled', 'disabled');
        $('.win_lose_search_new').attr('disabled', 'disabled');
        $('.win_lose_summary_search_new').attr('disabled', 'disabled');
        $('.win_lose_by_game_search').attr('disabled', 'disabled');
        $('.win_lose_simple_search').attr('disabled', 'disabled');
        $('.daily_report_search').attr('disabled', 'disabled');

    }

    function unmuteButton() {
        $('.search_mini_loader').hide();
        $('.agent_code_downline_winlose').removeClass('disabled');
        $('.agent_code_downline_winlose_new').removeClass('disabled');
        $('.affliate_downline_winlose').addClass('disabled');
        $('.game_code_downline_winlose').removeClass('disabled');
        $('.agent_code_downline_simple_winlose').removeClass('disabled');
		$('.daily_downline_check').removeClass('disabled');
        $('.win_lose_search').removeAttr('disabled');
		$('.bet_search').removeAttr('disabled');
		$('.settlement_search').removeAttr('disabled');
        $('.win_lose_summary_search').removeAttr('disabled');
        $('.win_lose_search_new').removeAttr('disabled');
        $('.win_lose_summary_search_new').removeAttr('disabled');
        $('.win_lose_by_game_search').removeAttr('disabled');
        $('.win_lose_simple_search').removeAttr('disabled');
        $('.daily_report_search').removeAttr('disabled');

    }

    // category and provider selector
    generateProviderList();

    $('.category_selector').change(function() {
        $('.provider_selector').html('<option> loading </option>');
        $('.mini_loader').show();
        generateProviderList();
    });

    function generateProviderList(){
      $.get("/get_provider_list/" + category, function(d) {
          if (d.length > 0) {
              $('.provider_selector').html(function() {
                  let html = '<option value="0"> All Providers </option>';
                   html += '<option value="TTG-Booming"> TTG-Booming </option>';
                   html += '<option value="FASTRADE"> FASTRADE </option>';
                  $.each(d, function(index, value) {
                      var game_brand = d[index]["game_brand"];
                      html += `<option value="${game_brand.replace(' ',' ')}">${game_brand}</option>`;
                  });
                  $('.mini_loader').hide();
                  return html;
              });
          } else {
              $('.provider_selector').html('<option value="0"> All Providers </option>')
              $('.mini_loader').hide();
          }
      });
    }

    // daily report
    function _get_daily_report(data) {
        $.get("/get_daily_report?" + data, function(d) {
            unmuteButton()
            $('.daily_data_result').html(d);
        });
    }

    $('.daily_report_search').click(function() {
		var connection    = $('.connection_selector').val();
        let data = {
            filter_date_start: filter_date_start,
            filter_date_end: filter_date_end,
			_connection: connection,
        };
        muteButton()
        _get_daily_report($.param(data));
    })

    // daily report
    function _get_daily_report_new(data) {
        $.get("/get_daily_report_new?" + data, function(d) {
            unmuteButton()
            $('.daily_data_result').html(d);
        });
    }

    $('.daily_report_search_new').click(function() {
		var connection    = $('.connection_selector').val();
        let data = {
            filter_date_start: filter_date_start,
            filter_date_end: filter_date_end,
			_connection: connection,
        };
        muteButton()
        _get_daily_report_new($.param(data));
    })

	$('.daily_downline_check').click(function(){
		var agent_id = $(this).attr('data-agent-id');
		var agent_type_id = $(this).attr('data-agent-type-id');
		var agent_main_id = $(this).attr('data-agent-main-id');
		var connection    = $('.connection_selector').val();
		let data = {
            filter_date_start: filter_date_start,
            filter_date_end: filter_date_end,
			_selected_agent_id:agent_id,
			_selected_agent_type_id:agent_type_id,
			_connection: connection,
        };
		_get_daily_report($.param(data));
	})

    // promotion report
    function _get_promotion_report(data) {
        $.get("/get_promotion?" + data, function(d) {
            $('.promotion_data_result').html(d);
        });
    }

    $('#promotion_search').click(function() {
        let data = {
            filter_date_start: filter_date_start,
            filter_date_end: filter_date_end,
            aff_value : $('#aff_type').val(),
            type : $('#type').val()
        };

        _get_promotion_report($.param(data));
    })

    // winlose report
    $('.category_selector').val(0);
    $('.provider_selector').html('<option value="0"> All Providers </option>');
    $('.report_view_selector').val(0);

    function getWinloseData() {
        var fd = new FormData();
        filter_field = $('#filter_field').val();

        // for winlose by game, noted: winlose by game also will call this function after clicked on a game at first page
        if (typeof $('.provider_selector').find(":selected").val() === "undefined") {
            var provider_id = _global_provider_id;
        } else {
            var provider_id = $('.provider_selector').find(":selected").val();
        }

        console.log(category);

        fd.append("filter_date_start", filter_date_start);
        fd.append("filter_date_end", filter_date_end);
        fd.append("category", category);
        fd.append("provider", provider_id);
        fd.append("player_remark", player_remark);
        fd.append("market", market);
        fd.append("report_view", report_view);
        fd.append("sorted_by", sorted_by);
        fd.append("filter_by", filter_by);
        fd.append("filter_field", filter_field);
        fd.append("_selected_agent_id", _selected_agent_id);
        fd.append("_selected_agent_type_id", _selected_agent_type_id);
        fd.append("_selected_affiliate", _selected_affiliate);
        fd.append("_bool_simple_view", _bool_simple_view);
        fd.append("_connection", _connection); // for company account

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/get_winlose_data',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                unmuteButton();
                // $('.winlose_data_result').html(data);
                setTimeout(() => {
                    $('.winlose_data_result').html(data);
                }, 5000);
            },
            error: function(data) {
                console.log("Error: ", data);
                console.log("Errors->", data.errors);
            }
        });
    }

	function getSettlementData() {
        var fd = new FormData();

		$('.settlement_data_result').html("");

        // for winlose by game, noted: winlose by game also will call this function after clicked on a game at first page
        if (typeof $('.provider_selector').find(":selected").val() === "undefined") {
            var provider_id = _global_provider_id;
        } else {
            var provider_id = $('.provider_selector').find(":selected").val();
        }

        console.log(category);

        fd.append("filter_date_start", filter_date_start);
        fd.append("filter_date_end", filter_date_end);
        fd.append("category", category);
        fd.append("provider", provider_id);
		fd.append("_selected_agent_id", $('.agent_selector').find(":selected").val());
		fd.append("_connection", $('.connection_selector').find(":selected").val());



        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/get_settlement_data',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                unmuteButton();
                $('.settlement_data_result').html(data);
            },
            error: function(data) {
                console.log("Error: ", data);
                console.log("Errors->", data.errors);
            }
        });
    }


	function getBetData() {
        var fd = new FormData();

		$('.bet_data_result').html("");

        // for winlose by game, noted: winlose by game also will call this function after clicked on a game at first page
        if (typeof $('.provider_selector').find(":selected").val() === "undefined") {
            var provider_id = _global_provider_id;
        } else {
            var provider_id = $('.provider_selector').find(":selected").val();
        }

        console.log(category);

        fd.append("filter_date_start", filter_date_start);
        fd.append("filter_date_end", filter_date_end);
        fd.append("category", category);
        fd.append("provider", provider_id);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/get_bet_data',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                unmuteButton();
                $('.bet_data_result').html(data);
            },
            error: function(data) {
                console.log("Error: ", data);
                console.log("Errors->", data.errors);
            }
        });
    }


    $('.winlose_data_result').on('click', '.agent_code_downline_winlose', function() {
        var selected_agent = $(this).attr('id');
        var explode = selected_agent.split("_");
        _selected_agent_id = explode[0];
        _selected_affiliate = 0;
        _selected_agent_type_id = explode[1];
        category = $(this).attr('data-category');

        report_view = $('.report_view_selector').find(":selected").val()
        muteButton();
        getWinloseData();
    });



    $('.content_title_panel').on('click', '.agent_code_downline_winlose', function() {
        var selected_agent = $(this).attr('id');
        var explode = selected_agent.split("_");
        _selected_agent_id = explode[0];
        _selected_affiliate = 0;
        _selected_agent_type_id = explode[1];
        report_view = $('.report_view_selector').find(":selected").val()
        category = $(this).attr('data-category');
        muteButton();
        getWinloseData();
    });

    $('.winlose_data_result').on('click', '.affliate_downline_winlose', function() {
        var selected_agent = $(this).attr('id');
        var explode = selected_agent.split("_");
        _selected_agent_id = explode[0];
        _selected_affiliate = explode[1];
        _selected_agent_type_id = 15;
        report_view = 0;
        muteButton();
        getWinloseData();
    });

    $('.content_title_panel').on('click', '.affliate_downline_winlose', function() {
        var selected_agent = $(this).attr('id');
        var explode = selected_agent.split("_");
        _selected_agent_id = explode[0];
        _selected_affiliate = explode[1];
        _selected_agent_type_id = 15;
        muteButton();
        getWinloseData();
    });

    $('.win_lose_search').click(function() {
        _bool_simple_view = false;
        filter_field = $('#filter_field').val();

        if ((filter_by == 1 && filter_field == "") ) {
            swal({
                text: "Please enter a valid Ref ID.",
                icon: "error",
                allowOutsideClick: false,
                button: "Okay",
            });
        } else if ((provider == 0 || provider == "") && report_view == 1) {
            swal({
                text: "Please select at least one Provider to view All member(s) report.",
                icon: "error",
                allowOutsideClick: false,
                closeOnClickOutside: false,
                button: "Okay",
            });

        } else {
            muteButton();
            getWinloseData();
        }
    });

	 $('.bet_search').click(function() {
        muteButton();
        getBetData();
    });

	$('.settlement_search').click(function() {
        muteButton();
        getSettlementData();
    });

    $('.win_lose_search_new').click(function() {
        _bool_simple_view = false;
        var provider = $('.provider_selector').find(":selected").val();
        filter_field = $('#filter_field').val();

        if ((filter_by == 1 && filter_field == "") ) {
            swal({
                text: "Please enter a valid Ref ID.",
                icon: "error",
                allowOutsideClick: false,
                button: "Okay",
            });
        } else if ((provider == "") && report_view == 1) {
            swal({
                text: "Please select at least one Provider to view All member(s) report.",
                icon: "error",
                allowOutsideClick: false,
                closeOnClickOutside: false,
                button: "Okay",
            });

        } else {
            muteButton();
            getWinloseData_new();
        }
    });

    // win lose by games
    function getWinloseByGameData() {
        var fd = new FormData();

        fd.append("filter_date_start", filter_date_start);
        fd.append("filter_date_end", filter_date_end);
        fd.append("category", $('.category_selector').find(":selected").val());
        fd.append("provider", $('.provider_selector').find(":selected").val());
        fd.append("report_view", $('.report_view_selector').find(":selected").val());
        fd.append("_selected_agent_id", _selected_agent_id);
        fd.append("_selected_agent_type_id", _selected_agent_type_id);
        fd.append("_connection", _connection); // for company account
        muteButton();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/get_win_lose_by_game',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                unmuteButton();
                $('.winlose_data_result').html(data);
            },
            error: function(data) {
                console.log("Error: ", data);
                console.log("Errors->", data.errors);
            }
        });
    }

    $('.win_lose_by_game_search').click(function() {
        _bool_simple_view = false;
        _connection = $('.connection_selector').find(":selected").val();
        muteButton();
        getWinloseByGameData();
        // if ((data.provider == "") && data.report_view == 1) {
        //     swal({
        //         text: "Please select at least one Provider to view all members report.",
        //         icon: "error",
        //         allowOutsideClick: false,
        //         closeOnClickOutside: false,
        //         button: "Okay",
        //     });
        //
        // } else {
        //     console.log(data.game);
        //     console.log(data.provider);
        //     console.log(data.report_view);
        //     $("#loading-image").show();
        //     getWinloseTable();
        // }
    });


    $('.winlose_data_result').on('click', '.game_code_downline_winlose', function() {
        var category_id = $(this).attr('data-category');
        _global_provider_id = $(this).attr('data-provider');
        filter_field = $('#filter_field').val();
        muteButton();
        var fd = new FormData();

        fd.append("filter_date_start", filter_date_start);
        fd.append("filter_date_end", filter_date_end);
        fd.append("category", category_id);
        fd.append("provider", _global_provider_id);
        fd.append("report_view", $('.report_view_selector').find(":selected").val());
        fd.append("sorted_by", sorted_by);
        fd.append("filter_by", filter_by);
        fd.append("filter_field", filter_field);
        fd.append("_selected_agent_id", _selected_agent_id);
        fd.append("_selected_agent_type_id", _selected_agent_type_id);
        fd.append("_connection", _connection); // for company account

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/get_winlose_data',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                unmuteButton();
                $('.winlose_data_result').html(data);
            },
            error: function(data) {
                console.log("Error: ", data);
                console.log("Errors->", data.errors);
            }
        });
    })


    // winlose lose_simple
    $('.win_lose_simple_search').click(function() {
        _bool_simple_view = true;
        if ((provider == 0 || provider == "") && report_view == 1) {
            swal({
                text: "Please select at least one Provider to view All member(s) report.",
                icon: "error",
                allowOutsideClick: false,
                closeOnClickOutside: false,
                button: "Okay",
            });

        } else {
            muteButton();
            getWinloseData();
        }
    });

    $('.winlose_data_result').on('click', '.agent_code_downline_simple_winlose', function() {
        _bool_simple_view = true;
        var selected_agent = $(this).attr('id');
        var explode = selected_agent.split("_");
        _selected_agent_id = explode[0];
        _selected_agent_type_id = explode[1];
        muteButton();
        getWinloseData();
    })

    // summary report
    $('.win_lose_summary_search').click(function() {
        _bool_simple_view = false;
        _connection = $('.connection_selector').find(":selected").val();

        if ((provider == 0 || provider == "") && report_view == 1) {
            swal({
                text: "Please select at least one Provider to view All member(s) report.",
                icon: "error",
                allowOutsideClick: false,
                closeOnClickOutside: false,
                button: "Okay",
            });

        } else {
            muteButton();
            getWinloseData();
        }

    });

    function getWinloseData_new() {
        var fd = new FormData();
        filter_field = $('#filter_field').val();
        
        // for winlose by game, noted: winlose by game also will call this function after clicked on a game at first page
        if (typeof $('.provider_selector').find(":selected").val() === "undefined") {
            var provider_id = _global_provider_id;
        } else {
            var provider_id = $('.provider_selector').find(":selected").val();
        }

        fd.append("filter_date_start", filter_date_start);
        fd.append("filter_date_end", filter_date_end);
        fd.append("category", category);
        fd.append("provider", provider_id);
        fd.append("player_remark", player_remark);
        fd.append("market", market);
        fd.append("report_view", report_view);
        fd.append("sorted_by", sorted_by);
        fd.append("filter_by", filter_by);
        fd.append("filter_field", filter_field);
        fd.append("_selected_agent_id", _selected_agent_id);
        fd.append("_selected_agent_type_id", _selected_agent_type_id);
        fd.append("_selected_affiliate", _selected_affiliate);
        fd.append("_bool_simple_view", _bool_simple_view);
        fd.append("_connection", _connection); // for company account

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/get_winlose_data_new',
            data: fd,
            processData: false,
            contentType: false,
            success: function(data) {
                unmuteButton();
                $('.winlose_data_result').html(data);
            },
            error: function(data) {
                console.log("Error: ", data);
                console.log("Errors->", data.errors);
            }
        });
    }

    $('.winlose_data_result').on('click', '.agent_code_downline_winlose_new', function() {
        var selected_agent = $(this).attr('id');
        var explode = selected_agent.split("_");
        _selected_agent_id = explode[0];
        _selected_affiliate = 0;
        _selected_agent_type_id = explode[1];
        category = $(this).attr('data-category');

        report_view = $('.report_view_selector').find(":selected").val()
        muteButton();
        getWinloseData_new();
    });

    $('.content_title_panel').on('click', '.agent_code_downline_winlose_new', function() {
        var selected_agent = $(this).attr('id');
        var explode = selected_agent.split("_");
        _selected_agent_id = explode[0];
        _selected_affiliate = 0;
        _selected_agent_type_id = explode[1];
        report_view = $('.report_view_selector').find(":selected").val()
        category = $(this).attr('data-category');
        muteButton();
        getWinloseData_new();
    });

    $('.win_lose_summary_search_new').click(function() {
        _bool_simple_view = false;
        _connection = $('.connection_selector').find(":selected").val();

        if ((provider == 0 || provider == "") && report_view == 1) {
            swal({
                text: "Please select at least one Provider to view All member(s) report.",
                icon: "error",
                allowOutsideClick: false,
                closeOnClickOutside: false,
                button: "Okay",
            });

        } else {
            muteButton();
            getWinloseData_new();
        }

    });



});
