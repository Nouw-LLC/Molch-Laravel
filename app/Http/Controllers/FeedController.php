<?php

namespace App\Http\Controllers;

use App\Feed;
use App\Report;
use App\User;
use App\Award;
use App\Events\FeedMessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FeedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function fetchFeedMsgs()
    {
        return Feed::with('user')->take(100)->get();
    }

    public function sendFeedMsgs(Request $request)
    {
        $user = Auth::user();

        $user_id = $user->id;
        $user_data = User::find($user_id);

        $post_count = $user_data->posts_count;

        $request->validate([
            'message' => 'min:10'
        ]);

        if((int)$post_count == 100) {
            Award::where('user', '=', $user->id)->update(['posts_100' => true]);
        }
        if((int)$post_count == 1000) {
            Award::where('user', '=', $user->id)->update(['posts_1000' => true]);
        }
        if((int)$post_count == 10000) {
            Award::where('user', '=', $user->id)->update(['posts_1000' => true]);
        }

        $data = $request->all();

        //$message = $request->input('message');

        $message = $user->messages()->create([
            'message' => $request->input('message'),
        ]);

        broadcast(new FeedMessageSent($user, $message))->toOthers();

        DB::table('users')->whereId($user->id)->increment('posts_count');



        return ['status' => 'Message Sent!', 'data' => $data, 'user' => $user];
    }

    public function report(Request $request)
    {
        $request->validate([
            'reason' => 'required|min:20',
        ]);

        $user = Auth::user();

        $report = new Report();

        $report->reason = $request->reason;
        $report->reported = $request->user;
        $report->message = $request->reason;
        $report->reporter = $user->id;
        $report->typeOfReport = 1;
        $report->message_id = $request->message;

        $report->save();

        return response()->json(null,200);
    }

}
