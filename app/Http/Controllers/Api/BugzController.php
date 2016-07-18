<?php

namespace emutoday\Http\Controllers\Api;

use emutoday\Bugz;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;


use League\Fractal\Manager;
use League\Fractal;
class BugzController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

			$bugz = new Bugz;
			$bugz->user_id       	=  $request->get('user_id');
			$bugz->type           	= $request->get('type');
			$bugz->screen      		= $request->get('screen');
			$bugz->notes           	= $request->get('notes');
			$bugz->priority      		= $request->get('priority');
			if($bugz->save()) {
				 return response()->json([
				         'success' => true
				     ], 201);
					 }
				 }

					// return $this->setStatusCode(201)
					// 					->respondCreated('bug Made');
					//
					// 				 }


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
