<?php
/**
 * Copyright (c) 2019.
 *
 * @Author Fabio Dijkshoorn nouw@nouw.xyz
 */

namespace App\Http\Controllers;


use App\FeedReport;
use App\Report;
use Illuminate\Support\Facades\Auth;

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
}
