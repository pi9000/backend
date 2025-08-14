<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::namespace('Home')->middleware(['auth', 'verify'])->group(function () {
    Route::get('dashboard', 'HomeController@dashboard')->name('index');
    Route::get('action_logs', 'HomeController@action_logs')->name('action_logs');
    Route::post('action_logs', 'HomeController@getLogs')->name('getLogs');

    /** TUTORIALS */
    Route::get('img_upload_guide', 'HomeController@img_upload_guide')->name('img_upload_guide');
    Route::get('domain_activattion_guide', 'HomeController@domain_activattion_guide')->name('domain_activattion_guide');
    Route::get('commission_rebate_settings', 'HomeController@commission_rebate_settings')->name('commission_rebate_settings');
    Route::get('winlose_rebate_guide', 'HomeController@winlose_rebate_guide')->name('winlose_rebate_guide');
    /** END TUTORIALS */
});

Route::namespace('Member')->middleware(['auth', 'verify'])->group(function () {
    Route::get('new_member', 'MemberController@index')->name('member')->middleware('permission:sub_sidebar.Member Mgmt.New Member');
    Route::get('member_details/{id}', 'MemberController@member_detail')->name('member_detail')->middleware('permission:sub_sidebar.Member Mgmt.Account List');
    Route::get('account_listing', 'MemberController@account_listing')->name('account_listing')->middleware('permission:sub_sidebar.Member Mgmt.Account List');
    Route::get('account_password_edit', 'MemberController@account_password_edit')->name('account_password_edit')->middleware('permission:sub_sidebar.Member Mgmt.New Member');

    Route::post('member_details/details', 'MemberController@member_details')->name('member_details')->middleware('permission:sub_sidebar.Member Mgmt.Account List');
    Route::post('member_details/balance_spin_settings', 'MemberController@balance_spin_settings')->name('balance_spin_settings')->middleware('permission:sub_sidebar.Member Mgmt.Account List');
    Route::post('member_details/balance_settings', 'MemberController@balance_settings')->name('member_balance_settings')->middleware('permission:sub_sidebar.Member Mgmt.Account List');
    Route::post('member_details/bank_transaction_history', 'MemberController@bank_transaction_history')->name('bank_transaction_history')->middleware('permission:sub_sidebar.Member Mgmt.Account List');
    Route::post('getTransactionHistory/{id}', 'MemberController@transaction_history')->name('transaction_history')->middleware('permission:sub_sidebar.Member Mgmt.Account List');
    Route::post('member_details/game_statement', 'MemberController@game_statement')->name('game_statement')->middleware('permission:sub_sidebar.Member Mgmt.Account List');
    Route::post('account_password_edit', 'MemberController@account_password_edit_post')->name('account_password_edit_post')->middleware('permission:sub_sidebar.Member Mgmt.New Member');
    Route::post('member_details/get_balance_info', 'MemberController@get_balance_info')->name('get_balance_info')->middleware('permission:sub_sidebar.Member Mgmt.Account List');
    Route::post('update_provider', 'MemberController@update_provider')->name('update_provider')->middleware('permission:sub_sidebar.Member Mgmt.New Member');
    Route::post('update_bank_user', 'MemberController@update_bank')->name('update_bank_user')->middleware('permission:sub_sidebar.Member Mgmt.New Member');
    Route::post('update_account_data', 'MemberController@update_account_data')->name('update_account_data')->middleware('permission:sub_sidebar.Member Mgmt.New Member');
    Route::post('update_account_remark', 'MemberController@update_account_remark')->name('update_account_remark')->middleware('permission:sub_sidebar.Member Mgmt.New Member');
    Route::post('account_listing', 'MemberController@account_listing_post')->name('account_listing_post')->middleware('permission:sub_sidebar.Member Mgmt.New Member');
    Route::post('update_account_listing', 'MemberController@update_account_listing')->name('update_account_listing')->middleware('permission:sub_sidebar.Member Mgmt.New Member');
    Route::post('new_member', 'MemberController@new_member')->name('new_member')->middleware('permission:sub_sidebar.Member Mgmt.New Member');
});


