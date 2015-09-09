<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CaseReport;
use App\CaseOwner;
use App\User;
use App\addressbook;
use App\CaseEscalator;
use App\CaseActivity;
use App\Department;
use App\Municipality;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\CaseResponder;

class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {

        $myCases    = CaseOwner::where('user','=',\Auth::user()->id)
                             ->get();

        $otherCases = CaseReport::where('user','=',\Auth::user()->id)
                             ->get();
        $caseIds    = array();



        foreach ($myCases as $case) {
            $caseIds[] = $case->caseId;
        }

        foreach ($otherCases as $caseOld) {
            $caseIds[] = $caseOld->id;
        }

        $caseIds = array_unique($caseIds);

        $cases = \DB::table('cases')
                ->join('caseOwners', 'cases.id', '=', 'caseOwners.caseId')
                ->whereIn('cases.id',$caseIds)
                ->where('caseOwners.user','=',\Auth::user()->id)
                ->select(\DB::raw("cases.id, cases.created_at,cases.description,cases.status,caseOwners.accept,caseOwners.type"))
                ->groupBy('cases.id');
        return \Datatables::of($cases)
                            ->addColumn('actions','<a class="btn btn-xs btn-alt" data-toggle="modal" onClick="launchCaseModal({{$id}});" data-target=".modalCase">View</a>


                                                   '
                                       )
                            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function acceptCase($id)
    {

         $caseOwnerObj = CaseOwner::where("caseId",'=',$id)
                                   ->where("user",'=',\Auth::user()->id)
                                   ->where("type",'<>',0)
                                   ->first();

         $numberCases   = CaseReport::where('user','=',\Auth::user()->id)->get();


        if (sizeof($caseOwnerObj) > 0)
        {
            $caseOwnerObj->accept = 1;
            $caseOwnerObj->save();
            $caseActivity              = New CaseActivity();
            $caseActivity->caseId      = $id;
            $caseActivity->user        = \Auth::user()->id;
            $caseActivity->addressbook = 0;
            $caseActivity->note        = "Case Accepted by ".\Auth::user()->name.' '.\Auth::user()->surname;
            $caseActivity->save();

            $caseOwners = CaseOwner::where("caseId",'=',$id)
                                     ->where("user","<>",\Auth::user()->id)
                                     ->get();

            foreach ($caseOwners as $owner) {

                if ($owner->addressbook == 1) {

                    $user = AddressBook::find($owner->user);

                }
                else {

                    $user = User::find($owner->user);


                }

                $data = array(
                                    'name'   =>$user->name,
                                    'caseID' =>$id,
                                    'acceptedBy' => \Auth::user()->name.' '.\Auth::user()->surname,
                                );


                \Mail::send('emails.acceptCase',$data, function($message) use ($user)
                {
                    $message->from('info@siyaleader.co.za', 'Siyaleader');
                    $message->to($user->username)->subject("Siyaleader Notification - New Case Accepted: ");

               });

            }

            \Session::flash('successNotes', 'Thank you for accepting Case Number:'.$id);

            return view('home.home',compact('numberCases'));
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function captureCase(Request $request)
    {

        $reporter     = $request['caseReporter'];
        $caseSeverity = $request['caseSeverity'];
        \Log::info($caseSeverity);
        $userObj      = User::where('username','=',$reporter)->first();


        if(sizeof($userObj) <= 0 )
        {
            $userAddressbookObj = addressbook::where('email','=',$reporter)->first();
        }

        $user        = (sizeof($userObj) <= 0)? $userAddressbookObj->id:$userObj->id;
        $addressbook = (sizeof($userObj) <= 0)? 1:0;
        $userName    = (sizeof($userObj) <= 0)? $userAddressbookObj->FirstName:$userObj->name;
        $userSurname = (sizeof($userObj) <= 0)? $userAddressbookObj->Surname:$userObj->surname;
        $userEmail   = (sizeof($userObj) <= 0)? $userAddressbookObj->email:$userObj->username;
        $cell        = (sizeof($userObj) <= 0)? $userAddressbookObj->cellphone:$userObj->email;


       $caseDescription   = $request['caseDescription'];
       $precinctObj       = Municipality::where('slug','=',$request['caseMunicipality'])->first();
       $categoryObj       = Category::where('slug','=',$request['caseCategory'])->first();
       $subCategoryObj    = SubCategory::where('slug','=',$request['caseSubCategory'])->first();

       \Log::info("size".$request['caseSubSubCategory']);
       \Log::info("size".sizeof($request['caseSubSubCategory']));

        if($request['caseSubSubCategory'] > 0)
        {
            $subSubCategoryObj = SubSubCategory::where('slug','=',$request['caseSubSubCategory'])->first();
            $subSubCategory    = $subSubCategoryObj->id;
        }
        else{

            $subSubCategory    = 0;
        }


       $gps                       = explode(",",$request['GPS']);
       $caseObj                   = new CaseReport();
       $caseObj->description      = htmlentities($caseDescription);
       $caseObj->user             = \Auth::user()->id;
       $caseObj->reporter         = $user;
       $caseObj->addressbook      = $addressbook;
       $caseObj->precinct         = $precinctObj->id;
       $caseObj->category         = $categoryObj->id;
       $caseObj->sub_category     = $subCategoryObj->id;
       $caseObj->sub_sub_category = $subSubCategory;
       $caseObj->gps_lat          = $gps[0];
       $caseObj->gps_lng          = $gps[1];
       $caseObj->severity         = $caseSeverity;
       $caseObj->status           = "Pending";
       $caseObj->save();

       $data = array(
                'name'      =>$userName,
                'caseID'    =>$caseObj->id,
                'caseDesc'  =>$caseObj->description
        );


        \Mail::send('emails.sms',$data, function($message) use ($userEmail) {
            $message->from('info@siyaleader.co.za', 'Siyaleader');
            $message->to($userEmail)->subject("Siyaleader Notification - New Case Reported:");

        });

        if ($caseSeverity <= 4) {

               $severityData = array(
                    'severity'  => $caseObj->severity ,
                    'name'      => $userName .' '.$userSurname,
                    'cell'      => $cell,
                    'category'  => $categoryObj->name,
                    'caseId'    => $caseObj->id
                );

                \Mail::send('emails.severity',$severityData, function($message) {

                    $message->from('info@siyaleader.co.za', 'Siyaleader');
                    $message->to('gavin@squeakytakkie.co.za')->subject("SEVERE");

                });

        }


            if ($subSubCategory > 0)
            {
                 $subSubCatResponders = CaseResponder::where('sub_sub_category','=',$subSubCategory)->first();
                \Log::info("subSubCatResponders".sizeof($subSubCatResponders));

                    if (sizeof($subSubCatResponders) > 0)
                    {

                        if($subSubCatResponders->firstResponder)
                        {
                            $firstResponderUser = User::find($subSubCatResponders->firstResponder);
                            $caseOwner         = new CaseOwner();
                            $caseOwner->user   = $subSubCatResponders->firstResponder ;
                            $caseOwner->caseId = $caseObj->id;
                            $caseOwner->type   = 1;
                            $caseOwner->active = 1;
                            $caseOwner->save();

                             $data = array(
                                    'name'   =>$firstResponderUser->name,
                                    'caseID' =>$caseObj->id,
                                    'caseDesc' => $caseObj->description,
                                    'caseReporter' => $caseObj->description,
                                );

                            \Log::info("First Responder".$firstResponderUser);
                            \Mail::send('emails.responder',$data, function($message) use ($firstResponderUser)
                            {
                                $message->from('info@siyaleader.co.za', 'Siyaleader');
                                $message->to($firstResponderUser->username)->subject("Siyaleader Notification - New Case Reported:");

                           });
                        }

                        if($subSubCatResponders->secondResponder)
                        {
                            $secondResponderUser = User::find($subSubCatResponders->secondResponder);
                            $caseOwner         = new CaseOwner();
                            $caseOwner->user   = $subSubCatResponders->secondResponder;
                            $caseOwner->caseId = $caseObj->id;
                            $caseOwner->type   = 2;
                            $caseOwner->active = 1;
                            $caseOwner->save();

                            $data = array(
                                    'name'   =>$secondResponderUser->name,
                                    'caseID' =>$caseObj->id,
                                    'caseDesc' => $caseObj->description,
                                    'caseReporter' => $caseObj->description,
                            );
                            \Log::info("second Responder".$secondResponderUser);

                            \Mail::send('emails.responder',$data, function($message) use ($secondResponderUser)
                            {
                                $message->from('info@siyaleader.co.za', 'Siyaleader');
                                $message->to($secondResponderUser->username)->subject("Siyaleader Notification - New Case Reported:");

                           });
                        }

                        if($subSubCatResponders->thirdResponder)
                        {
                            $thirdResponderUser = User::find($subSubCatResponders->thirdResponder);
                            $caseOwner         = new CaseOwner();
                            $caseOwner->user   = $subSubCatResponders->thirdResponder;
                            $caseOwner->caseId = $caseObj->id;
                            $caseOwner->type   = 3;
                            $caseOwner->active = 1;
                            $caseOwner->save();

                            $data = array(
                                    'name'   =>$thirdResponderUser->name,
                                    'caseID' =>$caseObj->id,
                                    'caseDesc' => $caseObj->description,
                                    'caseReporter' => $caseObj->description,
                            );
                            \Log::info("third Responder".$thirdResponderUser);

                            \Mail::send('emails.responder',$data, function($message) use ($thirdResponderUser)
                            {
                                $message->from('info@siyaleader.co.za', 'Siyaleader');
                                $message->to($thirdResponderUser->username)->subject("Siyaleader Notification - New Case Reported:");

                           });
                        }
                    }
            }


            if ($subSubCategory == 0)
            {



                  $subCatResponders = CaseResponder::where('sub_category','=',$subCategoryObj->id)->first();
                \Log::info("subCatResponders".sizeof($subCatResponders));

                    if (sizeof($subCatResponders) > 0)
                    {

                        if($subCatResponders->firstResponder)
                        {
                            $firstResponderUser = User::find($subCatResponders->firstResponder);
                            $caseOwner         = new CaseOwner();
                            $caseOwner->user   = $subCatResponders->firstResponder ;
                            $caseOwner->caseId = $caseObj->id;
                            $caseOwner->type   = 1;
                            $caseOwner->active = 1;
                            $caseOwner->save();

                             $data = array(
                                    'name'   =>$firstResponderUser->name,
                                    'caseID' =>$caseObj->id,
                                    'caseDesc' => $caseObj->description,
                                    'caseReporter' => $caseObj->description,
                                );

                            \Log::info("First Responder".$firstResponderUser);
                            \Mail::send('emails.responder',$data, function($message) use ($firstResponderUser)
                            {
                                $message->from('info@siyaleader.co.za', 'Siyaleader');
                                $message->to($firstResponderUser->username)->subject("Siyaleader Notification - New Case Reported:");

                           });
                        }

                        if($subCatResponders->secondResponder)
                        {
                            $secondResponderUser = User::find($subCatResponders->secondResponder);
                            $caseOwner         = new CaseOwner();
                            $caseOwner->user   = $subCatResponders->secondResponder;
                            $caseOwner->caseId = $caseObj->id;
                            $caseOwner->type   = 2;
                            $caseOwner->active = 1;
                            $caseOwner->save();

                            $data = array(
                                    'name'   =>$secondResponderUser->name,
                                    'caseID' =>$caseObj->id,
                                    'caseDesc' => $caseObj->description,
                                    'caseReporter' => $caseObj->description,
                            );
                            \Log::info("second Responder".$secondResponderUser);

                            \Mail::send('emails.responder',$data, function($message) use ($secondResponderUser)
                            {
                                $message->from('info@siyaleader.co.za', 'Siyaleader');
                                $message->to($secondResponderUser->username)->subject("Siyaleader Notification - New Case Reported:");

                           });
                        }

                        if($subCatResponders->thirdResponder)
                        {
                            $thirdResponderUser = User::find($subCatResponders->thirdResponder);
                            $caseOwner         = new CaseOwner();
                            $caseOwner->user   = $subCatResponders->thirdResponder;
                            $caseOwner->caseId = $caseObj->id;
                            $caseOwner->type   = 3;
                            $caseOwner->active = 1;
                            $caseOwner->save();

                            $data = array(
                                    'name'   =>$thirdResponderUser->name,
                                    'caseID' =>$caseObj->id,
                                    'caseDesc' => $caseObj->description,
                                    'caseReporter' => $caseObj->description,
                            );
                            \Log::info("third Responder".$thirdResponderUser);

                            \Mail::send('emails.responder',$data, function($message) use ($thirdResponderUser)
                            {
                                $message->from('info@siyaleader.co.za', 'Siyaleader');
                                $message->to($thirdResponderUser->username)->subject("Siyaleader Notification - New Case Reported:");

                           });
                        }
                }











            }

               return redirect()->back();

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function escalate(Request $request)
    {

        $addresses     = explode(',',$request['addresses']);
        $caseOwners    = CaseOwner::where('caseId','=',$request['caseID'])->get();

        foreach ($caseOwners as $caseOwner) {

            $user =  User::find($caseOwner->user);
            $data = array(

                'name'    => $user->name,
                'caseID'  => $request['caseID'],
                'content' => $request['message']
            );


            \Mail::send('emails.caseEscalation',$data, function($message) use ($user)
            {
                $message->from('info@siyaleader.co.za', 'Siyaleader');
                $message->to($user->username)->subject("Siyaleader Notification - Case escalated: " );

            });

        }


        foreach ($addresses as $address) {

            $user = User::where('username','=',$address)->first();

            if(sizeof($user) <= 0 )
            {
                 $userAddressbook = addressbook::where('email','=',$address)->first();
            }

            $name        = (sizeof($user) <= 0)? $userAddressbook->FirstName:$user->name;
            $surname     = (sizeof($user) <= 0)? $userAddressbook->Surname:$user->surname;
            $to          = (sizeof($user) <= 0)? $userAddressbook->id:$user->id;
            $type        = (sizeof($user) <= 0)? 1:0;
            $addressbook = (sizeof($user) <= 0)? 1:0;

            $data = array(
                'name'    => $name,
                'caseID'  => $request['caseID'],
                'content' => $request['message']
            );


            $caseActivity              = New CaseActivity();
            $caseActivity->caseId      = $request['caseID'];
            $caseActivity->user        = $to;
            $caseActivity->addressbook = $addressbook;
            $caseActivity->note        = "Case Escalated to ".$name ." ".$surname." by ".\Auth::user()->name.' '.\Auth::user()->surname;
            $caseActivity->save();


            \Mail::send('emails.caseEscalated',$data, function($message) use ($address)
            {
                $message->from('info@siyaleader.co.za', 'Siyaleader');
                $message->to($address)->subject("Siyaleader Notification - Case escalated: " );

            });

            $caseEscalationObj          = New CaseEscalator();
            $caseEscalationObj->caseId  = $request['caseID'];
            $caseEscalationObj->from    = \Auth::user()->id;
            $caseEscalationObj->to      = $to;
            $caseEscalationObj->type    = $type;
            $caseEscalationObj->message = $request['message'];
            $caseEscalationObj->save();

            $caseOwnerObj              = New CaseOwner();
            $caseOwnerObj->caseId      = $request['caseID'];
            $caseOwnerObj->user        = $to;
            $caseOwnerObj->type        = 4 ;
            $caseOwnerObj->addressbook = $addressbook;
            $caseOwnerObj->save();

        }

        \Session::flash('successReferral', $request['caseID'].' has been successfully escalated!');
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

        $caseObj = CaseReport::find($id);

        if($caseObj->sub_sub_category == 0)
        {

            $case = \DB::table('cases')
            ->join('municipalities', 'cases.precinct', '=', 'municipalities.id')
            ->join('categories', 'cases.category', '=', 'categories.id')
            ->join('sub-categories', 'cases.sub_category', '=', 'sub-categories.id')
            ->join('users', 'cases.user', '=', 'users.id')
            ->where('cases.id','=',$id)
            ->select(\DB::raw( "
                                    cases.id,
                                    cases.description,
                                    cases.status,cases.img_url,
                                    CONCAT(users.`name`, ' ', users.`surname`) as capturer,
                                     IF(`cases`.`addressbook` = 1,(SELECT CONCAT(`FirstName`, ' ', `Surname`) FROM `addressbook` WHERE `addressbook`.`id`= `cases`.`reporter`), (SELECT CONCAT(users.`name`, ' ', users.`surname`) FROM `users` WHERE `users`.`id`= `cases`.`reporter`)) as reporter,
                                    users.email as reporterCell,
                                    municipalities.name as department,
                                    categories.name as category,
                                    `sub-categories`.name as sub_category,
                                    `cases`.sub_sub_category as sub_sub_category "
                            )
                    )
            ->get();


        }

        else{

            $case = \DB::table('cases')
            ->join('municipalities', 'cases.precinct', '=', 'municipalities.id')
            ->join('categories', 'cases.category', '=', 'categories.id')
            ->join('sub-categories', 'cases.sub_category', '=', 'sub-categories.id')
            ->join('sub-sub-categories', 'cases.sub_sub_category', '=', 'sub-sub-categories.id')
            ->join('users', 'cases.user', '=', 'users.id')
            ->where('cases.id','=',$id)
            ->select(\DB::raw("
                                cases.id,
                                cases.description,
                                cases.status,
                                cases.img_url,CONCAT(users.`name`, ' ', users.`surname`) as capturer,
                                 IF(`cases`.`addressbook` = 1,(SELECT CONCAT(`FirstName`, ' ', `Surname`) FROM `addressbook` WHERE `addressbook`.`id`= `cases`.`reporter`), (SELECT CONCAT(users.`name`, ' ', users.`surname`) FROM `users` WHERE `users`.`id`= `cases`.`reporter`)) as reporter,
                                users.email as reporterCell,
                                municipalities.name as department,
                                categories.name as category,
                                `sub-categories`.name as sub_category,
                                `sub-sub-categories`.name as sub_sub_category

                            "))
            ->get();



        }

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
