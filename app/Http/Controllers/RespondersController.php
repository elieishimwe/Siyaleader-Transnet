<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CaseResponder;

class RespondersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
    public function storeSubSubResponder(Request $request)
    {

        $sub_sub_cat = $request['subsubCategoryID'];
        $result = CaseResponder::where('sub_sub_category','=',$sub_sub_cat)->first();

        if($result)
        {
            $result->firstResponder   = $request['firstResponder'];
            $result->secondResponder  = $request['secondResponder'];
            $result->thirdResponder   = $request['thirdResponder'];
            $result->save();
            \Session::flash('success','Responders have been successfully added!');
            return redirect()->back();



        }
        else {

            $responder                   = new CaseResponder();
            $responder->department       = $request['deptID'];
            $responder->category         = $request['catID'];
            $responder->sub_category     = $request['subCatID'];
            $responder->sub_sub_category = $request['subsubCategoryID'];
            $responder->firstResponder   = $request['firstResponder'];
            $responder->secondResponder  = $request['secondResponder'];
            $responder->thirdResponder   = $request['thirdResponder'];
            $responder->active           = 1;
            $responder->save();

        \Session::flash('success','Responders have been successfully added!');
        return redirect()->back();




        }

    }


      public function storeSubResponder(Request $request)
    {

        $sub_cat = $request['subCatID'];
        $result  = CaseResponder::where('sub_category','=',$sub_cat)
                                ->where('sub_sub_category','=',0)
                                ->first();

        if($result)
        {
            $result->firstResponder   = $request['firstResponder'];
            $result->secondResponder  = $request['secondResponder'];
            $result->thirdResponder   = $request['thirdResponder'];
            $result->save();
            \Session::flash('success','Responders have been successfully added!');
            return redirect()->back();



        }
        else {

            $responder                   = new CaseResponder();
            $responder->department       = $request['deptID'];
            $responder->category         = $request['catID'];
            $responder->sub_category     = $request['subCatID'];
            $responder->firstResponder   = $request['firstResponder'];
            $responder->secondResponder  = $request['secondResponder'];
            $responder->thirdResponder   = $request['thirdResponder'];
            $responder->active           = 1;
            $responder->save();

        \Session::flash('success','Responders have been successfully added!');
        return redirect()->back();




        }

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

    public function subResponder($id)
    {

        $responders = \DB::table('responders')
            ->where('responders.sub_category','=',$id)
            ->select(\DB::raw(
                                "

                                responders.id as id,
                                (select CONCAT(users.name, ' ',users.surname) from users where responders.firstResponder = users.id) as firstResponder,
                                (select CONCAT(users.name, ' ',users.surname) from users where responders.secondResponder = users.id) as secondResponder,
                                (select CONCAT(users.name, ' ',users.surname) from users where responders.thirdResponder = users.id) as thirdResponder

                                "
                            )

                    )
            ->first();
        return [$responders];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function subSubResponder($id)
    {

        $responders = \DB::table('responders')
            ->where('responders.sub_sub_category','=',$id)
            ->select(\DB::raw(
                                "

                                responders.id as id,
                                (select CONCAT(users.name, ' ',users.surname) from users where responders.firstResponder = users.id) as firstResponder,
                                (select CONCAT(users.name, ' ',users.surname) from users where responders.secondResponder = users.id) as secondResponder,
                                (select CONCAT(users.name, ' ',users.surname) from users where responders.thirdResponder = users.id) as thirdResponder

                                "
                            )

                    )
            ->first();
        return [$responders];
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
