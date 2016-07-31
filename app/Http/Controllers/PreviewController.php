<?php

namespace emutoday\Http\Controllers;

use Illuminate\Http\Request;

use emutoday\Http\Requests;
use emutoday\Story;
use emutoday\Event;
use emutoday\Page;
use emutoday\Magazine;
use emutoday\Tweet;
use emutoday\Announcement;

use Carbon\Carbon;
use JavaScript;


/*

Route::get('{stype}/{story}', ['as' => 'preview_story', 'uses' => 'PreviewController@story']);
Route::get('hub/{page}', ['as' => 'preview_hub', 'uses' => 'PreviewController@hub']);
Route::get('magazine/{magazine}', ['as' => 'preview_magazine', 'uses' => 'PreviewController@magazine']);



 */
class PreviewController extends Controller
{


    public function __construct(Page $page, Story $story, Magazine $magazine, Event $event, Announcement $announcement)
    {
        $this->page = $page;
				$this->magazine = $magazine;
        $this->story = $story;
      	$this->event = $event;
				$this->announcement = $announcement;


    }

		public function story($stype, Story $story)
		{

			$mainStoryImage = null;
			$mainStoryImages = $story->storyImages()->where('image_type','story')->get();
			// dd($mainStoryImage);
			foreach($mainStoryImages as $mainimg){
				if($mainimg->imgtype->type == 'story') {
					$mainStoryImage = $mainimg;
					break;
				}
			}
			$sideFeaturedStorys = null;
			$sideStoryBlurbs = collect();

			$sideStudentStorys = null;
			$sideStudentBlurbs = collect();

			$sideNewsStorys = collect();

			if($stype == 'story' || $stype == 'emutoday'){
				$sideStoryBlurbs->push($story->storyImages()->where('image_type', 'small')->first());

				return view('preview.story.story', compact('story', 'mainStoryImage', 'sideStoryBlurbs','sideStudentBlurbs'));

			} else if($stype == 'student'){
				$sideStudentBlurbs->push($story->storyImages()->where('image_type', 'small')->first());

				return view('preview.student.story', compact('story', 'mainStoryImage', 'sideStoryBlurbs','sideStudentBlurbs'));


			} else if($stype == 'article'){
				$magazine = $story->magazine()->first();
				$mainImage = $story->storyImages()->where('image_type','story')->first();
				// dd($magazine);
				$sideStoryBlurbs->push($story->storyImages()->where('image_type', 'small')->first());



			return view('preview.magazine.story', compact('magazine','story', 'mainImage','sideStoryBlurbs','sideNewsStorys'));


			} else {
				return 'no story type';
			}
		}


		// public function hub(Page $page)
		// {
		// 	return 'need to recreate or reroute to correct preview page' . $page;
		// }


    public function hub(Page $page)
    {

        $currentStorysBasic = $this->story->where('story_type', 'news')->paginate(3);
        $currentAnnouncements = $this->announcement->where('is_approved', 1)->orderBy('priority','desc')->paginate(3);
        $barImgs = collect();
        $storys = $page->storys()->get();

        foreach ($storys as $story) {
            if ($story->pivot->page_position === 0) {
                $heroImg = $story->storyImages()->where('image_type', 'front')->first();
            } else {
                $barImgs[$story->pivot->page_position] = $story->storyImages()->where('image_type', 'small')->first();
                // $barImgs->push( $story->storyImages()->where('image_type', 'imagesmall')->first() );
            }

        }
       //$events = $this->event->where(['start_date', '>=', $currentDateTime])->orderBy('start_date','desc')->get();
    //   $fakeDate = Carbon::now()->subYear();
        $events = $this->event->where('start_date', '>=', Carbon::now()->startOfDay())->orderBy('start_date', 'asc')->paginate(4);


        $storyImages = $page->storyImages();
      //  $tweets = Tweet::orderBy('created_at','desc')->paginate(4);
        $tweets = Tweet::where('approved',1)->orderBy('created_at','desc')->take(4)->get();

        JavaScript::put([
            'jsis' => 'hi',
            'cdnow' => Carbon::now(),
            'cdstart' => Carbon::now()->subDays(7),
            'cdend' => Carbon::now()->addDays(7),
            'currentPage' => $page
        ]);

        return view('preview.hub', compact('page', 'storyImages', 'heroImg', 'barImgs', 'currentStorysBasic', 'currentAnnouncements', 'events','tweets'));

    }

    public function student(Story $story)
		{

				$heroImg = $story->storyImages()->where('image_type', 'front')->first();
				$featureImg = $story->storyImages()->where('image_type', 'story')->first();
				$barImgs = collect();
				$barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );

			return view('preview.student.index', compact('heroImg', 'featureImg','barImgs'));
		}

		public function magazine(Magazine $magazine)
		{

			$storyImages = $magazine->storyImages();
			$barImgs = collect();
			$magazineCover = $magazine->mediafiles()->where('type','cover')->first();
			$magazineExtra = $magazine->mediafiles()->where('type','extra')->first();

			foreach ($magazine->storys as $story) {
						if ($story->pivot->story_position === 0) {
								$heroImg = $story->storyImages()->where('image_type', 'front')->first();
						} else {
								$barImgs->push( $story->storyImages()->where('image_type', 'small')->first() );
						}

				}
			return view('preview.magazine.index', compact('magazine', 'storyImages', 'heroImg', 'barImgs', 'magazineCover','magazineExtra'));


		}
}
