<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use App\Events\MyEventNameHere;

class MessageController extends Controller
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
    public function read(Request $request)
    {
        $unreadMessages = Message::where('to','=',\Auth::user()->id)
                                    ->where('read','=',0)
                                    ->where('online','=',0)
                                    ->get();

        foreach ($unreadMessages as $unreadMessage) {

            $unreadMessage->read = 1;
            $unreadMessage->save();


        }

        $data =  array (

                'type'    => 'noreadprivatemsg',
                'dest'    => $request['to']

        );

        event(new MyEventNameHere($data));

        return 'ok';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $caseMessage           = new Message();
        $caseMessage->from     = $request['uid'];
        $caseMessage->to       = $request['to'];
        $caseMessage->online   = 0;
        $caseMessage->caseId   = $request['caseID'];
        $caseMessage->message  = $request['msg'];
        $caseMessage->active   = 1;
        $caseMessage->save();

        $data =  array (

                'type'    => 'noUnreadprivatemsg',
                'dest'    => $request['to']

        );

        event(new MyEventNameHere($data));

        return 'ok';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
