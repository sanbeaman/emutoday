<?php

namespace emutoday\Http\Controllers\Api;

use Illuminate\Http\Request;

use emutoday\Emutoday\Transformers\FractalEventTransformer;

use League\Fractal\Manager;
use League\Fractal;

use emutoday\Event;
use Carbon\Carbon;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;


class EventController extends ApiController
{

  function __construct()
  {

  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
			$currentDate = Carbon::now();
			$DateMinus2 =  $currentDate->subYears(2);
			$fractal = new Manager();

			$events = Event::orderBy('start_date', 'desc')->take(500);
			$resource = new Collection($events->get(), new FractalEventTransformer);
				// Turn all of that into a JSON string
				return $fractal->createData($resource)->toJson();



			//$fractal = new Manager();

    //  $events = Event::all();

			// $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
			// 	// Turn all of that into a JSON string
			// 	return $fractal->createData($resource)->toJson();

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


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
