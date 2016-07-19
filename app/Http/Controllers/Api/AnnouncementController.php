<?php

namespace emutoday\Http\Controllers\Api;


use emutoday\Announcement;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Input as Input;
use Carbon\Carbon;
use emutoday\Emutoday\Transformers\FractalAnnouncementTransformer;
use League\Fractal\Manager;
use League\Fractal;


class AnnouncementController extends ApiController
{
    /**
     * @var emutoday\Emutoday\Transformers\StoryTransformer
     */
    // protected $storyTransformer;

    function __construct()
    {
        // $this->storyTransformer = $storyTransformer;

        //$this->beforeFilter('auth.basic', ['on' => 'post']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

				$fractal = new Manager();

        $announcements = Announcement::all();

				$resource = new Fractal\Resource\Collection($announcements->all(), new FractalAnnouncementTransformer);
					// Turn all of that into a JSON string
					return $fractal->createData($resource)->toJson();
        // return $this->respond([
        //     'data' => $this->storyTransformer->transformCollection($storys->all())
        // ]);
    }
		// public function index()
		// {
		//
		//
		// 		$storys = Story::all();
		//
		// 		return $this->respond([
		// 				'data' => $this->storyTransformer->transformCollection($storys->all())
		// 		]);
		// }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
		public function store(Request $request)
		{
			//return some kind of Response
			// 400  'bad request'
			// 403 Forbidden
			//
			// 422 'unprocessable entity'
			//
		//  if (! Input::get('title') or ! Input::get('location'))
		$validation = \Validator::make( Input::all(), [
																	'title'           => 'required',
																	'start_date'      => 'required|date',
																	'end_date'        => 'required|date',
																	'announcement'     => 'required|max:255'
															]);

		 if( $validation->fails() )
		 {
			 return $this->setStatusCode(422)
									 ->respondWithError($validation->errors()->getMessages());
		 }
		 if($validation->passes())
		{
			$announcement = new Announcement;
			$announcement->author_id       	= $request->get('author_id');
			$announcement->title           	= $request->get('title');
			$announcement->start_date      	= \Carbon\Carbon::parse($request->get('start_date'));
			$announcement->end_date      		= \Carbon\Carbon::parse($request->get('end_date'));
			$announcement->announcement     	= $request->get('announcement');
			$announcement->submission_date 				= \Carbon\Carbon::now();

			if($announcement->save()) {
					return $this->setStatusCode(201)
												->respondCreated('Announcement successfully created!!!!!!!!!!');
					// flash()->success('Announcement has been updated and will be sent for approval');
					// return redirect(route('emu-today.announcement.edit',$announcement->id ));

								//  return response()->json([
								//          'success' => true,
								//          'message' => 'record updated'
								//      ], 201);
							 }
					 }

			 }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request Request $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     return $this->setStatusCode(422)->respondWithError('Parameters failed validation for a story');
    //     // if ( ! $request->input('title') or ! $request->input('body'))
    //     // {
    //     //     return $this->setStatusCode(422)->respondWithError('Parameters failed validation for a story');
    //     // }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $story = Story::find($id);
				//
        // if (! $story)
        // {
        //     return $this->respondNotFound('Story Does Not Exist!');
        // }
				//
        // return $this->respond([
        //     'data' => $this->storyTransformer->transform($story)
				//
        // ]);
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
