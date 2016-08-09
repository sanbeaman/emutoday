<?php

namespace emutoday\Http\Controllers\Api;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input as Input;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;
use League\Fractal\Manager;
use League\Fractal;

use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Serializer\ArraySerializer;
use League\Fractal\Serializer\JsonApiSerializer;

use emutoday\Event;
use emutoday\Category;
use emutoday\Building;
use emutoday\Mediafile;
use emutoday\Mediatype;

use Carbon\Carbon;

use emutoday\Emutoday\Transformers\FractalEventTransformer;
use emutoday\Emutoday\Transformers\FractalEventTransformerModel;
use emutoday\Emutoday\Transformers\FractalBuildingTransformer;
use emutoday\Emutoday\Transformers\FractalCategoryTransformer;


class EventController extends ApiController
{

  function __construct()
  {
        // $this->middleware('auth');
  }

  public function queue()
  {
        $cFullDateSub3Months = Carbon::now()->subMonths(6);
        $fractal = new Manager();
        $events = Event::where('end_date', '>', $cFullDateSub3Months)->get();
        $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModel);
         // Turn all of that into a JSON string
         return $fractal->createData($resource)->toArray();
  }
  public function otherItems()
  {
      $cFullDateSub3Months = Carbon::now()->subMonths(3);
      $fractal = new Manager();
      $events = Event::where([
          ['is_approved', 1],
          ['is_promoted', 1],
          ['end_date', '>', $cFullDateSub3Months]
          ])->get();
          $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModel);
          // Turn all of that into a JSON string
          return $fractal->createData($resource)->toArray();

      }
  public function approvedItems()
  {

      $cFullDateSub3Months = Carbon::now()->subMonths(3);
      $fractal = new Manager();
      $events = Event::where([
          ['is_approved', 1],
          ['end_date', '>', $cFullDateSub3Months]
          ])->get();
          $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModel);
          // Turn all of that into a JSON string
          return $fractal->createData($resource)->toArray();

      }
  public function unapprovedItems()
  {
      $currentDate = Carbon::now();
      $DateMinus2 =  $currentDate->subYears(1);
    $fractal = new Manager();

        $events = Event::where([
                            ['is_approved', 0],
                            ['end_date', '>', $DateMinus2]
                                ])->get();

          $events = Event::where('is_approved', 0)->get();
          $resource = new Fractal\Resource\Collection($events->all(), new FractalEventTransformerModel);
              // Turn all of that into a JSON string
              return $fractal->createData($resource)->toArray();
          // return $this->respond([
          //     'data' => $this->storyTransformer->transformCollection($storys->all())
          // ]);
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


    }
        public function listEventCategories()
        {
            // $text = ;
            // $text = \Input::get('q');
            $text = $request->q;
            // dd($text);
            $manager = new Manager();
                // $manager->setSerializer(new JsonApiSerializer());
     // 	$manager->setSerializer(new DataArraySerializer());
            // $manager->setSerializer(new JsonApiSerializer());


            $categories = Category::get();
            //  = Building::likeSearch('name', $text)->get();

            $resource = new Fractal\Resource\Collection($categories, new FractalCategoryTransformer());
                // Turn all of that into a JSON string
                return $manager->createData($resource)->toArray();

        }
        public function buildings(Request $request)
        {
            // $text = ;
            // $text = \Input::get('q');
            $text = $request->q;
            // dd($text);
            $manager = new Manager();
                // $manager->setSerializer(new JsonApiSerializer());
     // 	$manager->setSerializer(new DataArraySerializer());
            // $manager->setSerializer(new JsonApiSerializer());


            $buildings = Building::likeSearch('name', $text)->get();

            $resource = new Fractal\Resource\Collection($buildings, new FractalBuildingTransformer());
                // Turn all of that into a JSON string
                return $manager->createData($resource)->toArray();
            // return $this->respond([
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
            //return some kind of Response
            // 400  'bad request'
            // 403 Forbidden
            //
            // 422 'unprocessable entity'
            //
        //  if (! Input::get('title') or ! Input::get('location'))


        $validation = \Validator::make( Input::all(), [
            'title'           => 'required',
            'location'        => 'required',
            'on_campus'				=> 'required',
            'start_date'      => 'required|date',
            'end_date'        => 'required|date',
            'categories'      => 'required',
            'cost'						=> 'required',
            'description'     => 'required',
            'contact_person'  => 'required',
            'contact_phone'  => 'required',
            'contact_email'  => 'required|email'
        ]);

         if( $validation->fails() )
         {
             return $this->setStatusCode(422)
                         ->respondWithError($validation->errors()->getMessages());
            //  return json_encode([
            // 				 'errors' => $validation->errors()->getMessages(),
            // 				 'code' => 422
            // 			]);
            //  return json_encode([
            // 				 'errors' => $validation->errors()->getMessages(),
            // 				 'code' => 422
            // 			]);
        //  } else {
        // 	 Event::create($request->all());
        // 	 return $this->setStatusCode(201)->respondCreated('Event successfully created.');
         }
         if($validation->passes())
         {
           $event = new Event;
             $event->author_id       	= $request->get('author_id');
           $event->title           	= $request->get('title');
           $event->short_title     	= $request->get('short_title');
            // $templocation = $request->get('location');serialize($templocation);
            $event->on_campus					= $request->get('on_campus');
            $event->building					= $request->get('building');
            $event->room							= $request->get('room');
           $event->location        	= $request->get('location');
           $event->start_date      	= \Carbon\Carbon::parse($request->get('start_date'));
           $event->start_time     		= \Carbon\Carbon::parse($request->get('start_time'));
            $event->end_date      		= \Carbon\Carbon::parse($request->get('end_date'));
            $event->end_time     			= \Carbon\Carbon::parse($request->get('end_time'));
            $event->all_day						= $request->get('all_day');
            $event->no_end_time				= $request->get('no_end_time');
            $event->contact_person    = $request->get('contact_person');
            $event->contact_phone     = $request->get('contact_phone');
            $event->contact_email     = $request->get('contact_email');
            $event->contact_fax				= $request->get('contact_fax');
            $event->description     	= $request->get('description');

            $event->related_link_1					= $request->get('related_link_1');
            $event->related_link_2					= $request->get('related_link_2');
            $event->related_link_3					= $request->get('related_link_3');
            $event->reg_deadline						= $request->get('reg_deadline');
            $event->free 										= $request->get('free');
            $event->cost 										= $request->get('cost');
            $event->participants						=$request->get('participants');
            $event->tickets									=$request->get('tickets');
            $event->ticket_details_phone		=$request->get('ticket_details_phone');
            $event->ticket_details_online		=$request->get('ticket_details_online');
            $event->ticket_details_office		=$request->get('ticket_details_office');
            $event->ticket_details_other		=$request->get('ticket_details_other');

            $event->mini_calendar						= $request->get('mini_calendar');
            $event->lbc_reviewed						= $request->get('lbc_reviewed');
            $event->submission_date 				= \Carbon\Carbon::now();

            // mini_calendar
          // `ensemble` int(11) unsigned DEFAULT NULL,
          // `mba` int(11) unsigned DEFAULT NULL,
          // `mini_calendar_alt` int(11) unsigned DEFAULT NULL,


          // `created_at` timestamp NULL DEFAULT NULL,
          // `updated_at` timestamp NULL DEFAULT NULL,

          // `mediafile_id` int(10) unsigned NOT NULL,
            // `feature_image` varchar(255) DEFAULT NULL,

          // `building_id` int(10) unsigned NOT NULL,
            //
            // `homepage` int(11) unsigned DEFAULT '0',
            // `lbc_reviewed` int(11) unsigned DEFAULT '0',
            // `approved_date` date DEFAULT NULL,
            // `lbc_approved` int(11) unsigned DEFAULT NULL,
            // `featured` int(11) unsigned DEFAULT '0',
            // `approved` int(11) unsigned DEFAULT '0',
            // `canceled` int(11) unsigned DEFAULT '0',
            //
            // `submitter` varchar(255) DEFAULT NULL,
            // $categories_array =  $request->get('categories');
                    if($event->save()) {
                        $event->eventcategories()->sync($request->get('categories'));
                        $event->save();

                        // return redirect()->route('emutoday_event_edit',['id' => $event->id] );

                        // $url = route('profile', ['id' => 1]);


                            return $this->setStatusCode(201)
                                                        ->respondCreated('Event successfully created.');
                                    //  return response()->json([
                                    //          'success' => true,
                                    //          'message' => 'record updated'
                                    //      ], 201);
                                   }
                              }

              }
        // if (! $request->input('title') or ! $request->input('location'))
        //   {
        //       return $this->setStatusCode(422)
        //                   ->respondWithError('Parameters failed validation for an event');
        //   }

            // Event::create(Input::all());
            // Event::create($request->all());
            // return $this->setStatusCode(201)->respondCreated('Event successfully created.');
            // $validation = \Illuminate\Support\Facades\Validator::make(
            //   $request->only('title','location','start_date', 'start_time'),[
            //    'title' => 'required|max:100',
            //    'location'       => 'required',
            //    'start_date'     => 'required',
            //    'start_time'     => 'required',
            //   ]);


                // if($validation->passes())
                // {
                //   $event = new Event;
                //   $event->author_id       = auth()->user()->id;
                //   $event->title           = $request->get('title');
                //   $event->short_title     = $request->get('short_title');
                //   $event->location        = $request->get('location');
                //   $event->start_date      = \Carbon\Carbon::parse($request->get(start_date));
                //   $event->start_time     = \Carbon\Carbon::parse($request->get(start_time));
                //
                //   if($event->save()) {
                //     return response()->json([
                //             'success' => true,
                //             'message' => 'record updated'
                //         ], 200);
                //   }
                // }
                //
                // $errors = $validation->errors();
                // $errors =  json_decode($errors);
                //
                // return response()->json([
                //   'success' => false,
                //   'message' => $errors
                // ], 422);


    // }

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

            if (\Auth::check()) {
        // The user is logged in...
            $user = \Auth::user();
        } else {
            return 'Need to Connect to LDAP';
        }
        $event = $this->event->findOrFail($id);

        $approved = $user->events->where('approved', '1');
        $submitted = $user->events->where('approved', '0');

        return view('public.event.form', compact('event', 'approved','submitted'));

            // $event = Event::with('eventcategories')->findOrFail($id);
            // $eventcategories = $event->eventcategories;
        // return $event;
    }






    public function addMediaFile(Request $request)
    {

            $group = 'event';
            $type = 'small';
            // $imgFile = $request->file('attachment');
            // dd($imgFile);
            $event_id = $request->input('event_id');
            // $imgFile = $request->file('attachment');

            $event = Event::findOrFail($event_id);
            //define the image paths
            $destinationFolder = '/imgs/'.$group.'/';

            $mediafile = new Mediafile();
            //Find mediatype for this type of media file
            $mediatype = Mediatype::where([
                    ['group',$group],
                    ['type', $type]
                ])->first();
                    //Define mediatype to mediafile relationship
            $mediafile->mediatype()->associate($mediatype);

            $mediafile->group = $group;
            $mediafile->type = $type;
            $mediafile->path = $destinationFolder;

            $imgFile = Input::file('eventimg');
            $imgFilePath = $imgFile->getRealPath();
            $imgFileOriginalExtension = strtolower($imgFile->getClientOriginalExtension());

            switch ($imgFileOriginalExtension) {
                    case 'jpg':
                    case 'jpeg':
                     $imgFileExtension = 'jpg';
                     break;
                     default:
                     $imgFileExtension = $imgFileOriginalExtension;
                 }
                 $mediafile->name = 'event'. '-' .$event->id;
                 $mediafile->ext = $imgFileExtension;

                 $imgFileName = $mediafile->name . '.' . $mediafile->ext;



            $image = Image::make($imgFilePath)
             ->save(public_path() . $destinationFolder . $imgFileName);
            //  ->fit(100)
            //  ->save(public_path() . $destinationFolder . 'thumbnails/' . 'thumb-' . $imgFileName);

            // 	}
            //
            $mediafile->filename = $imgFileName;
            $mediafile->save();


            $event->mediaFile()->associate($mediafile);
            $event->is_promoted = 1;

            if($event->save()) {
                    return $this->setStatusCode(201)
                                ->respondCreated('Event successfully updated');
                            }
        }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateItem(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        //$event->priority = $request->get('priority');
        $event->is_approved = $request->get('is_approved');

            if($event->save()) {
                    return $this->setStatusCode(201)
                    ->respond([$event->is_approved]);
                                // ->respondCreated('Event successfully patched');
                            }
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
