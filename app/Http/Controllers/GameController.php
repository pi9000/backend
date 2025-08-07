<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('page.tools.games.index');
    }

    public function index_table()
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
        ];
        $data = curl_post('games/call_players', $params, auth()->user()->brand_id);
        return $data;
    }

    public function call_list(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'providerCode' => $request->providerCode,
            'gameCode' => $request->gameCode,
        ];
        $data = curl_post('games/call_list', $params, auth()->user()->brand_id);
        return response()->json($data);
    }

    public function call_apply(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'providerCode' => $request->providerCode,
            'gameCode' => $request->gameCode,
            'callRtp' => $request->callRtp,
            'callWin' => $request->callWin,
            'callType' => $request->callType,
            'userCode' => $request->userCode,
        ];
        $data = curl_post('games/call_apply', $params, auth()->user()->brand_id);
        return response()->json($data);
    }

    public function call_rtp(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'providerCode' => $request->providerCode,
            'gameCode' => $request->gameCode,
            'rtp' => $request->rtp,
            'userCode' => $request->userCode,
        ];
        $data = curl_post('games/call_rtp', $params, auth()->user()->brand_id);
        return response()->json($data);
    }
}
