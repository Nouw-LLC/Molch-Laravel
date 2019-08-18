<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Chatkit\Laravel\Facades\Chatkit;
use JavaScript;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //        Carbon::parse($date)->timezone(session('timezone'));
//        Chatkit::createUser(['id' => '1', 'name' => 'Nouw']);
        $user = Auth::user();

//        $chatkit_user = Chatkit::getUser(['id' => $user->id]);

//        dd($chatkit_user);

        $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

//        Chatkit::createRoom(['creator_id' => (string)$user->id, 'name' => 'Test']);

//        dd($chats);


//        Javascript::put([ 'user.name' => $user->name, 'user.id' => $user->id ]);

        JavaScript::put([
            'name' => $user->name,
            'id' => (string)$user->id
        ]);


        return view('feed', compact('chats'));
    }
}
