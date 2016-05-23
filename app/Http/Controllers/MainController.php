<?php

namespace emutoday\Http\Controllers;

use Illuminate\Http\Request;

use emutoday\Http\Requests;

use emutoday\Story;
use emutoday\Page;
use emutoday\Announcement;
use emutoday\Event;

use Carbon\Carbon;
use JavaScript;

class MainController extends Controller
{
    protected $pages;

    public function __construct(Page $pages, Story $storys, Announcement $announcements, Event $events)
    {
        $this->pages = $pages;
        $this->storys = $storys;
        $this->announcements = $announcements;
        $this->events = $events;


    }

    public function index()
    {
        $currentDateTime = Carbon::now();
        // $page = $this->pages->where([
        //     ['start_date', '<=', $currentDateTime],
        //     ['end_date', '>=', $currentDateTime],
        // ])->first();
        $page = $this->pages->where('is_active', 1)->first();
        $currentStorysBasic = $this->storys->where('story_type', 'storybasic')->paginate(5);
        $currentAnnouncements = $this->announcements->paginate(5);
        $barImgs = collect();
        $storys = $page->storys()->get();

        foreach ($storys as $story) {
            if ($story->pivot->page_position === 0) {
                $heroImg = $story->storyImages()->where('image_type', 'imagehero')->first();
            } else {
                $barImgs[$story->pivot->page_position] = $story->storyImages()->where('image_type', 'imagesmall')->first(); 
                // $barImgs->push( $story->storyImages()->where('image_type', 'imagesmall')->first() );
            }

        }
       //$events = $this->events->where(['start_date', '>=', $currentDateTime])->orderBy('start_date','desc')->get();
        $events = $this->events->orderBy('start_date','asc')->paginate(4);

        $storyImages = $page->storyImages();

        JavaScript::put([
            'jsis' => 'hi',
            'cdnow' => Carbon::now(),
            'cdstart' => Carbon::now()->subDays(7),
            'cdend' => Carbon::now()->addDays(7),
            'currentPage' => $page
        ]);

        return view('public.index', compact('page', 'storyImages', 'heroImg', 'barImgs', 'currentStorysBasic', 'currentAnnouncements', 'events'));

    }

    public function main($story_type, $id)
    {
        $story = $this->storys->findOrFail($id);
        $mainStoryImage =  $story->storyImages()->where('image_type', 'imagemain')->first();

        $sideStorysFeatured = $this->storys->where([
            ['story_type', 'storypromoted'],
            ['id', '<>', $id],
            ])->orderBy('created_at', 'desc')->take(3)->get();
        $sideStorysStudent = $this->storys->where([
            ['story_type', 'storystudent'],
            ['id', '<>', $id],
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
