<?php


namespace App\Http\Controllers;


use App\User;
use Chatkit\Laravel\Facades\Chatkit;
use JavaScript;
use Illuminate\Support\Facades\Auth;

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

        $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

        JavaScript::put([
            'name' => $user->name,
            'id' => (string)$user->id
        ]);

        return view('user.profile', ['profileUser' => $profileUser, 'hr' => $hr], compact('chats', 'user'));
    }
}
