<?php

namespace emutoday\Http\Controllers\Api;


use emutoday\Event;


use Illuminate\Http\Request;
use Carbon\Carbon;

class EventsController extends ApiController
{

    protected $events;

  public function __construct(Event $events)
  {
      $this->events = $events;
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::latest()->get();
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

      $this->validate($request, [
       'title' => 'required|max:100',
       'location'       => 'required',
       'start-date'     => 'required',
       'start-time'     => 'required',
      //  'end-date'       => 'required',
      //  'categories'     => 'required',
      //  'description'    => 'required',
      //  'contact-person' => 'required,fullname',
      //  'contact-phone'  => 'required,phone',
      //  'contact-email'  => 'required,email',
       ]);

      $eventStartDate = $request->start_date == null ? \Carbon\Carbon::now() : \Carbon\Carbon::parse($request->start_date) ;
      // $pubEndDate = $request->end_date == null ? null:  \Carbon\Carbon::parse($request->end_date);
      //
      // $story = $this->storys->create(
      // // ['author_id' => auth()->user()->id] + ['story_type' => $request->input('story_type') ] +  $request->only('title', 'slug', 'subtitle', 'published_at', 'teaser','content')
      //
      //  ['author_id' => auth()->user()->id] + $request->only('title', 'slug', 'subtitle', 'teaser','content', 'external_link', 'story_type') + ['start_date' => $pubStartDate] + ['end_date' => $pubEndDate ]
      //
      // );
      //

      return $this->events->create(
        ['author_id' => auth()->user()->id] + $request->only('title','short_title','location', 'start_time') + ['start_date' => $eventStartDate]
        );

    }

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
