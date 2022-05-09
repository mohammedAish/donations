<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\FundRaiser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class FundRaiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fundraisers = FundRaiser::all();
        return response()->view('cms.fundraisers.index', ['fundraisers' => $fundraisers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.fundraisers.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(), [
            '*' => 'required',
        ]);

        if (!$validator->fails()) {
            $fundraisers = new FundRaiser();
            $fundraisers->title = $request->title;
            $fundraisers->intro = $request->intro;
            $fundraisers->desc = $request->desc;
            $fundraisers->price = $request->price;
            $fundraisers->owner = $request->owner;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $image = uniqid().'.'. $request->image->extension();
                $file->move(public_path('img'), $image);
                $fundraisers->image = $image;
            }
            $isSaved = $fundraisers->save();

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

    public function fundRaiserApp($id){
        $application = Application::whereId($id)->first();
        return view('cms.fundraisers.fundraisersApp',compact('application'));

    }
  

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FundRaiser  $fundRaiser
     * @return \Illuminate\Http\Response
     */
    public function show(FundRaiser $fundRaiser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FundRaiser  $fundRaiser
     * @return \Illuminate\Http\Response
     */
    public function edit(FundRaiser $fundRaiser)
    {

        return response()->view('cms.fundraisers.edit', ['fundRaiser' => $fundRaiser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FundRaiser  $fundRaiser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FundRaiser $fundRaiser)
    {

        $validator = Validator($request->all(), [
            '*' => 'required',
        ]);

        if (!$validator->fails()) {
            $fundRaiser->title = $request->title;
            $fundRaiser->intro = $request->intro;
            $fundRaiser->desc = $request->desc;
            $fundRaiser->price = $request->price;
            $fundRaiser->owner = $request->owner;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $image = uniqid().'.'. $request->image->extension();
                $file->move(public_path('img'), $image);
                $fundRaiser->image = $image;
            }
            $isSaved = $fundRaiser->save();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FundRaiser  $fundRaiser
     * @return \Illuminate\Http\Response
     */
    public function destroy(FundRaiser $fundRaiser)
    {
        $deleted = $fundRaiser->delete();
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'User deleted successfully' : 'User deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
