<?php


namespace App\Http\Controllers;


use App\Report;
use App\User;
use App\Warning;
use Carbon\Carbon;
use Chatkit\Laravel\Facades\Chatkit;
use Illuminate\Http\Request;
use JavaScript;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $profileUser = User::findOrFail($id);

        if ($profileUser->avatar === null) {
            $hr = "border-top: 1px solid rgba(0,0,0,.1)";
        } else {
            $hr = "border-top: 1px solid rgba(255,255,255,0.5)";
        }

        $user = Auth::user();

//        $role = Role::create(['name' => 'Admin']);
//
//        $user->assignRole('admin');

        $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

        JavaScript::put([
            'name' => $user->name,
            'id' => (string)$user->id
        ]);

        return view('user.profile', ['profileUser' => $profileUser, 'hr' => $hr], compact('chats', 'user'));
    }

    public function list()
    {
        $user = Auth::user();

        return view('staff.user.index', compact(['user']));
    }

    public function fetch()
    {
        return User::all();
    }

    public function warn(Request $request)
    {
        $user = User::find($request->id);

        $warn = new Warning();

        $warn->user_id = $user->id;
        $warn->reason = $request->reason;

        $warn->save();

        $user->warning += 1;
        $user->save();

        return response()->json(null,200);
    }

    public function ban(Request $request)
    {
        $user = User::find($request->id);

        $user->banned = Carbon::parse($request->input('date'));
        $user->banned_reason = $request->input('reason');
        $user->save();
    }

    public function info($id)
    {
        $user = User::find($id);

        if ($user->avatar === null) {
            $hr = "border-top: 1px solid rgba(0,0,0,.1)";
        } else {
            $hr = "border-top: 1px solid rgba(255,255,255,0.5)";
        }

        $warnings = Warning::query()->where('user_id', '=', $user->id)->get();

        return view('staff.user.info', ['hr' => $hr], compact('user', 'warnings'));
    }
}
