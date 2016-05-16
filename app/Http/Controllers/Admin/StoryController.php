<?php

namespace emutoday\Http\Controllers\Admin;

use emutoday\Story;
use emutoday\StoryImage;
use emutoday\Tag;

use Illuminate\Http\Request;
use emutoday\Http\Requests;

use JavaScript;

class StoryController extends Controller
{
    protected $storys;

    public function __construct(Story $storys)
    {
        $this->storys = $storys;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $storys = $this->storys->with('author')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.story.index', compact('storys'));
    }

    public function setup($stype)
    {


        $story = new Story;
        if ($stype != 'story' ) {
            $story->story_type = $stype;
            // if ($stype == 'storyexternal'){
            //         return view('admin.story.external', compact('story', 'stype'));
            // } else {
                $stypes = $story->story_type;
                // return view('admin.story.create', compact('story', 'stypes'));
            // }
        } else {
            $stypes = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
            // return view('admin.story.create', compact('story', 'stypes'));
        }
        JavaScript::put([
            'storytype' => $stype
        ]);
        return view('admin.story.create', compact('story', 'stypes'));


    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create($stype)
    {
        $story = new Story;
        if ($stype != 'story' ) {
            if ($stype == 'storyexternal'){
                    return view('admin.story.external', compact('story', 'stype'));
            } else {
                return view('admin.story.create', compact('story', 'stype'));
            }
        } else {
            $storyTypes = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
            return view('admin.story.create', compact('story', 'storyTypes'));
        }

    }


    // public function build(Story $story, $value)
    // {
    //
    //     $storyType = $value;
    //     if ($storyType == 'storyexternal') {
    //         return view('admin.story.buildexternal', compact('story', 'storyType'));
    //     } else {
    //         return view('admin.story.build', compact('story', 'storyType'));
    //     }
    //
    // }


    public function store(Requests\StoreStoryRequest $request)
    {

        //dd($request->input('storyTypes'));
        //
        //
        $pubStartDate = $request->start_date == null ?\Carbon\Carbon::now() : \Carbon\Carbon::parse($request->start_date) ;
        $pubEndDate = $request->end_date == null ? null:  \Carbon\Carbon::parse($request->end_date);

        $story = $this->storys->create(
        // ['author_id' => auth()->user()->id] + ['story_type' => $request->input('story_type') ] +  $request->only('title', 'slug', 'subtitle', 'published_at', 'teaser','content')

         ['author_id' => auth()->user()->id] + $request->only('title', 'slug', 'subtitle', 'teaser','content', 'external_link', 'story_type') + ['start_date' => $pubStartDate] + ['end_date' => $pubEndDate ]

        );

        //Auth::user()->storys()->create($request->all());
        if ($story->story_type == 'storyexternal') {
            $storyImage = $story->storyImages()->create([
                    'image_name'=> 'img' . $story->id . '_small',
                    'image_type'=> 'imagesmall',
                ]);
            // flash()->success('Story has been created.');
            // return redirect(route('admin_story_form',['stype' => $story->story_type, $story->id] ));//->with('status', 'Story has been created.');


        } else {

            if($story->story_type != 'storybasic')
            {
                $storyImage = $story->storyImages()->create([
                    'image_name'=> 'img' . $story->id . '_small',
                    'image_type'=> 'imagesmall',
                ]);
                $storyImage = $story->storyImages()->create([
                    'image_name'=> 'img' . $story->id . '_main',
                    'image_type'=> 'imagemain',
                ]);
            }


        }

        flash()->success('Story has been created.');
        return redirect(route('admin.story.edit', $story->id));//->with('status', 'Story has been created.');
    }


    public function addImage($id)
    {
        $story = $this->storys->findOrFail($id);
        //return 'working on it' . $story->id;
        //
        $storyImage = $story->addImage('hero');


        // $storyImage = $story->storyImages()->create([
        //         'image_name'=> 'img' . $story->id . '_hero',
        //         'image_type'=> 'imagehero',
        //     ]);

        flash()->success('New Image Added.');
        return redirect(route('admin.story.edit', $story->id));


    }
    public function edit($id)
    {
        $story = $this->storys->findOrFail($id);

        $tags = \emutoday\Tag::lists('name', 'id');

        JavaScript::put([
              'storytype' => $story->story_type
          ]);
        return view('admin.story.edit', compact('story', 'tags'));


    }
    public function update(Requests\UpdateStoryRequest $request, $id)
    {

      // dd($request->input('tags'));

        $story = $this->storys->findOrFail($id);

        $story->fill($request->only('title', 'slug', 'subtitle', 'teaser','content','external_link', 'story_type'));
        $story->start_date = \Carbon\Carbon::parse($request->start_date);
        $story->end_date = $request->end_date == null ? null:  \Carbon\Carbon::parse($request->end_date);
        $story->save();
        $taglistRequest = $request->input('tag_list') == null ? [] : $request->input('tag_list');
        $story->tags()->sync($taglistRequest);



        // $story->syncTags($story, $request->input('tag_list'));


        flash()->success('Story has been updated.');
        return redirect(route('admin.story.edit', $story->id));
        //return redirect(route('admin.story.edit', $story->id))->with('status', 'Story has been updated.');
    }

    public function confirm($id)
    {
        $story = $this->storys->findOrFail($id);


        return view('admin.story.confirm', compact('story'));
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $story = $this->storys->findOrFail($id);

        $stype = $story->story_type;

        if ($stype == 'external') {
            return view('admin.story.previewexternal', compact('story'));
        } else if ($stype == 'news') {

            return view('admin.story.previewbasic', compact('story'));
        } else {
          $mainStoryImg = $story->storyImages->where('image_type', 'imagemain')->first();
          $smallStoryImg = $story->storyImages->where('image_type', 'imagesmall')->first();
            return view('admin.story.preview', compact('story','mainStoryImg','smallStoryImg'));
        }


    }

    public function destroy($id)
    {
        $story = $this->storys->findOrFail($id);
        $story->delete();
        flash()->warning('Story has been deleted.');
        return redirect(route('admin.story.index'));//->with('status', 'Story has been deleted.');
    }

    private function syncTags(Story $story, array $tags)
    {
      $story->tags()->sync($tags);

    }

}
