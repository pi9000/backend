<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('agent_promo_settings', $params, auth()->user()->brand_id);
        if ($data->status != 1) {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.tools.agent_promo_settings.index', compact('data'));
    }

    public function create()
    {
        return view('page.tools.agent_promo_settings.new');
    }

    public function edit(Request $request)
    {
        return view('page.tools.agent_promo_settings.delete');
    }

    public function delete($id, Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'id' => $id,
        ];
        $data = curl_post('agent_promo_settings/delete', $params, auth()->user()->brand_id);
        if ($data->status != 1) {
            return redirect()->back()->with('error', $data->message);
        }
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Delete Promo', 'Agent Delete Promo: [ ' . $id . ' ]', $request->ip());
        return redirect()->back()->with('success', $data->message);
    }

    public function create_post(Request $request)
    {

        $file_name = $request->file('file')->storePublicly(
            'promotion_banners',
            's3',
            'public'
        );

        $params = [
            'agent_id' => auth()->user()->agent_id,
            'judul' => $request->judul,
            'file' => $file_name,
            'deskripsi' => $request->deskripsi,
            'minimal_depo' => $request->minimal_depo,
            'bonus' => $request->bonus,
            'max_bonus' => $request->max_bonus,
            'max_claim' => $request->max_claim,
            'bonus_type' => $request->bonus_type,
            'status' => $request->status,
            'type' => $request->type,
            'sequence' => $request->sequence,
        ];

        $data = curl_post_form('agent_promo_settings/create', $params, auth()->user()->brand_id);
        if ($data->status != 1) {
            return redirect()->back()->with('error', $data->message);
        }
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Create Promo', 'Agent Create Promo: [ ' . $request->judul . ' ]', $request->ip());
        return redirect()->back()->with('success', $data->message);
    }
}
