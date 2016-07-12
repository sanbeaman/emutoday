<?php

namespace emutoday\Http\Controllers;

use Illuminate\Http\Request;

use emutoday\Http\Requests;

use emutoday\Story;
use emutoday\Page;
use emutoday\Announcement;
use emutoday\Event;
use emutoday\Tweet;
use Carbon\Carbon;
use JavaScript;

class MainController extends Controller
{
    protected $pages;

    public function __construct(Page $page, Story $story, Announcement $announcement, Event $event)
    {
        $this->page = $page;
        $this->story = $story;
        $this->announcement = $announcement;
        $this->event = $event;


    }

    public function index()
    {
        $currentDateTime = Carbon::now();
        // $page = $this->page->where([
        //     ['start_date', '<=', $currentDateTime],
        //     ['end_date', '>=', $currentDateTime],
        // ])->first();
        $page = $this->page->where('is_active', 1)->first();
        $currentStorysBasic = $this->story->where('story_type', 'storybasic')->paginate(3);
        $currentAnnouncements = $this->announcement->paginate(3);
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

        return view('public.hub', compact('page', 'storyImages', 'heroImg', 'barImgs', 'currentStorysBasic', 'currentAnnouncements', 'events','tweets'));

    }

    public function main($story_type, $id)
    {
        $story = $this->story->findOrFail($id);
        $mainStoryImage =  $story->storyImages()->where('image_type', 'story')->first();

        $sideStorysFeatured = $this->story->where([
            ['story_type', 'storypromoted'],
            ['id', '<>', $id],
						['is_approved', 1],
            ])->orderBy('created_at', 'desc')->take(3)->get();
        $sideStorysStudent = $this->story->where([
            ['story_type', 'storystudent'],
            ['id', '<>', $id],
						['is_approved', 1],
        ])->orderBy('created_at', 'desc')->take(3)->get();

        JavaScript::put([
            'jsis' => 'hi',
            'cdnow' => Carbon::now(),
            'cdstart' => Carbon::now()->subDays(7),
            'cdend' => Carbon::now()->addDays(7),
            'cstory' => $story
        ]);
        return view('public.story.main', compact('story','mainStoryImage', 'sideStorysFeatured', 'sideStorysStudent'));

    }
}
