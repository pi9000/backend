<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = "New Member";
        return view('page.member.new_account', compact('pageTitle'));
    }

    public function account_listing(Request $request)
    {
        $pageTitle = "Account List";
        return view('page.member.account_listing', compact('pageTitle'));
    }

    public function member_detail($id, Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id
        ];
        $data = curl_post('member_details/' . $id, $params, auth()->user()->brand_id);
        if ($data->status != 1) {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.member.details.details', compact('data'));
    }

    public function bank_transaction_history(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id
        ];
        $data = curl_post('member_details/' . $request->player_id, $params, auth()->user()->brand_id);
        if ($data->status != 1) {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.member.details.transaction', compact('data'));
    }

    public function transaction_history($id, Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'daterange' => $request->daterange,
        ];
        $data = curl_post('transaction_history/' . $id, $params, auth()->user()->brand_id);
        if ($data->status != 1) {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.member.details.transaction_list', compact('data'));
    }

    public function member_details(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id
        ];
        $data = curl_post('member_details/' . $request->player_id, $params, auth()->user()->brand_id);
        return view('page.member.details.member_detail', compact('data'));
    }

    public function game_statement(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id
        ];
        $data = curl_post('member_details/' . $request->player_id, $params, auth()->user()->brand_id);
        return view('page.member.details.game_statement', compact('data'));
    }

    public function get_game_statement(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id
        ];
        $data = curl_post('member_details/' . $request->player_id, $params, auth()->user()->brand_id);
        return view('page.member.details.get_game_statement', compact('data'));
    }

    public function get_balance_info(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id
        ];
        $data = curl_post('member_details/' . $request->player_id . '/balance', $params, auth()->user()->brand_id);
        return $data;
    }

    public function update_provider(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'player_id' => $request->player_id,
            'mega888_id' => $request->mega888_id,
            'mega888_password' => $request->mega888_password,
            's918kiss_id' => $request->s918kiss_id,
            's918kiss_password' => $request->s918kiss_password,
            'pussy888_id' => $request->pussy888_id,
            'pussy888_password' => $request->pussy888_password,
        ];
        $data = curl_post('update_provider', $params, auth()->user()->brand_id);
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Update Game APK', 'Agent Update Game APK: [ ' . json_encode($params) . ' ]', $request->ip());
        return $data;
    }

    public function update_bank(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'player_id' => $request->player_id,
            'bankname' => $request->bank_name,
            'accno' => $request->accno,
            'accname' => $request->accname,
        ];
        $data = curl_post('update_bank_user', $params, auth()->user()->brand_id);
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Update Bank', 'Agent Update Bank: [ ' . json_encode($params) . ' ]', $request->ip());
        return $data;
    }

    public function update_account_data(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'player_id' => $request->player_id,
            'account_name' => $request->account_name,
            'mobile' => $request->mobile,
            'old_mobile' => $request->old_mobile,
        ];
        $data = curl_post('update_account_data', $params, auth()->user()->brand_id);
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Update Data', 'Agent Update Data: [ ' . json_encode($params) . ' ]', $request->ip());
        return $data;
    }

    public function update_account_remark(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'player_id' => $request->player_id,
            'remark' => $request->remark,
        ];
        $data = curl_post('update_data_remark', $params, auth()->user()->brand_id);
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Update Data', 'Agent Update Data: [ ' . json_encode($params) . ' ]', $request->ip());
        return $data;
    }

    public function account_listing_post(Request $request)
    {

        $params = [
            'agent_id' => auth()->user()->agent_id,
            'all' => $request->all,
            'form_select' => $request->form_select,
            'created_at' => $request->created_at,
            'user_name' => $request->user_name,
            'player_remark' => $request->player_remark,
            'user_mobile' => $request->user_mobile,
            'user_account_number' => $request->user_account_number,
            'user_bank_name' => $request->user_bank_name,
            'status' => $request->status,
            'rows' => $request->rows,
            'sort_column' => $request->sort_column,
            'sorting' => $request->sorting,
            'page' => $request->page,
        ];

        $data = curl_post('account_listing', $params, auth()->user()->brand_id);
        return view('page.member.account_list', compact('data'));
    }

    public function account_password_edit(Request $request)
    {
        return view('page.member.account_password', [
            'id' => $request->id,
            'agent_id' => $request->agent_id,
            'user_name' => $request->user_name,
        ]);
    }

    public function account_password_edit_post(Request $request)
    {
        $params = [
            'id' => $request->id,
            'agent_id' => $request->agent_id,
            'player_password' => $request->player_password,
        ];

        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Change Password', 'Agent changed password for member ID: ' . $request->user_name, $request->ip());

        $response = curl_post('account_password_edit', $params, auth()->user()->brand_id);
        return response()->json($response);
    }

    public function update_account_listing(Request $request)
    {
        $params = [
            'player_id' => $request->player_id,
            'agent_id' => auth()->user()->agent_id,
            'firstname' => $request->firstname,
            'game_status' => $request->suspend,
            'status' => $request->status,
            'old_mobile_' => $request->old_mobile,
            'mobile' => $request->mobile,
        ];

        $response = curl_post('update_account_listing', $params, auth()->user()->brand_id);
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Update Member', 'Agent Update [' . json_encode($params) . ']', $request->ip());
        return response()->json($response);
    }

    public function new_member(Request $request)
    {
        if ($request->pwd !== $request->pwd_com) {
            return response()->json(['status' => 'error', 'message' => 'Passwords do not match.'], 200);
        }
        $params = [
            'username' => $request->username,
            'agent_id' => auth()->user()->agent_id,
            'password' => $request->pwd_com,
            'phone' => $request->mobile,
            'remark' => $request->remark,
            'verified' => $request->verified,
            'ref_id' => $request->ref_id,
        ];
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Create Member', 'Agent Create [' . json_encode($params) . ']', $request->ip());
        $response = curl_post('new_member', $params, auth()->user()->brand_id);
        return response()->json($response);
    }

        public function balance_settings(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'extplayer' => $request->id,
            'action' => $request->type,
            'amount' => $request->amount,
            'transaction_by' => auth()->user()->username,
        ];
        $response = curl_post('update_balance', $params, auth()->user()->brand_id);
        return redirect()->back()->with($response->status, $response->message);
    }
}
