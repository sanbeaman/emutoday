<?php

namespace emutoday\Http\Controllers;

use Illuminate\Http\Request;

use emutoday\Http\Requests;

use emutoday\Story;
use emutoday\Page;
use Carbon\Carbon;
use JavaScript;

class MainController extends Controller
{
    protected $pages;

    public function __construct(Page $pages, Story $storys)
    {
        $this->pages = $pages;
        $this->storys = $storys;

    }

    public function index(Page $pages)
    {
        $currentDateTime = Carbon::now();

        $page = $this->pages->whereBetween('start_date',[Carbon::now()->subDays(7), Carbon::now()->addDays(7)] )->first();
        // $storys = $page->storys()->get();
        $currentStorys = $page->storys()->get();
        $currentStorysBasic = $this->storys->where('story_type', 'storybasic')->paginate(5);
        $barImgs = collect();
        foreach ($page->storys as $story) {
            if ($story->pivot->page_position === 0) {
                $heroImg = $story->storyImages()->where('image_type', 'imagehero')->first();
            } else {
                $barImgs->push( $story->storyImages()->where('image_type', 'imagesmall')->first() );
            }

        }

        $storyImages = $page->storyImages();

        JavaScript::put([
            'jsis' => 'hi',
            'cdnow' => Carbon::now(),
            'cdstart' => Carbon::now()->subDays(7),
            'cdend' => Carbon::now()->addDays(7),
            'cstorys' => $currentStorys,
            'currentPage' => $page
        ]);

        return view('public.index', compact('page', 'storyImages', 'heroImg', 'barImgs'));

    }

    public function main($story_type, $id)
    {
        $story = $this->storys->findOrFail($id);

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
        return view('public.story.main', compact('story', 'sideStorysFeatured', 'sideStorysStudent'));

    }
}
