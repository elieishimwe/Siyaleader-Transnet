<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

     private $user;


    public function __construct(User $user)
    {

        $this->user = $user;

    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::select(array('created_at','Fname','Sname','Cell1','Position'));
        return \Datatables::of($users)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(UserRequest $request, User $user)
    {

        $user->Fname        = $request['Fname'];
        $user->Sname        = $request['Sname'];
        $user->Cell1        = $request['Cell1'];
        $user->Email        = $request['Email'];
        $user->Position     = $request['Position'];
        $user->Province     = $request['Province'];
        $user->District     = $request['District'];
        $user->Municipality = $request['Municipality'];
        $user->Department   = $request['Department'];
        $user->Password     = uniqid();
        $user->Status       = 'Active';
        $user->save();
         \Session::flash('success', $request['Fname'].' '.$request['Sname'].' has been added successfully!');


        $data = array(
            'name'     =>$user->Fname,
            'username' =>$user->Cell1,
            'password' =>$user->Password,
        );

        \Mail::send('emails.registrationConfirmation',$data, function($message) use ($user)
        {
            $message->from('info@siyaleader.co.za', 'Siyaleader');
            $message->to($user->Email)->subject("User Registration Confirmation: " .$user->Fname);

        });

        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
