<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $cases = \DB::table('cases')
            ->join('departments', 'cases.department', '=', 'departments.id')
            ->join('municipalities', 'cases.precinct', '=', 'municipalities.id')
            ->join('users', 'cases.reporter', '=', 'users.id')
            ->join('categories', 'cases.category', '=', 'categories.id')
            ->select(
                        \DB::raw(
                                    "
                                        cases.id,
                                        cases.created_at,
                                        cases.description,
                                        cases.status,
                                        cases.priority,
                                        cases.severity,
                                        departments.name as department,
                                        municipalities.name as precinct,
                                        IF(`cases`.`addressbook` = 1,(SELECT CONCAT(`FirstName`, ' ', `Surname`) FROM `addressbook` WHERE `addressbook`.`id`= `cases`.`reporter`), (SELECT CONCAT(users.`name`, ' ', users.`surname`) FROM `users` WHERE `users`.`id`= `cases`.`reporter`)) as reporter,
                                        categories.name as category
                                    "
                                )
                        )
            ->groupBy('cases.id');

        return \Datatables::of($cases)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}});" data-target=".modalCase">View</a>')
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
        //
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
