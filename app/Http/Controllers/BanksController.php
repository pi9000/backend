<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BanksController extends Controller
{
    public function index()
    {
        return view('page.banks.agent_bank');
    }

    public function bank_listing(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id
        ];

        $data = curl_post('banks/account', $params, auth()->user()->brand_id);
        return view('page.banks.agent_bank_accounts_table', compact('data'));
    }

    public function new(Request $request)
    {
        return view('page.banks.new_bank_account');
    }

    public function edit($id, Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id
        ];

        $data = curl_post('banks/' . $id . '/edit', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.banks.edit_bank_account', compact('data'));
    }

    public function submit_edit($id, Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'nama_bank' => $request->bank_name,
            'nama_pemilik' => $request->bank_acc_name,
            'nomor_rekening' => $request->bank_acc_no
        ];

        $data = curl_post('banks/' . $id . '/update', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect('/agent_banks')->with('error', $data->message);
        }
        return redirect('/agent_banks')->with('success', $data->message);
    }

    public function save_bank_account(Request $request)
    {
        if ($request->hasFile('logo')) {
            $url = $request->file('logo')->storePublicly(
                'bank_logos',
                's3',
            );

            $logo = config('filesystems.disks.s3.url') . $url;
        } else {
            $logo = config('filesystems.disks.s3.url');
        }

        $params = [
            'agent_id' => auth()->user()->agent_id,
            'nama_bank' => $request->bank_name,
            'nama_pemilik' => $request->bank_acc_name,
            'nomor_rekening' => $request->bank_acc_no,
            'icon' => $logo,
        ];

        $data = curl_post('banks/create', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect('/agent_banks')->with('error', $data->message);
        }
        return redirect('/agent_banks')->with('success', $data->message);
    }

    public function delete($id, Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id
        ];

        $data = curl_post('banks/' . $id . '/delete', $params, auth()->user()->brand_id);
        if ($data->status == 'error') {
            return redirect('/agent_banks')->with('error', $data->message);
        }
        return redirect('/agent_banks')->with('success', $data->message);
    }
}
