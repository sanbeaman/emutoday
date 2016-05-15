<?php

namespace emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use emutoday\Magazine;
use emutoday\Story;
use emutoday\StoryImage;
use JavaScript;
use emutoday\Http\Requests;


class MagazineController extends Controller
{

  protected $magazines;

  public function __construct(Magazine $magazines, Story $storys, StoryImage $storyImages)
  {
      $this->magazines = $magazines;
      $this->storys = $storys;
      $this->storyImages = $storyImages;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $magazines = $this->magazines->orderBy('updated_at', 'desc')->get();

      return view('admin.magazine.index', compact('magazines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Magazine $magazine)
    {
          return view('admin.magazine.create', compact('magazine'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $magazine = $this->magazines->create(
            [ 'user_id' => auth()->user()->id ]
            + $request->only( 'year', 'season','title','subtitle','teaser')
                            );
      flash()->success('Magazine has been setup.');
      return redirect(route('admin.magazine.edit', $magazine->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $magazine = $this->magazines->findOrFail($id);
      $storyImages = $this->magazines->storyImages();
      $barImgs = collect();


      foreach ($magazine->storys as $story) {
          if ($story->pivot->story_position === 0) {
              $heroImg = $story->storyImages()->where('image_type', 'imagehero')->first();
          } else {
              $barImgs->push( $story->storyImages()->where('image_type', 'imagesmall')->first() );
          }

      }
      JavaScript::put([
          'jsis' => 'hi',
      ]);
      // $magazine = $this->magazines->findOrFail($id);
      // $storyImages = $this->magazines->storyImages();
      return view('admin.magazine.preview', compact('magazine', 'storyImages', 'heroImg', 'barImgs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $magazine = $this->magazines->findOrFail($id);
      $storyImages = $this->storyImages->get();
      $storys =  $this->storys->where('story_type', 'storymagazine')->orderBy('updated_at', 'desc')->get();
      $magazineStorys = $magazine->storys()->get();

      JavaScript::put([
          'jsis' => 'foobar',
          'magazinestorys' => $magazineStorys->toArray()
      ]);
      return view('admin.magazine.edit', compact('magazine', 'storys', 'storyImages'));
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
      $magazine = $this->magazines->findOrFail($id);
      $storyIDString =  $request->get('story_ids');
      $storyIDarray = explode(",", $storyIDString);
      $storyIDarrayCount = count($storyIDarray);
      $storyIDsForPivotArray;

       for ($x = 0; $x < $storyIDarrayCount; $x++) {
          $namedKey = $storyIDarray[$x];
           $attributeArray = array();
           $attributeArray["story_position"] = intval($x);
           $storyIDsForPivotArray[intval($namedKey)] = $attributeArray;

       }
      $magazine->storys()->sync($storyIDsForPivotArray);
      $magazine->year = $request->year;
      $magazine->season   = $request->season;
      $magazine->title = $request->title;
      $magazine->subtitle   = $request->subtitle;
      $magazine->teaser = $request->teaser;
      $magazine->ext_url = $request->ext_url;
      $magazine->start_date = \Carbon\Carbon::parse($request->start_date);
      $magazine->cover_art = $request->cover_art;
      $magazine->is_published = $request->is_published;
      $magazine->is_archived = $request->is_archived;
      $magazine->save();
      flash()->success('Magazine has been updated.');
      return redirect(route('admin.magazine.edit', $magazine->id));
    }

    /**
     * Confirm the deletion of magazine model / record
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function confirm($id)
    {
        $magazine = $this->magazines->findOrFail($id);
        return view('admin.magazine.confirm', compact('magazine'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $magazine = $this->magazines->findOrFail($id);
      $magazine->delete();
      flash()->warning('Magazine has been deleted.');
      return redirect(route('admin.magazine.index'));
    }
}
