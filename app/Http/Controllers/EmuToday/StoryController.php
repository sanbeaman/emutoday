<?php

namespace emutoday\Http\Controllers\EmuToday;
use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use emutoday\Story;
use emutoday\StoryImage;
use Carbon\Carbon;
use JavaScript;


class StoryController extends Controller
{
    protected $storys;

    public function __construct(Story $storys, StoryImage $storyImages)
    {

        $this->storys = $storys;
    }

    public function index($id = null)
    {
        if ($id == null) {
          $storys = $this->storys->where('story_type', 'storypromoted')
                                  ->orWhere('story_type', 'storybasic')
                                  ->orderBy('created_at', 'desc')
                                  ->paginate(8);
                                  // dd($storys->count());
          return view('public.story.index', compact('storys'));

        } else {
          $story = $this->storys->findOrFail($id);

          $mainStoryImage = $story->storyImages()->where('image_type', 'imagemain')->first();


          $sideFeaturedStorys = $this->storys->where([
              ['story_type', 'storypromoted'],
              ['id', '<>', $id],
              ])->orderBy('created_at', 'desc')->with('storyImages')->take(3)->get();

              $sideStoryBlurbs = collect();
              foreach ($sideFeaturedStorys as $sideFeaturedStory) {
                  $sideStoryBlurbs->push($sideFeaturedStory->storyImages()->where('image_type', 'imagesmall')->first());
              }


          $sideStudentStorys = $this->storys->where([
              ['story_type', 'storystudent'],
              ['id', '<>', $id],
          ])->orderBy('created_at', 'desc')->take(3)->get();
          $sideStudentBlurbs = collect();
          foreach ($sideStudentStorys as $sideStudentStory) {
              $sideStudentBlurbs->push($sideStudentStory->storyImages()->where('image_type', 'imagesmall')->first());
          }
          // dd($sideStoryBlurbs->first()->present()->mainImageURL);

          return view('public.story.main', compact('story', 'mainStoryImage', 'sideStoryBlurbs','sideStudentBlurbs'));
        }

    }

}
