<?php

namespace emutoday\Http\Controllers\Admin;


use emutoday\Announcement;
use Illuminate\Http\Request;

use emutoday\Http\Requests;

class AnnouncementController extends Controller
{

  protected $announcement;

  public function __construct(Announcement $announcement)
  {
      $this->announcement = $announcement;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $announcements = $this->announcement->get();

      return view('admin.announcement.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Announcement $announcement)
    {
          return view('admin.announcement.edit', compact('announcement'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $data = [
        'author_id' => auth()->user()->id,
        'title' => $request->title,
        'announcement' => $request->announcement,
        'start_date' => \Carbon\Carbon::parse($request->start_date),
        'end_date' => \Carbon\Carbon::parse($request->end_date),
        'is_approved' => $request->is_approved,
        'is_promoted' => $request->is_promoted
    ];
      $announcement = $this->announcement->create($data);
      flash()->success('Announcement has been created.');
      return redirect(route('admin.announcement.edit', $announcement->id));//->with('status', 'Story has been created.');
    }


    public function confirm($id)
    {
        $announcement = $this->announcement->findOrFail($id);


        return view('admin.announcement.confirm', compact('announcement'));
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
      $announcement = $this->announcement->findOrFail($id);
      return view('admin.announcement.edit', compact('announcement'));
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
      $announcement = $this->announcement->findOrFail($id);
      $announcement->title = $request->title;
      $announcement->announcement = $request->announcement;
      $announcement->start_date = \Carbon\Carbon::parse($request->start_date);
      $announcement->end_date = \Carbon\Carbon::parse($request->end_date);
      $announcement->is_promoted = $request->is_promoted;
      $announcement->is_approved = $request->is_approved;
      $announcement->save();

      //$story->fill($request->only('title', 'slug', 'subtitle', 'teaser','content','story_type'))->save();
      flash()->success('Announcement has been updated.');
      return redirect(route('admin.announcement.edit', $announcement->id));
      //return redirect(route('admin.story.edit', $story->id))->with('status', 'Story has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $announcement = $this->announcement->findOrFail($id);
      $announcement->delete();
      flash()->warning('Announcement has been deleted.');
      return redirect(route('admin.announcement.index'));//->with('status', 'Story has been deleted.');
    }
}
