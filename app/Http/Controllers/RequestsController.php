<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use App\Models\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestsController extends Controller
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

        if(Requests::where('sender', '=', $userId)->where('receiver', '=', $id)->exists())
        {
            return 'Request already sent';
        }else
        {
            Requests::insert([
                ['sender' => $userId, 'receiver' => $id],
            ]);

            return 'Request sent';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function show(Requests $requests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Requests  $requests
     * @return \Illuminate\Http\Response
     */
    public function edit(Requests $requests)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Requests::where('id', '=', $id)->delete();

        return 'request denied';
    }
}
