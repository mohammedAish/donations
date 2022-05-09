<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applications = Application::all();
        return response()->view('cms.application.index', ['applications' => $applications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('cms.application.register');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data=$request->all();
        $data['code']=rand(1000,9999);
        $data['status']='waiting';
       Session::put('phone', $request->phone);
        $application = Application::create($data);

//         $bearer = '0859b1bdc88f0bf93a80f9b4fbc44977';

//         $taqnyt = new TaqnyatSms($bearer);

//          $body = "كود التفعيل  :: $application->code ";
//          dd($body);
//          $recipients = [$request->phone];
//          $sender = 'QALBI';


// $message =$taqnyt->sendMsg($body, $recipients, $sender);

        // $details = [
        //     'title' => 'كود التفعيل',
        //     'body' =>$application->code ,
        // ];
        // Mail::to($application->email)->send(new \App\Mail\MyTestMail($details));

        return response()->json(['status'=>true,'application',$application]);

        //return $application;
   //  dd($application);

    }
    public function storecode(Request $request){
       // dd('code');
          $session =  Session::get('phone');
//dd($session);
        $application = Application::where('phone',$session)->latest()->first();
        if($application->code == $request->code){
            return response()->json(['status'=>true]);

        }else
        //dd($data['code']);
    //    $session =  Session::get('phone');
    //    dd($session);
    return response()->json(['status'=>false]);
    //  return redirect()->back()->with('success','تم الاضافة بنجاح');

    }
    public function storeother(Request $request){
        $session =  Session::get('phone');
       $application = Application::where('phone',$session)->latest()->first();
       $data=$request->all();
       if($request->hasFile('other'))
        {
            $file=$request->file('other');
            $image1 = uniqid().'.'. $request->other->extension();
            $file->move(public_path('img'), $image1);
            $other= $image1;
            $data['other']=$other;
        }
        if($request->hasFile('visa_photo'))
        {
            $file=$request->file('visa_photo');
            $image1 = uniqid().'.'. $request->visa_photo->extension();
            $file->move(public_path('img'), $image1);
            $visa_photo= $image1;
            $data['visa_photo']=$visa_photo;
        }
        if($request->hasFile('definition_salary'))
        {
            $file=$request->file('definition_salary');
            $image1 = uniqid().'.'. $request->definition_salary->extension();
            $file->move(public_path('img'), $image1);
            $definition_salary= $image1;
            $data['definition_salary']=$definition_salary;
        }
        if($request->hasFile('id_photo'))
        {
            $file=$request->file('id_photo');
            $image1 = uniqid().'.'. $request->id_photo->extension();
            $file->move(public_path('img'), $image1);
            $id_photo= $image1;
            $data['id_photo']=$id_photo;
        }
        if($request->hasFile('medical_report'))
        {
            $file=$request->file('medical_report');
            $image2 = uniqid().'.'. $request->medical_report->extension();
            $file->move(public_path('img'), $image2);
            $medical_report= $image2;
            $data['medical_report']=$medical_report;
        }
        if($request->hasFile('housing_contract'))
        {
            $file=$request->file('housing_contract');
            $image3 = uniqid().'.'. $request->housing_contract->extension();
            $file->move(public_path('img'), $image3);
            $housing_contract= $image3;
            $data['housing_contract']=$housing_contract;
        }
        $application = Application::whereId($application->id)->update($data);
    //     $user = User::where('type', "منسق العلاج")->latest()->first();

    // $details = [
    //     'title' => 'تم اضافة طلب جديد',
    //     'body' =>'يرجي فحص صفحة الطلبات لديك' ,
    // ];
    // Mail::to($user->email)->send(new \App\Mail\MyTestMail($details));
    //       return response()->json(['status'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
        return response()->view('cms.application.edit', ['application' => $application]);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    public function status($id){
        $application = Application::whereId($id)->first();
        if($application->status == "waiting"){
            $status= $application->status;
            $status= "acceptance";
        }
        else{
            $status= $application->status;
            $status= "waiting";
        }

        $isSaved = Application::whereId($id)->update([
             'status' => $status,
        ]);

        return response()->json([
            'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //

    }
}
