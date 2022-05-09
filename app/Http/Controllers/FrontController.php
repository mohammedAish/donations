<?php

namespace App\Http\Controllers;

use App\Models\FundRaiser;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontController extends Controller
{
    //

    public function index(){

        $fundraisers = FundRaiser::all();
        return view('front.welcome',compact('fundraisers'));
    }
    public function show($id){
        $fundraiser = FundRaiser::findOrFail($id);
        $Raised =$fundraiser->raised/$fundraiser->price *100;
        return view('front.causes-details',compact('fundraiser','Raised'));
    }
    public function raised(Request $request,$id){
        $validator = Validator($request->all(), [
            '*' => 'required',
        ]);
        $raised = FundRaiser::findOrFail($id);
        if (!$validator->fails()) {
            $raised->raised = $request->raised + $raised->raised;
            $isSaved = $raised->save();

            return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

}
