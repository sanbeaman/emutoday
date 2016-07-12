<?php

namespace emutoday\Http\Controllers\EmuToday;
use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use emutoday\Story;
use emutoday\StoryImage;
use Carbon\Carbon;
use JavaScript;

class StudentController extends Controller
{
  protected $storys;

  public function __construct(Story $storys)
  {

      $this->storys = $storys;



  }

  public function index($id = null)
  {
      $currentDateTime = Carbon::now();
      if ($id) {
        $story = $this->storys->findOrFail($id);
				$mainStoryImages = $story->storyImages()->get();
				foreach($mainStoryImages as $mainimg){
					if($mainimg->imgtype->type == 'story') {
						$mainStoryImage = $mainimg;
						break;
					}
				}

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
        // $mainStoryImage = $story->storyImages()->where('image_type', 'imagemain')->first();
        // $sideFeaturedStorys = $this->storys->where([
        //     ['story_type', 'storypromoted'],
        //     ['id', '<>', $id],
				// 		['is_approved',1],
        //     ])->orderBy('created_at', 'desc')->with('storyImages')->take(3)->get();
				//
        //     $sideStoryBlurbs = collect();
        //     foreach ($sideFeaturedStorys as $sideFeaturedStory) {
        //         $sideStoryBlurbs->push($sideFeaturedStory->storyImages()->where('image_type', 'imagesmall')->first());
        //     }
				//
				//
        // $sideStudentStorys = $this->storys->where([
        //     ['story_type', 'storystudent'],
        //     ['id', '<>', $id],
        // ])->orderBy('created_at', 'desc')->take(3)->get();
        // $sideStudentBlurbs = collect();
        // foreach ($sideStudentStorys as $sideStudentStory) {
        //     $sideStudentBlurbs->push($sideStudentStory->storyImages()->where('image_type', 'imagesmall')->first());
        // }
        // dd($sideStoryBlurbs->first()->present()->mainImageURL);

        return view('public.student.main', compact('story', 'mainStoryImage', 'sideStoryBlurbs','sideStudentBlurbs'));
      } else {
        $studentStorys = $this->storys->where('story_type', 'storystudent')->get();

        $studentHeroStory = $studentStorys->where('is_featured', 1)->first();



        $heroImg = $studentHeroStory->storyImages()->where('image_type', 'student_front')->first();


        $barImgs = collect();
        foreach ($studentStorys as $ss) {
            $barImgs->push( $ss->storyImages()->where('image_type', 'student_small')->first() );
        }



        JavaScript::put([
            'jsis' => 'hi',

        ]);

        return view('public.student.index', compact('heroImg', 'barImgs'));
      }


  }
}
