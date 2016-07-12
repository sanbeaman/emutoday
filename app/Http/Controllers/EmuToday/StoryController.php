<?php

namespace emutoday\Http\Controllers\EmuToday;
use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use emutoday\Story;
use emutoday\StoryImage;
use emutoday\Imagetype;
use Carbon\Carbon;
use JavaScript;


class StoryController extends Controller
{
    protected $storys;

    public function __construct(Story $storys, StoryImage $storyImage, Imagetype $imagetype)
    {

        $this->storys = $storys;
				$this->storyImage = $storyImage;
				$this->imagetype = $imagetype;
    }

    public function index($id = null)
    {
        if ($id == null) {
          $storys = $this->storys->where('story_type', 'storypromoted')
                                  ->orWhere('story_type', 'storybasic')
                                  ->orderBy('start_date', 'desc')
                                  ->paginate(8);
                                  // dd($storys->count());
          return view('public.story.index', compact('storys'));

        } else {
          $story = $this->storys->findOrFail($id);
					// $mainStoryImage = $story->storyImages()->ofType('imagemain')->first();
					$mainStoryImages = $story->storyImages()->get();
					foreach($mainStoryImages as $mainimg){
						if($mainimg->imgtype->type == 'story') {
							$mainStoryImage = $mainimg;
							break;
						}
					}
					// dd($mainStoryImage);
					//
          // $mainStoryImage = $story->storyImages()->where('image_type', 'imagemain')->first();
					// $small_type_imgs = $this->imagetype
					// 						->where('name', 'emutoday_small')
					// 						->orWhere('name','student_small')
					// 						->get();
					// $small_story_imgs = $small_type_imgs
					// 						->storyImgs;

					// $storyImages = $this->storyImage->with('imagetype.imgtype')->get();
						//  dd($imagetypes);


							$sideFeaturedStorys = $this->storys->where([
									['story_type', 'storypromoted'],
									['id', '<>', $id],
									['is_approved', 1],
									])->orderBy('created_at', 'desc')->with('storyImages')->take(3)->get();

									$sideStoryBlurbs = collect();
									foreach ($sideFeaturedStorys as $sideFeaturedStory) {
											$sideStoryBlurbs->push($sideFeaturedStory->storyImages()->where('image_type', 'emutoday_small')->first());
									}

          $sideStudentStorys = $this->storys->where([
              ['story_type', 'storystudent'],
              ['id', '<>', $id],
								['is_approved', 1],
          ])->orderBy('created_at', 'desc')->take(3)->get();
          $sideStudentBlurbs = collect();
          foreach ($sideStudentStorys as $sideStudentStory) {
              $sideStudentBlurbs->push($sideStudentStory->storyImages()->where('image_type', 'student_small')->first());
          }
          // dd($sideStoryBlurbs->first()->present()->mainImageURL);
					// dd($sideFeaturedStorys);
          return view('public.story.main', compact('story', 'mainStoryImage', 'sideStoryBlurbs','sideStudentBlurbs'));
        }

    }

}
