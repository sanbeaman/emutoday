<?php

namespace emutoday\Http\Controllers\Api;


use emutoday\Story;
use emutoday\Emutoday\Transformers\StoryTransformer;

use Illuminate\Http\Request;
use emutoday\Http\Requests\Api\Story_StoreRequest;

class StoryController extends ApiController
{
    /**
     * @var emutoday\Emutoday\Transformers\StoryTransformer
     */
    protected $storyTransformer;

    function __construct(StoryTransformer $storyTransformer)
    {
        $this->storyTransformer = $storyTransformer;

        //$this->beforeFilter('auth.basic', ['on' => 'post']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Current Issues:
        // 1. to many - must paginate
        // 2. Now way to attach metadata
        // 3. Linking db structurte to the API Output.. need to hide some data
        // 4. No error Checking

        $storys = Story::all();

        return $this->respond([
            'data' => $this->storyTransformer->transformCollection($storys->all())
        ]);
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
     * @param  \Illuminate\Http\Request  $request Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Story_StoreRequest $request)
    {
        return $this->setStatusCode(422)->respondWithError('Parameters failed validation for a story');
        // if ( ! $request->input('title') or ! $request->input('body'))
        // {
        //     return $this->setStatusCode(422)->respondWithError('Parameters failed validation for a story');
        // }
    }

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