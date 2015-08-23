<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CaseReport;
use App\CaseOwner;

class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {

        $myCases = CaseOwner::where('user','=',\Auth::user()->id)->get();
        $caseIds = array();

        foreach ($myCases as $case) {
            $caseIds[] = $case->id;
        }

        \Log::info("My cases ".implode(",",$caseIds));



        $cases   = CaseReport::select(array('id','created_at','description','status'))->whereIn('id',$caseIds);
        return \Datatables::of($cases)
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
    public function store(Request $request)
    {

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function escalate(Request $request)
    {

        $addresses = explode(',',$request['addresses']);


        foreach ($addresses as $address) {

            $data = array(

                'content'  => $request['message']
            );

            \Mail::send('emails.caseEscalation',$data, function($message) use ($address)
            {
                $message->from('info@siyaleader.co.za', 'Siyaleader');
                $message->to($address)->subject("Siyaleader Notification - Case escalated: " );

            });

        }

        \Session::flash('success', $request['name'].' has been successfully added!');
        return redirect()->back();

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

        $case = \DB::table('cases')
            ->join('departments', 'cases.department', '=', 'departments.id')
            ->join('categories', 'cases.category', '=', 'categories.id')
            ->join('sub-categories', 'cases.sub_category', '=', 'sub-categories.id')
            ->join('sub-sub-categories', 'cases.sub_sub_category', '=', 'sub-sub-categories.id')
            ->join('users', 'cases.user', '=', 'users.id')
            ->where('cases.id','=',$id)
            ->select(\DB::raw("cases.id, cases.description,cases.status,cases.img_url,CONCAT(users.`name`, ' ', users.`surname`) as reporter,users.email as reporterCell,departments.name as department,categories.name as category,`sub-categories`.name as sub_category,`sub-sub-categories`.name as sub_sub_category "))
            ->get();
        return $case;
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
