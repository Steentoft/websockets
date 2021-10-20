<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Models\Messages;
use http\Message\Body;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->post('receiver');
        $message = $request->post('text');
        $userId = Auth::User()->id;

        $result = Messages::create(['sender' => $userId, 'receiver' => $id, 'message' => $message, 'media_link' => null]);

        broadcast(new NewMessage($result))->toOthers();

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::User()->id;
        $messages = Messages::
            where('sender', '=', $id)->
            where('receiver', '=', $userId)->
            Orwhere(function($query) use ($id, $userId) {
                $query->where('sender', '=', $userId)
                      ->where('receiver', '=', $id);
            })->
            orderBy('created_at', 'desc')->
            get();

//        $messages = array_reverse($messages);

        return $messages;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Messages  $Messages
     * @return \Illuminate\Http\Response
     */
    public function edit(Messages $Messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Messages  $Messages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messages $Messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Messages  $Messages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messages $Messages)
    {
        //
    }
}