Route::namespace('Website')->middleware(['auth', 'verify'])->prefix('Website')->group(function () {

    Route::controller('WebSettingController')->group(function () {
        Route::get('WebSetting', 'index')->name('web_setting')->middleware('permission:sub_sidebar.Website.Web Settings');

        Route::get('DomainSettings', 'domainSettings')->name('web_setting_domain')->middleware('permission:sub_sidebar.Website.Domain Settings');
        Route::get('cloudflare_list/{agent_id}', 'cloudflareList')->name('web_setting_cloudflare_list')->middleware('permission:sub_sidebar.Website.Domain Settings');
        Route::post('cloudflare_create', 'add_domain')->name('web_setting_cloudflare_listadd_domain')->middleware('permission:sub_sidebar.Website.Domain Settings');
        Route::post('cloudflare_list/remove_domain/{id}', 'remove_domain')->name('web_setting_cloudflare_listremove_domain')->middleware('permission:sub_sidebar.Website.Domain Settings');

        Route::post('cloudflare_list/status', 'bulkStatusCloudflare')->name('bulkStatusCloudflare')->middleware('permission:sub_sidebar.Website.Domain Settings');
        Route::post('WebSetting/Update', 'edit_website')->name('edit_website')->middleware('permission:sub_sidebar.Website.Web Settings');
        Route::post('WebSetting/UpdateApi', 'edit_api')->name('edit_api')->middleware('permission:sub_sidebar.Website.Web Settings');

        Route::get('SlidingBanner', 'sliding_banner')->name('sliding_banner')->middleware('permission:sub_sidebar.Website.Sliding Banner Settings');
        Route::get('SlidingBanner/{id}/delete', 'sliding_banner_delete')->name('sliding_banner_delete')->middleware('permission:sub_sidebar.Website.Sliding Banner Settings');
        Route::post('SlidingBanner/Create', 'sliding_banner_post')->name('sliding_banner_post')->middleware('permission:sub_sidebar.Website.Sliding Banner Settings');
    });
});


Route::controller('ReportController')->middleware(['auth', 'verify'])->group(function () {
    Route::get('summary_report', 'summary')->name('summary_report')->middleware('permission:sub_sidebar.Report.Running Report');
    Route::get('get_summary_report', 'get_summary_report')->name('get_summary_report')->middleware('permission:sub_sidebar.Report.Running Report');

    Route::get('member_summary', 'member_summary')->name('member_summary')->middleware('permission:sub_sidebar.Report.Daily Report');
    Route::get('get_member_summary', 'get_member_summary')->name('get_member_summary')->middleware('permission:sub_sidebar.Report.Daily Report');
});

Route::controller('PromotionController')->middleware(['auth', 'verify'])->group(function () {
    Route::get('agent_promo_settings', 'index')->name('agent_promo_settings')->middleware('permission:sub_sidebar.Tools.Promotion Settings');
    Route::get('agent_promo_settings/create', 'create')->name('agent_promo_settings_create')->middleware('permission:sub_sidebar.Tools.Promotion Settings');
    Route::get('agent_promo_settings/edit', 'edit')->name('agent_promo_settings_edit')->middleware('permission:sub_sidebar.Tools.Promotion Settings');

    Route::post('agent_promo_settings/delete/{id}', 'delete')->name('agent_promo_settings_delete')->middleware('permission:sub_sidebar.Tools.Promotion Settings');
    Route::post('agent_promo_settings/create_post', 'create_post')->name('agent_promo_settings_creates')->middleware('permission:sub_sidebar.Tools.Promotion Settings');
});

Route::controller('AdminController')->middleware(['auth', 'verify'])->group(function () {
    Route::get('alias_account', 'index')->name('alias_account')->middleware('permission:sub_sidebar.Tools.Admin Accounts');
    Route::get('alias_account_listing', 'listing')->name('alias_account_listing')->middleware('permission:sub_sidebar.Tools.Admin Accounts');
    Route::get('new_admin', 'new')->name('new_admin')->middleware('permission:sub_sidebar.Tools.New Admin');
    Route::get('agent_credit_logs', 'credit_logs')->name('credit_logs')->middleware('permission:sub_sidebar.Tools.New Admin');
    Route::get('checkusername', 'checkusername')->middleware('permission:sub_sidebar.Tools.New Admin');
    Route::get('login_history/{id}', 'login_history')->middleware('permission:sub_sidebar.Tools.Admin Accounts');
    Route::get('edit_admin/{id}', 'edit')->name('edit_admin')->middleware('permission:sub_sidebar.Tools.New Admin');
    Route::get('remove_alias/{id}', 'delete_admin')->name('delete_admin')->middleware('permission:sub_sidebar.Tools.New Admin');
    Route::get('suspend_alias/{id}', 'suspend_admin')->name('suspend_admin')->middleware('permission:sub_sidebar.Tools.New Admin');

    Route::post('new_admin_post', 'create_admin')->middleware('permission:sub_sidebar.Tools.New Admin');
    Route::post('balance_settings', 'balance_settings')->middleware('permission:sub_sidebar.Tools.Admin Balance');
    Route::post('reset_pin/{id}', 'reset_pin')->middleware('permission:sub_sidebar.Tools.New Admin');
    Route::post('reset_password/{id}', 'reset_password')->middleware('permission:sub_sidebar.Tools.New Admin');
    Route::post('edit_admin_post/{id}', 'edit_admin_post')->middleware('permission:sub_sidebar.Tools.New Admin');
});

