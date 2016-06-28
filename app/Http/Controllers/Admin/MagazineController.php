<?php

namespace emutoday\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use emutoday\Magazine;
use emutoday\Story;
use emutoday\StoryImage;
use emutoday\Mediafile;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\File;
// import the Intervention Image Manage
use Intervention\Image\ImageManagerStatic as Image;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use JavaScript;
use emutoday\Http\Requests;


class MagazineController extends Controller
{

  protected $magazines;

  public function __construct(Magazine $magazine, Story $story, Mediafile $mediafile)
  {
      $this->magazine = $magazine;
      $this->story = $story;
      $this->mediafile = $mediafile;
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $magazines = $this->magazine->orderBy('updated_at', 'desc')->get();
			JavaScript::put([
					'allmags' => $magazines,
			]);
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
      $magazine = $this->magazine->create(
            [ 'user_id' => auth()->user()->id ]
            + $request->only( 'year', 'season','title','subtitle','teaser')
                            );
      flash()->success('Magazine has been setup.');
      return redirect(route('admin.magazine.edit', $magazine->id));
    }

		public function updateCoverImage($id, Request $request)
		{
			$mediafile = $this->mediafile->findOrFail($id);
			$mediafile->caption = $request->get('caption');
			$mediafile->note = $request->get('note');

			if ( ! empty(Input::file('photo'))){

			$imgFile = $request->file('photo');

			// $imgFile = Input::file('photo');
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
			 $mediafile->name = 'cover'. '-' .$magazine->year . '-' . $magazine->season;
			 $mediafile->ext = $imgFileExtension;

			 $imgFileName = $mediafile->name . '.' . $mediafile->ext;


		$image = Image::make($imgFilePath)
		 ->save(public_path() . $destinationFolder . $imgFileName)
		 ->fit(100)
		 ->save(public_path() . $destinationFolder . 'thumbnails/' . 'thumb-' . $imgFileName);

		}
		$magazine = $mediafile->magazines->first();
		$magazine->mediafiles()->save($mediafile);
		flash()->success('Cover Image has been updated');
		return redirect(route('admin.magazine.edit', $magazine->id));//->with('status', 'Story has been created.');


		}
		public function addCoverImage($id, Request $request)
		{

  		$magazine = $this->magazine->findOrFail($id);
			//define the image paths
			$destinationFolder = '/imgs/magazine/';

			$mediafile = new Mediafile();

			//assign the image paths to new model, so we can save them to DB

			$mediafile->path = $destinationFolder;


				//parts of the image we will need
			// if ( ! empty(Input::file('photo'))){
				$imgFile = $request->file('photo');

				// $imgFile = Input::file('photo');
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
				 $mediafile->name = 'cover'. '-' .$magazine->year . '-' . $magazine->season;
				 $mediafile->ext = $imgFileExtension;

				 $imgFileName = $mediafile->name . '.' . $mediafile->ext;


			$image = Image::make($imgFilePath)
			 ->save(public_path() . $destinationFolder . $imgFileName)
			 ->fit(100)
			 ->save(public_path() . $destinationFolder . 'thumbnails/' . 'thumb-' . $imgFileName);

		// 	}
			$mediafile->caption = $request->input('caption');
			$mediafile->note = $request->input('note');
			$mediafile->save();
			$magazine->mediafiles()->save($mediafile);
			flash()->success('Cover Image has been added');
			return redirect(route('admin.magazine.edit', $magazine->id));//->with('status', 'Story has been created.');



		}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $magazine = $this->magazine->findOrFail($id);
      $storyImages = $this->magazine->storyImages();
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
      $magazine = $this->magazine->findOrFail($id);
      $storys =  $this->story->where('story_type', 'storymagazine')->orderBy('updated_at', 'desc')->get();
      $magazineStorys = $magazine->storys()->get();
			$mediafile = $this->mediafile;
			$mediafiles = $magazine->mediafiles;
      JavaScript::put([
          'jsis' => 'foobar',
          'magazinestorys' => $magazineStorys->toArray()
      ]);



      return view('admin.magazine.edit', compact('magazine', 'storys', 'mediafiles','mediafile'));
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
      $magazine = $this->magazine->findOrFail($id);
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
        $magazine = $this->magazine->findOrFail($id);
        return view('admin.magazine.confirm', compact('magazine'));
    }
		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int  $id
		 * @return \Illuminate\Http\Response
		 */
		public function delete(Request $request)
		{
			$magazine = $this->magazine->findOrFail($request->get('id'));
			$magazine->delete();
			flash()->warning('Magazine has been deleted.');
			return redirect(route('admin.magazine.index'));//->with('status', 'Story has been deleted.');
		}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $magazine = $this->magazine->findOrFail($id);
      $magazine->delete();
      flash()->warning('Magazine has been deleted.');
      return redirect(route('admin.magazine.index'));
    }
}
