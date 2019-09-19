<?php
/**
 * Copyright (c) 2019.
 *
 * @Author Fabio Dijkshoorn nouw@nouw.xyz
 */

namespace App\Http\Controllers;


use App\Report;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('staff.report.index', compact(['user']));
    }

    public function fetch()
    {
        return Report::with('user')->where('processed', false)->get();
    }

    public function approve(Request $request)
    {
        $report = Report::find($request->id);
        $user = $report->reported;

        $report->processed = true;

        $report->save();

        return response()->json(null,200);
    }

    public function warn(Request $request)
    {
        $report = Report::find($request->id);
        $user = $report->reported;

        $report->processed = true;

        $report->save();

        $warnUser = User::find($user);

        $warnUser->warning += 1;
        $warnUser->save();

        return response()->json(null,200);
    }

    public function ban(Request $request)
    {
        $report = Report::find($request->id);
        $user = $report->reported;

        $report->processed = true;

        $report->save();

        $warnUser = User::find($user);

        $warnUser->banned = true;
        $warnUser->save();

        return response()->json(null,200);
    }
}
