<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AddressBookRequest;
use App\Http\Controllers\Controller;
use App\addressbook;

class AddressBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        $addresses = addressbook::select(array('id','FirstName','Surname','cellphone','email'))->where('user','=',$id);
        return \Datatables::of($addresses)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}});" data-target=".modalCase">View</a>'
                                       )
                            ->make(true);
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
    public function store(AddressBookRequest $request)
    {
         $addressbook            = new addressbook();
         $addressbook->FirstName = $request['FirstName'];
         $addressbook->Surname   = $request['Surname'];
         $addressbook->email     = $request['email'];
         $addressbook->cellphone = $request['cellphone'];
         $addressbook->user      = $request['uid'];
         $addressbook->active    = 1;
         $addressbook->save();

        \Session::flash('successAddressBook', $request['FirstName'].' '.$request['Surname'].' has been successfully added!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {

        $searchString = \Input::get('q');
        $contacts     = \DB::table('addressbook')
            ->where('user','=',\Auth::user()->id)
            ->whereRaw("CONCAT(`FirstName`, ' ', `Surname`, ' ', `email`) LIKE '%{$searchString}%'")
            ->select(\DB::raw('*'))
            ->get();

        $data = array();

        if(count($contacts) > 0)
        {

           foreach ($contacts as $contact) {
           $data[]= array("name"=>"{$contact->FirstName} {$contact->Surname} <{$contact->email}","id" =>"{$contact->email}");
           }


        }
        else {

            $contacts     = \DB::table('users')
            ->whereRaw("CONCAT(`name`, ' ', `surname`, ' ', `email`) LIKE '%{$searchString}%'")
            ->select(\DB::raw('*'))
            ->get();

           foreach ($contacts as $contact) {
           $data[] = array("name"=>"{$contact->name} {$contact->surname} <{$contact->username}","id" =>"{$contact->username}");
           }

        }

        return $data;

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
