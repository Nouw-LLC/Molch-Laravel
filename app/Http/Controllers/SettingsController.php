<?php

namespace App\Http\Controllers;

use Chatkit\Laravel\Facades\Chatkit;
use JavaScript;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function avatar()
    {
        $user = Auth::user();

        $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

        JavaScript::put([
            'name' => $user->name,
            'id' => (string)$user->id
        ]);


        return view('settings.avatar', compact('chats'));
    }
}
