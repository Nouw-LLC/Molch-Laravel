<?php

namespace App\Http\Controllers;

use App\User;
use Chatkit\Laravel\Facades\Chatkit;
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

        $chatkitUser = Chatkit::getUser(['id' => (string)$user->id]);

        dd($chatkitUser);

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

}
