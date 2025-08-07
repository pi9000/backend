<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function summary(Request $request)
    {
        return view('page.report.summary');
    }

    public function get_summary_report(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'start_date' => date('Y-m-d 00:00:00', strtotime($request->filter_date_start)),
            'end_date' => date('Y-m-d 23:59:59', strtotime($request->filter_date_end))
        ];
        $data = curl_post('summary_report', $params, auth()->user()->brand_id);
        if ($data->status != 1) {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.report.get_summary_report', compact('data'));
    }

    public function member_summary(Request $request)
    {
        return view('page.report.member');
    }

    public function get_member_summary(Request $request)
    {
        $params = [
            'agent_id' => auth()->user()->agent_id,
            'start_date' => date('Y-m-d 00:00:00', strtotime($request->filter_date_start)),
            'end_date' => date('Y-m-d 23:59:59', strtotime($request->filter_date_end))
        ];
        $data = curl_post('get_member_summary', $params, auth()->user()->brand_id);
        if ($data->status != 1) {
            return redirect()->back()->with('error', $data->message);
        }
        return view('page.report.member_summary', compact('data'));
    }
}
