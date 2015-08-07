<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\User;
use App\OldUser;
use App\Position;
use App\Province;
use App\District;
use App\Municipality;
use App\Department;


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
        $users = User::select(array('id','created_at','name','surname','cellphone','position','district','municipality'));
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
    public function store(UserRequest $request, User $user,OldUser $oldUser)
    {

        /*  New User Table */
        $user->name         = $request['Fname'];
        $user->surname      = $request['Sname'];
        $user->cellphone    = $request['Cell1'];
        $user->username     = $request['Email'];
        $user->email        = $request['Cell1'];
        $position           = Position::where('slug','=',$request['Position'])->first();
        $user->position     = $position->id;
        $province           = Province::where('slug','=',$request['Province'])->first();
        $user->province     = $province->id;
        $district           = District::where('slug','=',$request['District'])->first();
        $user->district     = $district->id;
        $municipalityIds    = array();
        foreach ($request['Municipality'] as $municipalityName) {
            $municipality      = Municipality::where('slug','=',$municipalityName)->first();
            $municipalityIds[] = $municipality->id;
        }
        $user->municipality = implode(",",$municipalityIds);
        $department         = Department::where('slug','=',$request['Department'])->first();
        $user->department   = $department->id;
        $password           = rand(1000,99999);
        $user->password     = \Hash::make($password);
        $user->api_key      = uniqid();
        $user->status       = 1;
        $user->role         = 2;
        $user->save();

        /*  Old User Table */
        $oldUser->Fname        = $request['Fname'];
        $oldUser->Sname        = $request['Sname'];
        $oldUser->Cell1        = $request['Cell1'];
        $oldUser->Email        = $request['Email'];
        $oldUser->Position     = $request['Position'];
        $oldUser->Province     = $request['Province'];
        $oldUser->District     = $request['District'];
        $oldUser->Municipality = implode(",",$request['Municipality']);
        $oldUser->Department   = $request['Department'];
        $oldUser->Password     = $password;
        $oldUser->api_key      = uniqid();
        $oldUser->Status       = 'Active';
        $oldUser->save();
         \Session::flash('success', $request['Fname'].' '.$request['Sname'].' has been added successfully!');


        $data = array(
            'name'     =>$user->name,
            'username' =>$user->cellphone,
            'password' =>$user->password,
        );

        \Mail::send('emails.registrationConfirmation',$data, function($message) use ($user)
        {
            $message->from('info@siyaleader.co.za', 'Siyaleader');
            $message->to($user->email)->subject("Siyaleader User Registration Confirmation: " .$user->name);

        });

        return redirect('list-user');

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
