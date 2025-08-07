<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CreditLog;
use App\Models\Admin;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        return view('page.transaction.index');
    }

    public function transaction_new_record_ajax(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'username' => $request->search_name,
            'period' => $request->period ? date('Y-m-d H:i:s', strtotime($request->period)) : null,
        ];
        $data = curl_post('transaction/pending', $params, auth()->user()->brand_id);
        return view('page.transaction.transaction_new_record_ajax', compact('data'));
    }

    public function view_receipt(Request $request)
    {
        return view('page.transaction.view_receipt', ['id' => $request->i]);
    }

    public function instant_transaction_reject($id)
    {
        return view('page.transaction.reject', ['id' => $id]);
    }

    public function multi_reject_form(Request $request)
    {
        return view('page.transaction.reject_multi');
    }

    public function transaction_details($id)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('transaction/detail/' . $id, $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.transaction.detail', ['data' => $data->data]);
    }

    public function instant_transaction_approve($id, Request $request)
    {
        $admin = Admin::find(auth()->user()->id);

        if ($request->type == 'Top Up') {
            if ($admin->balance < $request->amount) {
                return redirect()->back()->with('error', 'Insufficient balance to approve this transaction.');
            }

            $admin->balance -= $request->amount;
            $admin->save();

            $transaction = new CreditLog();
            $transaction->agent_code = $admin->agent_code;
            $transaction->agent_id = $admin->agent_id;
            $transaction->username = $admin->username;
            $transaction->transaction_id = Str::random(10);
            $transaction->transaction_type = 'Debit';
            $transaction->credit = $request->amount;
            $transaction->balance = $admin->balance;
            $transaction->note = 'Approve Deposit: [ ' . $id . ' Amount : ' . $request->amount . ' ]';
            $transaction->save();
        } else {

            $admin->balance += $request->amount;
            $admin->save();

            $transaction = new CreditLog();
            $transaction->agent_code = $admin->agent_code;
            $transaction->agent_id = $admin->agent_id;
            $transaction->username = $admin->username;
            $transaction->transaction_id = Str::random(10);
            $transaction->transaction_type = 'Credit';
            $transaction->credit = $request->amount;
            $transaction->balance = $admin->balance;
            $transaction->note = 'Approve Withdraw: [ ' . $id . ' Amount : ' . $request->amount . ' ]';
            $transaction->save();
        }

        $params = [
            'agent_id' => auth()->user()->agent_id,
            'transaction_by' => auth()->user()->username,
        ];
        $data = curl_post('transaction/approve/' . $id, $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Approve Transaction', 'Agent Approve Transaction: [ ' . $id . ' ]', $request->ip());
        return redirect()->route('transactions.index')->with('success', 'Transaction approved successfully.');
    }

    public function instant_transaction_reject_action(Request $request, $id)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'transaction_by' => auth()->user()->username,
        ];
        $data = curl_post('transaction/reject/' . $id, $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Reject Transaction', 'Agent Reject Transaction: [ ' . $id . ' ]', $request->ip());
        return redirect()->route('transactions.index')->with('success', 'Transaction rejected successfully.');
    }

    public function transaction_record(Request $request)
    {
        return view('page.transaction.record.index');
    }

    public function transaction_record_ajax(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'transaction_by' => auth()->user()->username,
            'recordType' => $request->recordType,
            'daterange' => $request->daterange,
            'status' => $request->status,
        ];
        $data = curl_post('transaction/transaction_history', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.transaction.record.ajax', ['data' => $data]);
    }
}
