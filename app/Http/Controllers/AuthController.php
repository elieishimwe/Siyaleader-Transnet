<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
       	$getusernam   =   \Input::get('cellphone'); 
		$getpassword  =   \Input::get('passwords');
        $response     =   array () ; 
        if ($getusernam== null && $getpassword == null  )

		{
			
			
		  $response ['msg']    = "Autentication Faild";
		  $response['error']   = TRUE;
		  return Response()->json($response) ;
		 
		}
		else  
		{	
	      $user   =   User::select ('cellphone'  , 'password' )
	     ->where('cellphone', '='  , $getusernam)
	     ->first() ;  
		  if(sizeof($user) > 0)
	      {
		 //  after   this  now   we  can  insert  value  to  our DB 
         $response ['msg']= "OK" ; 
         $response['error']   = False;		 
         return Response()->json($response) ;
			 
		  }
	
       
		 
		 
	     }
    	
       
		
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
        //
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
