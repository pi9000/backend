<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\LogActivity;

class HomeController extends Controller
{
    public function dashboard(Request $request)
    {
        $pageTitle = 'Dashboard';
        $params = [
            'agent_id' => auth()->user()->agent_id
        ];

        $data = curl_post('get_member_total_balance', $params, auth()->user()->brand_id);
        $total_balance_member = $data->total_balance ?? 0;
        return view('page.dashboard.index', compact('pageTitle', 'total_balance_member'));
    }

    public function img_upload_guide(Request $request)
    {
        $pageTitle = 'Image Upload Instructions/Tutorials';
        return view('page.tutorial.img_upload_guide', compact('pageTitle'));
    }

    public function domain_activattion_guide(Request $request)
    {
        $pageTitle = 'DOMAIN ACTIVATION GUIDE';
        return view('page.tutorial.domain_activattion_guide', compact('pageTitle'));
    }

    public function commission_rebate_settings(Request $request)
    {
        $pageTitle = 'How To Set Commission Rebate Settings';
        return view('page.tutorial.commission_rebate_settings', compact('pageTitle'));
    }

    public function winlose_rebate_guide(Request $request)
    {
        $pageTitle = 'HOW TO SET WINLOSE REBATE (CASHBACK)';
        return view('page.tutorial.winlose_rebate_guide', compact('pageTitle'));
    }

    public function action_logs(Request $request)
    {
        $pageTitle = 'Action Log';
        LogActivity::where('status', 0)->update(['status' => 1]);
        return view('page.addtional.action_log', compact('pageTitle'));
    }

    public function getLogs(Request $request)
    {
        $query = LogActivity::where('agent_id', auth()->user()->agent_id)->orderBy('created_at','DESC');
        return DataTables::of($query)
            ->editColumn('created_at', function ($row) {
                return $row->created_at;
            })
            ->make(true);
    }
}
