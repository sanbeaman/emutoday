<?php

namespace emutoday\Http\Controllers\EmuToday;
use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use emutoday\Magazine;
use emutoday\Story;
use Carbon\Carbon;
use JavaScript;

class MagazineController extends Controller
{
    protected $magazine;

    public function __construct(Magazine $magazines, Story $storys)
    {
        $this->magazines = $magazines;
        $this->storys = $storys;

    }

    public function index(Magazine $magazines)
    {
        $currentDateTime = Carbon::now();
        $magazine = $this->magazines->where([
            ['is_published', 1],
            ['is_archived', 0],
        ])->first();
      //  $page = $this->pages->whereBetween('start_date',[Carbon::now()->subDays(7), Carbon::now()->addDays(7)] )->first();
        // $storys = $page->storys()->get();

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
        return view('public.magazine.index', compact('magazine', 'storyImages', 'heroImg', 'barImgs'));

    }

    public function issue($year = null, $season = null)
    {
        $currentDateTime = Carbon::now();
        if ($year == null) {
          $magazine = $this->magazines->where([
              ['is_published', 1],
              ['is_archived', 0],
          ])->first();
        } else {
          $magazine = $this->magazines->where([
              ['year', $year],
              ['season', $season],
          ])->first();
        }

        $storyImages = $this->magazines->storyImages();
        $barImgs = collect();


        foreach ($magazine->storys as $story) {
            if ($story->pivot->story_position === 0) {
                $barImgs->push( $story->storyImages()->where('image_type', 'imagesmall')->first() );
            } else {
                $barImgs->push( $story->storyImages()->where('image_type', 'imagesmall')->first() );
            }

        }
        JavaScript::put([
            'jsis' => 'hi',
        ]);
        // $magazine = $this->magazines->findOrFail($id);
        // $storyImages = $this->magazines->storyImages();
        return view('public.magazine.issue', compact('magazine', 'storyImages', 'barImgs'));

    }
    public function article($year = null, $season = null, $id = null)
    {
        $currentDateTime = Carbon::now();
        if ($year == null) {
          $magazine = $this->magazines->where([
              ['is_published', 1],
              ['is_archived', 0],
          ])->first();
        } else {
          $magazine = $this->magazines->where([
              ['year', $year],
              ['season', $season],
          ])->first();
        }

        if ($id == null) {
          $story = $magazine->storys()->first();
        } else {
          $story = $magazine->storys()->where('id', $id)->first();
        }

        $mainImage = $story->storyImages()->where('image_type', 'imagemain')->first();
        return view('public.magazine.article', compact('magazine','story', 'mainImage'));

    }


}
