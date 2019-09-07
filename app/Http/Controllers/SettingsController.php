<?php

namespace App\Http\Controllers;

use App\User;
use Chatkit\Laravel\Facades\Chatkit;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use JavaScript;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
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

    public function index()
    {
        $user = Auth::user();

        $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

        JavaScript::put([
            'name' => $user->name,
            'id' => (string)$user->id
        ]);

        return view('settings.home', compact('chats', 'user'));
    }

    public function avatar(Request $request)
    {

        $user = Auth::user();

        $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

        JavaScript::put([
            'name' => $user->name,
            'id' => (string)$user->id
        ]);

        if ($request->isMethod('post')) {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            $storagePath = Storage::disk('public')->put('avatars', $request->file('avatar'));

            $storageName = basename($storagePath);

            $user->avatar_name = $storageName;
            $user->save();


            Chatkit::updateUser([
                'id' => (string)$user->id,
                'avatar_url' => "https://i-love-my-cat.s-ul.eu/I8mQYCtQ",
            ]);

            return back()
                ->with('success','You have successfully upload image.');

        }

        return view('settings.avatar', compact('chats', 'user'));

    }

    public function username(Request $request)
    {
        $user = Auth::user();

        $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

        JavaScript::put([
            'name' => $user->name,
            'id' => (string)$user->id
        ]);

        if ($request->isMethod('post')) {

            $request->validate([
               'username' => 'required|min:4|max:20|regex:/^[a-zA-Z]+$/u|string',
                'password' => 'required'
            ]);

            if (Hash::check($request->input('password'), $user->getAuthPassword())) {
                if (User::where('name', $request->input('username'))->exists() == false) {
                    $user->name = $request->input('username');

                    $user->save();

                    return response()->json(null,200);
                } else {
                    return response()->json('Username is already taken!',500);

                }
            } else {
                return response()->json('Password is wrong!',500);
            }

        }

        return view('settings.username', compact('chats', 'user'));

    }

    public function email(Request $request)
    {
        $user = Auth::user();

        $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

        JavaScript::put([
            'name' => $user->name,
            'id' => (string)$user->id
        ]);

        if ($request->isMethod('post')) {

            $request->validate([
                'oldemail' => 'required|email',
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if (Hash::check($request->input('password'), $user->getAuthPassword())) {
                if ($user->email == $request->input('oldemail')) {
                    $user->email = $request->input('email');

                    $user->save();

                    return response()->json(null, 200);
                } else {
                    return response()->json('Old Email is wrong!', 500);
                }


            } else {
                return response()->json('Password is wrong!', 500);
            }
        }
        return view('settings.email', compact('chats', 'user'));

    }

    public function password(Request $request)
    {
        $user = Auth::user();

        $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

        JavaScript::put([
            'name' => $user->name,
            'id' => (string)$user->id
        ]);

        if ($request->isMethod('post')) {
            $request->validate([
                'newPassword' => 'required',
                'newPassword2' => 'required',
                'password' => 'required'
            ]);

            if ($request->input('newPassword') == $request->input('newPassword2')) {
                if (Hash::check($request->input('password'), $user->getAuthPassword())) {
                    $user->password = Hash::make($request->input('newPassword'));
                    $user->save();
                    return response()->json(null, 200);
                } else {
                    return response()->json('Current password is wrong!', 500);
                }
            } else {
                return response()->json('Passwords do not match', 500);
            }
        }

        return view('settings.password', compact('chats', 'user'));
    }

    public function status(Request $request)
    {
        $user = Auth::user();

        $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

        JavaScript::put([
            'name' => $user->name,
            'id' => (string)$user->id
        ]);

        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|max:50',
            ]);

            $user->status = $request->input('status');
            $user->save();
        }

        return view('settings.status', compact('chats', 'user'));
    }

    public function bio(Request $request)
    {
        $user = Auth::user();

        $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

        JavaScript::put([
            'name' => $user->name,
            'id' => (string)$user->id
        ]);

        if ($request->isMethod('post')) {
            $request->validate([
                'bio' => 'required|max:2000',
            ]);

            $user->bio = $request->input('bio');
            $user->save();

            return response()->json(null, 200);
        }

        return view('settings.bio', compact('chats', 'user'));
    }

}
