<?php

namespace emutoday\Http\Controllers\Admin;


use emutoday\Page;
use emutoday\Story;
use emutoday\StoryImage;

use Illuminate\Http\Request;
use JavaScript;
use emutoday\Http\Requests;

class PagesController extends Controller
{

    protected $pages;

    public function __construct(Page $pages, Story $storys, StoryImage $storyImages)
    {
        $this->pages = $pages;
        $this->storys = $storys;
        $this->storyImages = $storyImages;
    }

    public function index()
    {
        $pages = $this->pages->orderBy('updated_at', 'desc')->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function create(Page $page)
    {

        return view('admin.pages.create', compact('page'));
    }

    public function store(Requests\StorePageRequest $request)
    {
        $page = $this->pages->create(
        [ 'user_id' => auth()->user()->id ] + $request->only('template', 'uri', 'start_date', 'end_date')

    );
        flash()->success('Page has been created.');
        return redirect(route('admin.pages.edit', $page->id));//->with('status', 'Story has been created.');
    }

    public function show($id)
    {
        $page = $this->pages->findOrFail($id);
        // $storyImages = $this->storyImages->get();
        // $storys =  $this->storys->orderBy('updated_at', 'desc')->take(8)->get();
        // $storyImages = $this->pages->storyImages();
        $storyImages = $this->pages->storyImages();
        return view('admin.pages.preview', compact('page', 'storyImages'));

    //    return view('admin.pages.show', compact('page'));
    }

    /**
     * Confirm the deletion of record
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function confirm($id)
    {
        $page = $this->pages->findOrFail($id);
        return view('admin.pages.confirm', compact('page'));
    }

    public function edit($id)
    {
        $page = $this->pages->findOrFail($id);
        $storyImages = $this->storyImages->get();
        // $storysWithHero = $this->storys->whereHas('storyImages', function ($query) {
        //     $query->where('image_type', 'imagehero');
        // })->get();
        $storys =  $this->storys->where('story_type', '!=', 'storybasic')->orderBy('updated_at', 'desc')->get();
        $connectedStorys = $page->storys->get();

        JavaScript::put([
            'jsis' => 'foobar',
            'storysonpage' => $connectedStorys->toArray()
        ]);
        return view('admin.pages.edit', compact('page', 'storys', 'storyImages', 'storysWithHero'));
    }

    public function update(Requests\UpdatePageRequest $request, $id)
    {
        $page = $this->pages->findOrFail($id);
        $storyIDString =  $request->get('story_ids');
        $storyIDarray = explode(",", $storyIDString);
        $storyIDarrayCount = count($storyIDarray);
        $storyIDsForPivotArray;

         for ($x = 0; $x < $storyIDarrayCount; $x++) {
            // $attributes = array()
             //$pushval = $storyIDarray[$x] . " => ['page_position' => " . intval($x) . "]";
             $namedKey = $storyIDarray[$x];
             $attributeArray = array();
             $attributeArray["page_position"] = intval($x);
             $attributeArray["note"] = 'some notes';
             $storyIDsForPivotArray[intval($namedKey)] = $attributeArray;
             //array_push($storyIDsForPivotArray, $pushval);
         }
        $page->storys()->sync($storyIDsForPivotArray);
        $page->uri = $request->uri;
        $page->start_date = \Carbon\Carbon::parse($request->start_date);
        $page->end_date = \Carbon\Carbon::parse($request->end_date);
        $page->is_active = $request->is_active;
        $page->save();

        //$story->fill($request->only('title', 'slug', 'subtitle', 'teaser','content','story_type'))->save();
        flash()->success('Page has been updated.');
        return redirect(route('admin.pages.edit', $page->id));
        //return redirect(route('admin.story.edit', $story->id))->with('status', 'Story has been updated.');
    }


    public function destroy($id)
    {
        $page = $this->pages->findOrFail($id);
        $page->delete();
        flash()->warning('Page has been deleted.');
        return redirect(route('admin.pages.index'));//->with('status', 'Story has been deleted.');
    }


}
