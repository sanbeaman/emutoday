<?php

namespace emutoday\Http\Controllers\Api;


use emutoday\Story;
use emutoday\User;
use emutoday\Emutoday\Transformers\StoryTransformer;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Http\Request;
use emutoday\Http\Requests\Api\Story_StoreRequest;

use emutoday\Emutoday\Transformers\FractalStoryTransformer;
use emutoday\Emutoday\Transformers\FractalStoryExtraTransformer;
use emutoday\Emutoday\Transformers\FractalStoryTransformerModel;

use League\Fractal\Manager;
use League\Fractal;


class StoryController extends ApiController
{
    /**
     * @var emutoday\Emutoday\Transformers\StoryTransformer
     */
    protected $story;

    function __construct(Story $story)
    {
        $this->story = $story;
        // $this->middleware('auth');
        $this->middleware('web', ['only' => [
           'appLoad','listType'
       ]]);
       }


       public function indexList(){
            if (\Auth::check()) {

               $user = \Auth::user();

               $storys = Story::where('user_id', $user->id)->get();
               // $storys = Story::all();

               $fractal = new Manager();
               $resource = new Fractal\Resource\Collection($storys->all(), new FractalStoryTransformer);
               // Turn all of that into a JSON string
               return $fractal->createData($resource)->toJson();

           } else {


                   dd('oops');

           }
           }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::check()) {
            $user = \Auth::user();
            // $storys = $this->story->newQuery();
            // dd($user->roles);
            if ($user->hasRole('contributor_1')){
                // dd($user->id);
                $storys = $user->storys()->get();
            } else {
                $storys  = Story::get();
            }
            $fractal = new Manager();
            $resource = new Fractal\Resource\Collection($storys->all(), new FractalStoryTransformer);
            // Turn all of that into a JSON string
            return $fractal->createData($resource)->toJson();

        } else {
            return $this->setStatusCode(501)->respondWithError('Error');


        }
    }

    // this.$http.get('/api/story/appLoad')
    public function appLoad()
    {

        if (\Auth::check()) {
            $user = \Auth::user();
            // $storys = $this->story->newQuery();
            // dd($user->roles);
            if ($user->hasRole('contributor_1')){
                // dd($user->id);
                $storys = $user->storys()->get();
            } else {
                $storys  = Story::get();
            }
            $fractal = new Manager();
            // $storys = Story::all();
            $resource = new Fractal\Resource\Collection($storys->all(), new FractalStoryExtraTransformer);
            // Turn all of that into a Array string
            return $fractal->createData($resource)->toArray();
        } else {
            return $this->setStatusCode(501)->respondWithError('Error');

        }
    }

    public function listType($stype)
    {

        if (\Auth::check()) {
            $user = \Auth::user();
            // $storys = $this->story->newQuery();
            // dd($user->roles);

            if ($user->hasRole('contributor_1')){
                // dd($user->id);
                if($stype == 'all'){
                    $storys = $user->storys()->get();
                } else {
                    $storys = $user->storys()->where('story_type', $stype)->get();
                }
            } else {
                if($stype == 'all'){
                    $storys = Story::get();
                } else {
                    $storys  = Story::where('story_type', $stype)->get();
                }
            }
            $fractal = new Manager();
            // $storys = Story::all();
            $resource = new Fractal\Resource\Collection($storys->all(), new FractalStoryExtraTransformer);
            // Turn all of that into a Array string
            return $fractal->createData($resource)->toJson();
        } else {
            return $this->setStatusCode(501)->respondWithError('Error');

        }
    }
    public function listApproved()
    {
        $fractal = new Manager();

        $storys = Story::where('is_approved',1)->get();


        $resource = new Fractal\Resource\Collection($storys->all(), new FractalStoryTransformer);
            // Turn all of that into a JSON string
            return $fractal->createData($resource)->toArray();
    }
        public function articles()
        {
            $fractal = new Manager();

            $storys = Story::where('story_type','article')->get();


            $resource = new Fractal\Resource\Collection($storys->all(), new FractalStoryTransformer);
                // Turn all of that into a JSON string
                return $fractal->createData($resource)->toArray();
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
                    'start_date'      => 'required',
                    'story_type'    => 'required',
                    'content'     => 'required',
                    'user_id'   => 'required'
            ]);

     if( $validation->fails() )
     {
         return $this->setStatusCode(422)
                                 ->respondWithError($validation->errors()->getMessages());
     }
     if($validation->passes())
    {
        $story = new Story;
        $story->title           	= $request->get('title');
        $story->slug           	= $request->get('slug');
        $story->subtitle           	= $request->get('subtitle');
        $story->teaser           	= $request->get('teaser');
        $story->story_type      = $request->get('story_type');
        $story->user_id         = $request->get('user_id');
        $story->content     	= $request->get('content');
        $story->start_date      = \Carbon\Carbon::parse($request->get('start_date'));
        $story->author_id       = $request->get('author_id', 0);



        if($story->save()) {
                $record_id  = $story->id;
                return $this->setStatusCode(201)
                    ->respondCreatedWithId('Story successfully created!', $record_id);
                }
            }

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request Request $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Story_StoreRequest $request)
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
        $story = Story::find($id);

        if (! $story)
        {
            return $this->respondNotFound('Story Does Not Exist!');
        }

        return $this->respond([
            'data' => $this->storyTransformer->transform($story)

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fractal = new Manager();
        // $fractal->setSerializer(new ArraySerializer());
        // $fractal->setSerializer(new DataArraySerializer());
        $story = Story::findOrFail($id);

        $resource = new Fractal\Resource\Item($story, new FractalStoryTransformerModel);
            // Turn all of that into a JSON string
            return $fractal->createData($resource)->toArray();
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
         //return some kind of Response
         // 400  'bad request'
         // 403 Forbidden
         //
         // 422 'unprocessable entity'
         //
     //  if (! Input::get('title') or ! Input::get('location'))
     $validation = \Validator::make( Input::all(), [
                     'title'           => 'required',
                     'start_date'      => 'required',
                     'user_id'   => 'required',
                     'content'     => 'required'
             ]);

      if( $validation->fails() )
      {
          return $this->setStatusCode(422)
                                  ->respondWithError($validation->errors()->getMessages());
      }
      if($validation->passes())
     {
         $story = new Story;
         $story->user_id       	= $request->get('user_id');
         $story->title           	= $request->get('title');
         $story->slug           	= $request->get('slug');
         $story->subtitle           = $request->get('subtitle');
         $story->teaser           	= $request->get('teaser');
         $story->story_type         = $request->get('type');
         $story->author_id        = $request->get('author_id',0);
         $story->author_info        = $request->get('author_info', null);
         $story->content     	    = $request->get('content');
         $story->is_approved     	= $request->get('is_approved', 0);


        $story->is_promoted          = $request->get('is_promoted', 0);
        $story->is_featured    	= $request->get('is_featured', 0);
       $story->is_live          = $request->get('is_live', 0);
       $story->is_archived         = $request->get('is_archived', 0);
         $story->start_date      	= $request->get('start_date');
          $story->end_date      	= \Carbon\Carbon::parse($request->get('end_date', null));
         if($story->save()) {
             $record_id = $story->id;
                 return $this->setStatusCode(201)
                     ->respondCreatedWithId('Story successfully Updated!!!!!!!!!!', $record_id);
                 }
             }

     }

    public function delete(Request $request)
    {
        $story = $this->story->findOrFail($request->get('id'));
        $story->delete();
        flash()->warning('Story has been deleted.');
        return redirect(route('admin.story.index'));//->with('status', 'Story has been deleted.');
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
