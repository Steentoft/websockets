<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\Requests;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
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
        $id = $request->post('id');
        $userId = Auth::User()->id;

        Requests::where('sender', '=', $id)->where('receiver', '=', $userId)->delete();

        Contacts::insert([
            ['user_id' => $id, 'contact_id' => $userId],
            ['user_id' => $userId, 'contact_id' => $id],
        ]);

        return Contacts::with('user')->where('user_id', '=', $userId)->where('contact_id', '=', $id)->get();
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
        $requests = Requests::where('sender', '=', $userId)->select('receiver')->get();
        $contacts = Contacts::where('user_id', '=', $userId)->select('contact_id')->get();
        $ids = $contacts->toBase()->merge($requests->toBase());

        $results = User::where('name', 'like', '%'.$id.'%')->where('id', '!=', $userId)->whereNotIn('id', $ids)->get();

        return $results;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contacts $Contacts
     * @return \Illuminate\Http\Response
     */
    public function edit(Contacts $Contacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = Auth::User()->id;

        Contacts::
        where('user_id', '=', $id)->
        where('contact_id', '=', $userId)->
        Orwhere(function($query) use ($id, $userId) {
            $query->where('user_id', '=', $userId)
                ->where('contact_id', '=', $id);
        })->
        delete();

        return 'contact deleted';
    }
}
