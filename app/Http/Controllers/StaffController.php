<?php
/**
 * Copyright (c) 2019.
 *
 * @Author Fabio Dijkshoorn nouw@nouw.xyz
 */

namespace App\Http\Controllers;

use App\Feed;
use App\Report;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $userCount = User::query()->orderBy('id', 'desc')->take(1)->get();

//        $reports = DB::table('feed_reports')->where('processed', 0)->count();

        $reports = Report::query()->where('processed', 0)->count();

        return view('staff.index', compact(['user', 'userCount', 'reports']));
    }
}
