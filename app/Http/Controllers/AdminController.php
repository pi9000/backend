<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reset;
use App\Mail\ResetPasswordManual;
use App\Models\CreditLog;

class AdminController extends Controller
{
    public function index()
    {
        return view('page.tools.admin.index');
    }

    public function new()
    {
        return view('page.tools.admin.new');
    }

    public function listing()
    {
        $agent = Admin::where('agent_id', auth()->user()->agent_id)->where('agent_code', '!=', auth()->user()->agent_id)->get();
        return view('page.tools.admin.listing', compact('agent'));
    }

    public function checkusername(Request $request)
    {
        $username = $request->user_name;
        $exists = Admin::where('username', $username)->exists();
        return response($exists ? "false" : "true");
    }

    public function create_admin(Request $request)
    {
        $user = new Admin();
        $user->agent_id    = auth()->user()->agent_id;
        $user->agent_code    = auth()->user()->agent_id . strtoupper(Str::random(5));
        $user->fullname    = $request->first_name;
        $user->username    = $request->pre_name . $request->user_name;
        $user->email    = $request->email;
        $user->password    = Hash::make($request->pwd);
        $user->secure_pin = Hash::make($request->secpwd);
        $user->balance    = 0;
        $user->currency    = auth()->user()->currency;
        $user->status    = 1;
        $user->brand_id    = auth()->user()->brand_id;
        $user->created_by    = auth()->user()->username;
        $permissions = collect($request->except([
            '_token',
            '_method',
            'user_name',
            'mu',
            'pre_name',
            'pwd',
            'pwd_com',
            'email',
            'first_name',
            'secpwd',
            'alias_otp_toggle',
        ]));

        $parsedPermissions = $permissions->map(function ($value) {
            if ($value === 'on') return true;
            if ($value === 'off') return false;
            return $value;
        });

        if ($request->has('sub_sidebar')) {
            $parsedPermissions['sub_sidebar'] = $request->sub_sidebar;
        }

        $user->permissions = $parsedPermissions;
        $user->save();
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Create Admin', 'Agent Create Admin: [ ' . $user->username . ' ]', $request->ip());
        return response()->json([
            's' => 'success',
            't' => 'Create success',
            'm' => 'Admin created'
        ]);
    }

    public function edit_admin_post(Request $request)
    {
        $user = Admin::findOrFail($request->id);
        $user->fullname    = $request->first_name;
        $user->email    = $request->email;
        $permissions = collect($request->except([
            '_token',
            '_method',
            'user_name',
            'mu',
            'pre_name',
            'pwd',
            'pwd_com',
            'email',
            'first_name',
            'secpwd',
            'alias_otp_toggle',
        ]));

        $parsedPermissions = $permissions->map(function ($value) {
            if ($value === 'on') return true;
            if ($value === 'off') return false;
            return $value;
        });

        if ($request->has('sub_sidebar')) {
            $parsedPermissions['sub_sidebar'] = $request->sub_sidebar;
        }

        $user->permissions = $parsedPermissions;
        $user->save();
        logActivity(auth()->user()->username, auth()->user()->agent_id, 'Edit Admin', 'Agent Edit Admin: [ ' . $user->username . ' ]', $request->ip());
        return response()->json([
            's' => 'success',
            't' => 'Edit success',
            'm' => 'Admin updated'
        ]);
    }

    public function delete_admin($id, Request $request)
    {
        $admin = Admin::findOrFail($id);
        if ($admin) {
            logActivity(auth()->user()->username, auth()->user()->agent_id, 'Delete Admin', 'Agent Delete Admin: [ ' . $admin->username . ' ]', $request->ip());
            $admin->delete();
            return response()->json([
                's' => 'success',
                't' => 'Delete success',
                'm' => 'Admin deleted'
            ]);
        }
        return response()->json([
            's' => 'error',
            't' => 'Delete failed',
            'm' => 'Admin not found'
        ]);
    }

    public function suspend_admin($id, Request $request)
    {
        $admin = Admin::findOrFail($id);
        if ($admin) {
            if ($request->s == 1) {
                logActivity(auth()->user()->username, auth()->user()->agent_id, 'Suspend Admin', 'Agent Suspend Admin: [ ' . $admin->username . ' ]', $request->ip());
            } else {
                logActivity(auth()->user()->username, auth()->user()->agent_id, 'Activate Admin', 'Agent Activate Admin: [ ' . $admin->username . ' ]', $request->ip());
            }
            $admin->status = $request->s;
            $admin->save();
            return response()->json([
                's' => 'success',
                't' => 'Suspend success',
                'm' => 'Admin suspended'
            ]);
        }
        return response()->json([
            's' => 'error',
            't' => 'Suspend failed',
            'm' => 'Admin not found'
        ]);
    }

