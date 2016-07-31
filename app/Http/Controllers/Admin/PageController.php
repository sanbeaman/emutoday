<?php

namespace emutoday\Http\Controllers\Admin;


use emutoday\Page;
use emutoday\Story;
use emutoday\StoryImage;

use Illuminate\Http\Request;
use JavaScript;
use emutoday\Http\Requests;

class PageController extends Controller
{

    protected $page;

    public function __construct(Page $page, Story $story, StoryImage $storyImage)
    {
        $this->page = $page;
        $this->story = $story;
        $this->storyImage = $storyImage;
    }

    public function index()
    {
        $pages = $this->page->orderBy('updated_at', 'desc')->get();

        return view('admin.page.index', compact('pages'));
    }

    public function create(Page $page)
    {

        return view('admin.page.create', compact('page'));
    }

    public function store(Requests\StorePageRequest $request)
    {
        $page = $this->page->create(
        [ 'user_id' => auth()->user()->id ] + $request->only('template', 'uri', 'start_date', 'end_date')

    );
        flash()->success('Page has been created.');
        return redirect(route('admin.page.edit', $page->id));//->with('status', 'Story has been created.');
    }

    public function show($id)
    {
        $page = $this->page->findOrFail($id);
        // $storyImages = $this->storyImages->get();
        // $storys =  $this->storys->orderBy('updated_at', 'desc')->take(8)->get();
        // $storyImages = $this->pages->storyImages();
        $storyImages = $this->page->storyImages();
        return view('admin.page.preview', compact('page', 'storyImages'));

    //    return view('admin.pages.show', compact('page'));
    }

    /**
     * Confirm the deletion of record
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function confirm($id)
    {
        $page = $this->page->findOrFail($id);
        return view('admin.page.confirm', compact('page'));
    }

    public function edit($id)
    {
        $page = $this->page->findOrFail($id);
        // $storyImages = $this->storyImage->get();
        // $storysWithHero = $this->storys->whereHas('storyImages', function ($query) {
        //     $query->where('image_type', 'imagehero');
        // })->get();
        // $storyimgs = $this->storyImage->where('image_type','front')
                // 																		->orWhere('image_type', 'small')
                // 																		->orderBy('updated_at', 'desc')->get();
        // $storys =  $this->story->where('story_type', '!=', 'news')->orderBy('updated_at', 'desc')->get();
                $storys = Story::where([
                                ['story_type','!=' ,'news'],
                                ['is_approved',1],
                    ])->with('images')->get();

                $connectedStorys = $page->storys()->get();

        JavaScript::put([
            'jsis' => 'foobar',
            'storysonpage' => $connectedStorys->toArray()
        ]);
        return view('admin.page.form', compact('page', 'storys'));

        // return view('admin.page.edit', compact('page', 'storys'));

    }

    public function update(Requests\UpdatePageRequest $request, $id)
    {
        $page = $this->page->findOrFail($id);
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
        return redirect(route('admin.page.edit', $page->id));
        //return redirect(route('admin.story.edit', $story->id))->with('status', 'Story has been updated.');
    }

        public function delete(Request $request)
        {
            $page = $this->page->findOrFail($request->get('id'));
            $page->delete();
            flash()->warning('Page has been deleted.');
            return redirect(route('admin.page.index'));//->with('status', 'Story has been deleted.');
        }
    public function destroy($id)
    {
        $page = $this->page->findOrFail($id);
        $page->delete();
        flash()->warning('Page has been deleted.');
        return redirect(route('admin.page.index'));//->with('status', 'Story has been deleted.');
    }


}
