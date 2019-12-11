<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Illuminate\Http\Request;
use Chatkit\Laravel\Facades\Chatkit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use JavaScript;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        $user = Auth::user();
        $participant = User::findOrFail($id);
        $chatkitUser = DB::table('chatkitusers')->where('chatkitId', '=', $user->id)->count();
        $chatkitParticipant = DB::table('chatkitusers')->where('chatkitId', '=', $participant->id)->count();

        if ($chatkitUser === 0) {
            Chatkit::createUser([
                'id' => (string)$user->id,
                'name' => $user->name,
            ]);

            DB::table('chatkitusers')->insert([
                'chatkitId' => $user->id,
                'chatkitName' => $user->name
            ]);
        }

        if ($chatkitParticipant === 0) {
            Chatkit::createUser([
                'id' => (string)$participant->id,
                'name' => $participant->name,
            ]);

            DB::table('chatkitusers')->insert([
                'chatkitId' => $participant->id,
                'chatkitName' => $participant->name
            ]);
        }

        $rooms = Chatkit::getUserRooms([ 'id' => (string)$user->id]);

        foreach($rooms["body"] as $room) {
            if (in_array((string)$user->id, $room["member_user_ids"]) && in_array((string)$participant->id, $room["member_user_ids"])) {
                return back()->with('denied', 'A room already exists with the current selected user!');

            } else {
                Chat::create([
                    'chat_creator' => $user->id,
                    'participants' => [$user->id, (int)$id]
                ]);
                $chat_id = DB::table('chats')->select('id')->orderBy('id', 'desc')->first();
                Chatkit::createRoom([
                    'id' => (string)$chat_id->id,
                    'creator_id' => (string)$user->id,
                    'name' => "'$user->name' and '$participant->name'",
                    'user_ids' => [$id],
                    'private' => true,
                ]);
                return redirect()->route('chat', $chat_id->id);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Chat $chat, $id)
    {
        $user = Auth::user();
        $chat = Chatkit::getRoom(['id' => (string)$id]);
        Chatkit::getRoom(['id' => (string)$id]);

        if ($chat["body"]["member_user_ids"][0] == (string)$user->id OR $chat["body"]["member_user_ids"][1] == (string)$user->id) {
            if ($chat["body"]["member_user_ids"][0] == (string)$user->id) {
                $otherUserId = $chat["body"]["member_user_ids"][1];
            } else {
                $otherUserId = $chat["body"]["member_user_ids"][0];
            }

            $otherUser = User::findOrFail($otherUserId);

            $id_string = (string)$id;

            JavaScript::put([
                'name' => $user->name,
                'id' => (string)$user->id,
                'room_id' => $id_string,
                'otherUser' => $otherUser->name
            ]);

            $messages = Chatkit::fetchMultipartMessages([
                'room_id' => (string)$id,
                'limit' => 100
            ]);
            $position = last($messages['body'])['id'];

            $readCursors = Chatkit::getReadCursorsForRoom([
                'room_id' => $id_string,
            ]);

            foreach ($messages['body'] as $message) {
                    if (!in_array($message['id'], $readCursors)) {
                        Chatkit::setReadCursor([
                            'user_id' => (string)$user->id,
                            'room_id' => $id_string,
                            'position' => $message['id']
                        ]);
                }
            }


            $chats = (object)Chatkit::getUserRooms(['id' => (string)$user->id]);

            return view('chat.chat', compact('chats', 'user'));
        } else {
            abort(403, "You don't have access to this room!");
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