    public function reset_password(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin) {
            logActivity(auth()->user()->username, auth()->user()->agent_id, 'Reset Password', 'Agent Reset Password for Admin: [ ' . $admin->username . ' ]', $request->ip());
            $password = Str::random(10);
            $admin->password = Hash::make($password);
            $admin->save();
            Mail::to($admin->email)->send(new ResetPasswordManual($password, env('MAIL_FROM_ADDRESS'), setting()->brand_name));
            return response()->json([
                's' => 'success',
                't' => 'Password reset success',
                'm' => 'Admin password updated'
            ]);
        }
        return response()->json([
            's' => 'error',
            't' => 'Password reset failed',
            'm' => 'Admin not found'
        ]);
    }

    public function reset_pin(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin) {
            logActivity(auth()->user()->username, auth()->user()->agent_id, 'Reset PIN', 'Agent Reset PIN for Admin: [ ' . $admin->username . ' ]', $request->ip());
            $code = rand(100000, 999999);
            $admin->secure_pin = Hash::make($code);
            $admin->save();
            Mail::to($admin->email)->send(new Reset($code, env('MAIL_FROM_ADDRESS'), setting()->brand_name));
            return response()->json([
                's' => 'success',
                't' => 'PIN reset success',
                'm' => 'Admin secure PIN updated'
            ]);
        }
        return response()->json([
            's' => 'error',
            't' => 'PIN reset failed',
            'm' => 'Admin not found'
        ]);
    }

    public function login_history($id)
    {
        $admin = Admin::findOrFail($id);
        $loginHistory = $admin->loginHistory()->orderBy('created_at', 'desc')->get();
        return view('page.tools.admin.login_history', compact('admin', 'loginHistory'));
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin not found');
        }
        return view('page.tools.admin.edit', compact('admin'));
    }

    public function balance_settings(Request $request)
    {
        $admin = Admin::findOrFail($request->id);
        $user = Admin::find(auth()->user()->id);
        if ($admin) {
            if ($request->type == 1) {
                if ($request->amount > $user->balance) {
                    return redirect()->back()->with('error', 'Your balance insufficient to update admin balance');
                }
                $admin->balance = $admin->balance + $request->amount;
                $user->balance = $user->balance - $request->amount;
                $user->save();
                $admin->save();

                $transaction = new CreditLog();
                $transaction->agent_code = $user->agent_code;
                $transaction->agent_id = $user->agent_id;
                $transaction->username = $user->username;
                $transaction->transaction_id = Str::random(10);
                $transaction->transaction_type = 'Credit';
                $transaction->credit = $request->amount;
                $transaction->balance = $admin->balance;
                $transaction->note = 'Agent Deposit Balance: [ ' . $admin->username . ' Amount : ' . $request->amount . ' ]';
                $transaction->save();

                $transaction2 = new CreditLog();
                $transaction2->agent_code = auth()->user()->agent_code;
                $transaction2->agent_id = auth()->user()->agent_id;
                $transaction2->username = auth()->user()->username;
                $transaction2->transaction_id = Str::random(10);
                $transaction2->transaction_type = 'Debit';
                $transaction2->debit = $request->amount;
                $transaction2->balance = $user->balance;
                $transaction2->note = 'Agent Transfer Balance: [ ' . $admin->username . ' Amount : ' . $request->amount . ' ]';
                $transaction2->save();

                logActivity(auth()->user()->username, auth()->user()->agent_id, 'Update Admin Balance', 'Agent Deposit Balance for Admin: [ ' . $admin->username . ' Amount : ' . $request->amount . ' ]', $request->ip());
                return redirect()->back()->with('success', 'Admin balance update successfully');
            } else {
                if ($request->amount > $admin->balance) {
                    return redirect()->back()->with('error', 'Admin balance insufficient to withdraw');
                }
                $admin->balance = $admin->balance - $request->amount;
                $admin->save();
                $user->balance = $user->balance + $request->amount;
                $user->save();

                $transaction = new CreditLog();
                $transaction->agent_code = $user->agent_code;
                $transaction->agent_id = $user->agent_id;
                $transaction->username = $user->username;
                $transaction->transaction_id = Str::random(10);
                $transaction->transaction_type = 'Debit';
                $transaction->debit = $request->amount;
                $transaction->balance = $admin->balance;
                $transaction->note = 'Agent Withdraw Balance: [ ' . $admin->username . ' Amount : ' . $request->amount . ' ]';
                $transaction->save();

                $transaction2 = new CreditLog();
                $transaction2->agent_code = auth()->user()->agent_code;
                $transaction2->agent_id = auth()->user()->agent_id;
                $transaction2->username = auth()->user()->username;
                $transaction2->transaction_id = Str::random(10);
                $transaction2->transaction_type = 'Credit';
                $transaction2->credit = $request->amount;
                $transaction2->balance = $user->balance;
                $transaction2->note = 'Agent Withdraw Balance: [ ' . $admin->username . ' Amount : ' . $request->amount . ' ]';
                $transaction2->save();

                logActivity(auth()->user()->username, auth()->user()->agent_id, 'Reset Admin Balance', 'Agent Reset Balance for Admin: [ ' . $admin->username . ' Amount : ' . $request->amount . ' ]', $request->ip());
                return redirect()->back()->with('success', 'Admin balance update successfully');
            }
        }
        return redirect()->back()->with('error', 'Admin not found');
    }

    public function credit_logs()
    {
        if (auth()->user()->agent_id == auth()->user()->agent_code) {
            $logs = CreditLog::where('agent_id', auth()->user()->agent_id)->orderBy('created_at', 'desc')->get();
        } else {
            $logs = CreditLog::where('agent_code', auth()->user()->agent_code)->orderBy('created_at', 'desc')->get();
        }
        return view('page.tools.admin.credit_log', compact('logs'));
    }
}
