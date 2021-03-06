<?php

namespace App\Http\Controllers;

use App\requestclient;
use http\Url;
use Illuminate\Http\Request;
use App\Travel;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $rules = [
        'id_travel' => 'required',
        'date' => 'required',
        'numb_travelers' => 'required',
        'remark' => 'required',

    ];

    public function index()
    {
        $travels = Travel::all();
        return response()->json(['travels'=>$travels] , 200);

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
        $createRules = $this->rules;
        $validator = \Validator::make($request->all(), $createRules);
        if ($validator->fails())
            return response()->json(['errors'=>$validator->errors()], 400);

        error_log('b');



        $requesttravel = new Travel();

        $requesttravel->id_travel = $request->get('id_travel');
        $requesttravel->date = $request->get('date');
        $requesttravel->numb_travelers = $request->get('numb_travelers');
        $requesttravel->remark = $request->get('remark');
        $requesttravel->user_id = $request->get('user_id');
        $requesttravel->user_name = $request->get('user_name');

        $result = $requesttravel->save();
        if (!$result)
            return response()->json($result, 500);
        else
            return response()->json(['$requesttravel' => $requesttravel], 201);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $travel = Travel::find($id);
        if($travel)
            return response()->json(['travel' => $travel] , 200);
        else
            return response()->json([] , 400);
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
        $travel = Travel::find($id);
        if(!$travel)
            return response()->json([] , 404);

        $travel->statue = $request->get('statue');
        $travel->save();
        return response()->json(['travel' => $travel] , 201);
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
