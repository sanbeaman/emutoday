<?php

namespace emutoday\Http\Controllers\Admin;

use Storage;

use emutoday\StoryImage;
use Illuminate\Http\Request;
use emutoday\Http\Requests;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class StoryImageController extends Controller
{

    protected $storyImages;
    public function __construct(StoryImage $storyImages)
    {
        $this->storyImages = $storyImages;
        parent::__construct();
    }

    public function index()
    {
        $storyImages = $this->storyImages->paginate(10);
        return view('admin.storyimages.index', compact('storyImages'));
    }

    public function create(StoryImage $storyImage)
    {
        return view('admin.storyimages.form', compact('storyImage'));
    }

    public function store(Requests\StoryImage_StoreRequest $request)
    {
        $this->storyImages->create($request->only('image_type'));
        //return redirect(route('backend.users.index'))->with('status', 'User has been created.');
    }

    public function addNewStoryImage(Request $request)
    {
        $story_id = $request->story_id;
        $story = $this->story->findOrFail($story_id);
        $stype = $story->story_type;
        $storyGroup = $story->storyType->group;
        $story->storyImages()->create([
            'imagetype_id'=> $request->img_id,
            'group'=> $storyGroup,
            'image_type'=> $request->img_type,
            'image_name'=> 'img' . $story->id . '_' . $request->img_type

        ]);
        // if($request->img_type == 'front') {
        //     $story->is_featured = 1;
        //     $story->save();
        // }
        flash()->success('New Image Added.');
        return redirect(route('admin_storytype_edit', ['stype' => $stype, 'story'=> $story]));

        // return redirect(route('admin.story.edit', $story->id));
    }

    public function update($id, Requests\StoryImage_UpdateRequest $request)
    {
       //create new instance of model to save from form
       $storyImage = $this->storyImages->findOrFail($id);

       $storyImage->image_type = $request->get('image_type');
       $storyImage->is_active = $request->get('is_active');
       $storyImage->title = $request->get('title');
       $storyImage->caption = $request->get('caption');
       $storyImage->teaser = $request->get('teaser');
       $storyImage->moretext = $request->get('moretext');
       $storyImage->link = $request->get('link');
       $storyImage->link_text = $request->get('link_text');

       //define the image paths
       $destinationFolder = '/imgs/story/';

       //assign the image paths to new model, so we can save them to DB
       $storyImage->image_path = $destinationFolder;
       // format checkbox values and save model

       $this->formatCheckboxValue($storyImage);
       //parts of the image we will need
       if ( ! empty(Input::file('image'))){
           $imgFile = Input::file('image');
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
           $storyImage->image_extension = $imgFileExtension;
           $imgFileName = $storyImage->image_name . '.' . $storyImage->image_extension;
           $image = Image::make($imgFilePath)
           ->save(public_path() . $destinationFolder . $imgFileName);
           // ->fit(100)
           // ->save(public_path() . $destinationFolder . 'thumbnails/' . 'thumb-' . $imgFileName);
           $storyImage->filename = $imgFileName;
       }
    //  $storyImage->is_active = 1;
        $storyImage->save();
        $story = $storyImage->story;
        $stype = $story->story_type;
        flash()->success('Image has been updated.');

        return redirect(route('admin_storytype_edit', ['stype' => $stype, 'story'=> $story]));

        // return redirect(route('admin.story.edit', $story->id ));
    }

    public function edit($id)
    {
        $storyImage = $this->storyImages->findOrFail($id);
        return view('admin.storyimages.edit', compact('storyImage'));
    }


    public function show($id)
    {
        $storyImage = $this->storyImages->findOrFail($id);
      // $marketingImage = Marketingimage::findOrFail($id);

       return view('admin.storyimages.show', compact('storyImage'));
    }
    public function confirm($id)
    {
        $storyImage = $this->storyImages->findOrFail($id);

        return view('admin.storyimages.confirm', compact('storyImage'));
    }

    public function destroy($id)
    {
        $storyImage = $this->storyImages->findOrFail($id);

        $pathToImageForDelete = public_path() . $storyImage->image_path . $storyImage->image_name . '.' . $storyImage->image_extension;
        File::delete($pathToImageForDelete);
        flash()->warning('Image has been deleted');

        return redirect()->back();//->with('status', 'Record has been deleted.');
    }
    public function formatCheckboxValue($storyImage)
    {

       $storyImage->is_active = ($storyImage->is_active == null) ? 0 : 1;

    }


}