Route::controller('TransactionController')->middleware(['auth', 'verify'])->group(function () {
    Route::get('transactions/transaction', 'index')->name('transactions.index')->middleware('permission:sub_sidebar.Transactions.Transaction');
    Route::get('transactions/view_receipt', 'view_receipt')->name('transactions.view_receipt')->middleware('permission:sub_sidebar.Transactions.Transaction');
    Route::get('transactions/instant_transaction/rejects/{id}', 'instant_transaction_reject')->name('transactions.instant_transaction_reject')->middleware('permission:chkbox_rejecttrans');
    Route::any('transactions/instant_transaction/reject/{id}', 'instant_transaction_reject_action')->name('transactions.instant_transaction_reject_action')->middleware('permission:chkbox_rejecttrans');
    Route::any('transactions/instant_transaction/confirm/{id}', 'instant_transaction_approve')->name('transactions.instant_transaction_approve')->middleware('permission:chkbox_apptrans');
    // Route::get('transactions/instant_transaction/multi_reject_form', 'multi_reject_form')->name('transactions.multi_reject_form')->middleware('permission:sub_sidebar.chkbox_rejecttrans');
    // Route::get('transactions/instant_transaction/multi_confirm', 'multi_confirm')->name('transactions.multi_reject_form')->middleware('permission:chkbox_apptrans');
    Route::get('transactions/instant_transaction/{id}', 'transaction_details')->name('transactions.transaction_details')->middleware('permission:sub_sidebar.Transactions.Transaction');

    Route::any('transactions/transaction_new_record_ajax', 'transaction_new_record_ajax')->name('transactions.getTransactionHistory')->middleware('permission:sub_sidebar.Transactions.Transaction');
    Route::get('transactions/transaction_record', 'transaction_record')->name('transactions.transaction_record')->middleware('permission:sub_sidebar.Transactions.Transaction Old Record');
    Route::post('transactions/transaction_record_ajax', 'transaction_record_ajax')->name('transactions.transaction_record_ajax')->middleware('permission:sub_sidebar.Transactions.Transaction Old Record');
});

Route::controller('BanksController')->middleware(['auth', 'verify'])->group(function () {
    Route::get('agent_banks', 'index')->name('banks.index')->middleware('permission:sub_sidebar.Banking.Fund Method Listing');
    Route::get('new_bank_account', 'new')->name('banks.new_bank_account')->middleware('permission:sub_sidebar.Banking.Fund Method Listing');
    Route::get('edit_bank_account/{id}', 'edit')->name('banks.edit_bank_account')->middleware('permission:sub_sidebar.Banking.Fund Method Listing');
    Route::get('edit_bank_account/{id}/delete', 'delete')->name('banks.delete_bank_account')->middleware('permission:sub_sidebar.Banking.Fund Method Listing');
    Route::get('agent_bank_accounts_table', 'bank_listing')->name('banks.bank_listing')->middleware('permission:sub_sidebar.Banking.Fund Method Listing');

    Route::post('submit_bank_account/{id}', 'submit_edit')->name('banks.submit_edit')->middleware('permission:sub_sidebar.Banking.Fund Method Listing');
    Route::post('save_bank_account', 'save_bank_account')->name('banks.save_bank_account')->middleware('permission:sub_sidebar.Banking.Fund Method Listing');
});

Route::controller('GameController')->middleware(['auth', 'verify'])->group(function () {
    Route::get('game_control', 'index')->name('game.index');
    Route::get('game_control_table_ajax', 'index_table')->name('game.table');
    Route::get('game_control/call_list', 'call_list')->name('game.call_list');
    Route::get('game_control/call_apply', 'call_apply')->name('game.call_apply');
    Route::get('game_control/control_rtp', 'call_rtp')->name('game.call_rtp');
});

Route::controller('MasterController')->middleware(['auth', 'verify'])->group(function () {
    Route::get('brand_management', 'index')->name('brand.index');
    Route::get('brand_management/{id}', 'brand_management')->name('brand.management');
    Route::get('brand_management/{id}/delete', 'delete_brand')->name('brand.delete_brand');

    Route::post('brand_management/create', 'create_brand')->name('brand.create_brand');

    Route::get('account_management', 'account_management')->name('account_management');
    Route::get('account_management_table', 'account_management_table')->name('account_management_table');

    Route::get('game_providers', 'game_providers')->name('game_providers');
    Route::get('game_providers_table/{id}', 'game_providers_table')->name('game_providers_table');
    Route::post('game_providers_table/{id}/update', 'game_providers_update')->name('game_providers_update');

    Route::get('game_providers/game_list_management', 'game_list_management')->name('game_list_management');
    Route::post('game_list_management/{id}/update', 'game_list_management_update')->name('game_list_management_update');
});

Route::controller('LuckySpinController')->middleware(['auth', 'verify'])->group(function () {
    Route::get('luckyspin_settings', 'index')->name('luckyspin_settings');
    Route::post('luckyspin_settings_update', 'post_index')->name('luckyspin_settings_update');

    Route::get('luckyspin_prize_settings', 'prize_index')->name('luckyspin_prize_settings');
    Route::get('luckyspin_prize_settings/create', 'prize_create')->name('luckyspin_prize_settings.create');
    Route::get('luckyspin_update', 'prize_delete')->name('prize_delete');

    Route::post('luckyspin_settings_create', 'prize_create_new')->name('prize_delete');
});

Route::middleware(['auth', 'verify'])->group(function () {
    Route::get('myprofile', 'ProfileController@myprofile')->name('myprofile');
});

Route::get('captcha', 'CaptchaController@generateCaptcha')->name('captcha');
