<?php

namespace emutoday\Http\Controllers\Admin;

use emutoday\Story;
use emutoday\StoryImage;
use emutoday\Tag;
use emutoday\User;
use emutoday\Imagetype;
use emutoday\StoryType;
use emutoday\Emutoday\Transformers\FractalStoryTransformer;
use emutoday\Emutoday\Transformers\FractalStoryExtraTransformer;
use emutoday\Emutoday\Transformers\StoryTransformer;

use League\Fractal\Manager;
use League\Fractal;
use Illuminate\Http\Request;
use emutoday\Http\Requests;
use DB;
use JavaScript;

class StoryController extends Controller
{
    private $story;

    public function __construct(Story $story, StoryTransformer $storyTransformer)
    {
        $this->story = $story;
        $this->storyTransformer = $storyTransformer;
    }


    public function queue(Story $story) {
          $storys = $this->story;

            \JavaScript::put([
                    'records' => $storys
            ]);
        return view('admin.story.app', compact('storys'));
    }
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    // public function index(Request $request)
    // {
    //     $user = auth()->user();
    //         if($user == null)
    //         {
    //             return redirect(route('admin.dashboard'));
    //         }
    //     $storys =   $this->story->newQuery();
    //         if ($user->hasRole('contributor_1'))
    //         {
    //             $storys = $storys->where('author_id', $user->id)->get();
    //               return view('admin.story.role.index', compact('storys'));
    //         } else {
    //             $stype = $request->get('stype');
    //             $order = $request->get('order');
    //             $dir = $request->get('dir');
    //             $page_appends = null;
    //
    //             if (!$stype || $stype == 'all') {
    //                 $stype = 'all';
    //             } else {
    //                 $storys = $this->story->ofStoryType($stype)->get();
    //                 dd($storys);
    //                 // $storys->storyTypes()->where('group', $stype);
    //                 // where('story_type', $stype);
    //             }
    //
    //             if (!$order && !$dir) {
    //         $order = 'created_at';
    //                     $dir = 'desc';
    //     }
    //             $storys = $storys->orderBy($order, $dir);
    //             // Tell the Paginator to append the following to the page URL as well
    //             $page_appends = [
    //                     'order' => $order,
    //                     'dir' => $dir,
    //             ];
    //     $storys = $storys->paginate(5);
    //             // $stypes = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
    //             $stypes = \emutoday\StoryType::all()->pluck('group','group');
    //             $stypes = $stypes->prepend('all', 'all');
    //
    //             $data['storys'] = $storys;
    //              $data['dir'] = $dir == 'asc' ? 'desc' : 'asc';
    //              $data['page_appends'] = $page_appends;
    //             $data['stype'] = $stype;
    //             $data['stypes'] = $stypes;
    //
    //             return view('admin.story.index', $data);
    //             }
    // }
    //



        public function index(){
            $stypes = \emutoday\StoryType::all()->pluck('group','group');
            $stypes = $stypes->prepend('all', 'all');
            $stype = 'all';
            \JavaScript::put([
                    'stype' => 'all'
            ]);
                      //
                    //   $data['storys'] = $storys;
                    //    $data['dir'] = $dir == 'asc' ? 'desc' : 'asc';
                    //    $data['page_appends'] = $page_appends;
                    //   $data['stype'] = $stype;
                    //   $data['stypes'] = $stypes;

            return view('admin.story.index', compact('stype','stypes'));
        }
        public function list($stype)
        {
            //$storys = $this->story->where('story_type', $stype)->get();
            $stypes = $stype;
            \JavaScript::put([
                    'stype' => $stype
            ]);
            return view('admin.story.index', compact('stype', 'stypes'));
            // return view('admin.story.index', compact('stype'));

        }

        /**
         * Route::get('story/setup/{stype}/', ['as' => 'admin_story_setup', 'uses' => 'Admin\StoryController@setup']);
         * @param  [type] $stype [description]
         * @return [type]        [description]
         */
    public function setup($stype)
    {
        $story = new Story;
        $stypelist = \emutoday\StoryType::where('level', 1)->lists('name','shortname');

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

        return view('admin.story.form', compact('story', 'stypes','stypelist'));


    }
        /**
         * Route::get('magazine/article/setup', ['as' => 'admin_magazine_article_setup', 'uses' => 'Admin\StoryController@articleSetup']);
         * @return [type]        [Direct route for creating a magazine article]
         */
    public function articleSetup()
    {
        $story = new Story;
                $stypelist = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
                $stypes = 'article';
          $story->story_type = $stypes;
        JavaScript::put([
            'storytype' => $stypes
        ]);

        return view('admin.story.form', compact('story', 'stypes','stypelist'));

    }



            /**
             * [storyTypeSetUp description]
             * @param  [type] $stype [description]
             * @return [type]        [description]
             */
        public function storyTypeSetUp($stype)
        {
            $story = new Story;

            $user = \Auth::user();
            if ($user->hasRole('contributor_1')){
                // dd($user->id);
                $stypelist = 'news';

            } else {
            $stypelist = \emutoday\StoryType::where('level', 1)->pluck('name','shortname');

            }

            // $stypelist = \emutoday\StoryType::where('level', 1)->lists('name','shortname');

            if($stype == 'story') {
                $stypes = $stypelist;

            } else {
                $stypes = $stype;
                $story->story_type = $stypes;
            }

            JavaScript::put([
                    'stypes' => $stypes,
                    'storytype' => $stype
            ]);

            return view('admin.story.form', compact('story','stypes','stypelist'));

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
            if ($stype == 'external'){
                    return view('admin.story.external', compact('story', 'stype'));
            } else {
                return view('admin.story.create', compact('story', 'stype'));
            }
        } else {
            $stypes = $stype;
            $stypelist = \emutoday\StoryType::where('level', 1)->lists('name','shortname');

            return view('admin.story.form', compact('story', 'stypes','stypelist'));

            // return view('admin.story.form', compact('story', 'storyTypes'));
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

        // dd($request->all());
        //
      //  dd($request->end_date);
             $pubStartDate = $request->start_date;
             $pubEndDate = $request->end_date;
        // $pubStartDate = $request->start_date == null ?\Carbon\Carbon::now() : \Carbon\Carbon::parse($request->start_date) ;
        // $pubEndDate = $request->end_date == null ? null:  \Carbon\Carbon::parse($request->end_date);

        $story = $this->story->create(
        // ['author_id' => auth()->user()->id] + ['story_type' => $request->input('story_type') ] +  $request->only('title', 'slug', 'subtitle', 'published_at', 'teaser','content')

         ['author_id' => auth()->user()->id] + $request->only('title', 'slug', 'subtitle', 'teaser','content', 'external_link', 'story_type') + ['start_date' => $pubStartDate] + ['end_date' => $pubEndDate ]

        );
                $storyGroup = $story->storyType->group;

                if($storyGroup != 'news') {

                    $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
                    $otherImages = Imagetype::ofGroup($storyGroup)->isRequired(0)->get();
                    $stypelist = StoryType::where('level', 1)->lists('name','shortname');
                    $stypes = $story->story_type;

                    foreach ($requiredImages as $img) {
                            $story->storyImages()->create([
                                'imagetype_id'=> $img->id,
                                'group'=> $storyGroup,
                                'image_type'=> $img->type,
                                'image_name'=> 'img' . $story->id . '_' . $img->type
                        ]);
                    }
                }
        // //Auth::user()->storys()->create($request->all());
        // if ($story->story_type == 'storyexternal') {
        //     $storyImage = $story->storyImages()->create([
        //             'image_name'=> 'img' . $story->id . '_small',
        //             'image_type'=> 'imagesmall',
        //         ]);
        //     // flash()->success('Story has been created.');
        //     // return redirect(route('admin_story_form',['stype' => $story->story_type, $story->id] ));//->with('status', 'Story has been created.');
                //
                //
        // } else {




            // if($story->story_type != 'storybasic')
            // {
            //     $storyImage = $story->storyImages()->create([
            //         'image_name'=> 'img' . $story->id . '_small',
            //         'image_type'=> 'imagesmall',
            //     ]);
            //     $storyImage = $story->storyImages()->create([
            //         'image_name'=> 'img' . $story->id . '_main',
            //         'image_type'=> 'imagemain',
            //     ]);
            // }
                        if($story->story_type == 'article'){
                            flash()->success('Article has been created.');
                            return redirect(route('admin_magazine_article_edit', $story->id));

                        } else {
                            flash()->success('Story has been created.');
                    return redirect(route('admin.story.edit', $story->id));
                        }

        //->with('status', 'Story has been created.');
    }
        public function addNewImage($id, Request $request)
        {
                $story = $this->story->findOrFail($id);
                $storyGroup = $story->storyType->group;
// dd($request->all());
                $story->storyImages()->create([
                    'imagetype_id'=> $request->img_id,
                    'group'=> $storyGroup,
                    'image_type'=> $request->img_type,
                    'image_name'=> 'img' . $story->id . '_' . $request->img_type

                    ]);

                    if($request->img_type == 'front') {
                        $story->is_featured = 1;
                        $story->save();
                    }

                // $storyImage = $story->addImage('hero');


                // $storyImage = $story->storyImages()->create([
                //         'image_name'=> 'img' . $story->id . '_hero',
                //         'image_type'=> 'imagehero',
                //     ]);

                flash()->success('New Image Added.');
                return redirect(route('admin.story.edit', $story->id));


        }

    public function addImage($id)
    {
        $story = $this->story->findOrFail($id);
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

        public function promoteStory($id, Request $request)
    {
        $story = $this->story->findOrFail($id);
        //return 'working on it' . $story->id;
        //
                $story->story_type = $request->new_story_type;
                $story->save();
                $storyGroup = $story->storyType->group;


                $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
                $otherImages = Imagetype::ofGroup($storyGroup)->isRequired(0)->get();
                $stypelist = StoryType::where('level', 1)->lists('name','shortname');
                $stypes = $story->story_type;

                foreach ($requiredImages as $img) {
                        $story->storyImages()->create([
                            'imagetype_id'=> $img->id,
                            'group'=> $storyGroup,
                            'image_type'=> $img->type,
                            'image_name'=> 'img' . $story->id . '_' . $img->type

                    ]);
                }


                flash()->success('Story has been Promoted.');
                // return view('admin.story.form', compact('story', 'stypes', 'tags','stypelist','requiredImages','otherImages'));

                 return redirect(route('admin.story.edit', $story->id));

    }
        public function storyTypePreview($stype, Story $story)
        {
            // $ruteurl = "/emu-today/".$stype."/".$story->id;
          // return redirect(route('admin.story.edit', $story->id));
            return redirect()->route('emutoday_preview',['stype'=> $stype, 'id' => $story->id]);
            // return view('public.story.main', compact('story', 'mainStoryImage', 'sideStoryBlurbs','sideStudentBlurbs'));

        }

        // Route::get('story/{stype}/{story}/edit', ['as' => 'admin_story_type_edit', 'uses' => 'Admin\StoryController@storyTypeEdit']);

        public function storyTypeEdit($stype, Story $story)
        {

            $stypes = $stype;
            $stypelist = \emutoday\StoryType::where('level', 1)->lists('name','shortname');

            $tags = \emutoday\Tag::lists('name', 'id');

            if ($stype == 'emutoday'){
                $stype = 'story';
            }
            $storyGroup = $story->storyType->group;
            $stypes = $stype;
            $story->story_type = $stype;
            // dd($storyGroup);
            $imagetypeNames = Imagetype::ofGroup($storyGroup)->get()->keyBy('id');
            $currentStoryImages = $story->storyImages->pluck('image_type','imagetype_id');
            $leftOverImages = $imagetypeNames->diffKeys($currentStoryImages);
            // dd($leftOverImages);
            $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
            $otherImages = Imagetype::ofGroup($storyGroup)->isRequired(0)->get();

            $storyasarray = $this->storyTransformer->transform($story);

            $storydata = json_encode($storyasarray);

            // return $this->respond([
            // 				'data' => $this->storyTransformer->transformCollection($storys->all())
            // 		]);
            // }
            // $storyj = $story->toJson();
            JavaScript::put([
                        'story' => $story,
                        'stype' => $stype,
                        'storytype' => $story->story_type,
                        'is_featured' => $story->is_featured,
                ]);

            return view('admin.story.form', compact('story', 'stypes','storydata', 'tags','stypelist','requiredImages','otherImages', 'leftOverImages'));

        }

    public function edit($id)
    {
        $story = $this->story->findOrFail($id);
        if ($story->story_type == 'emutoday'){
            $story->story_type = 'story';
        }
        $stypes = $story->story_type;
        $tags = \emutoday\Tag::lists('name', 'id');
        $stypelist = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
        JavaScript::put([
                            'stype' => $stypes,
                            'storytype' => $story->story_type,
                            'is_featured' => $story->is_featured,
                    ]);
                    $user = auth()->user();
                    if($user == null)
                    {
                        return redirect(route('admin.dashboard'));
                    }


                if ($user->hasRole('contributor_1'))
                {
                    $stypelist = $story->story_type;
                    $storyGroup = $story->storyGroup->group;
                    $imagetypeNames = null;
                    $currentStoryImages = null;
                    $leftOverImages = null;
                    // dd($leftOverImages);
                    $requiredImages = null;
                    $otherImages = null;



                    // return view('admin.story.role.form', compact('story', 'stypes', 'tags'));
                    return view('admin.story.form', compact('story', 'stypes', 'tags','stypelist','requiredImages','otherImages', 'leftOverImages'));

                } else {
                    $storyGroup = $story->storyGroup->group;
                    $imagetypeNames = Imagetype::ofGroup($storyGroup)->get()->keyBy('id');
                    $currentStoryImages = $story->storyImages->pluck('image_type','imagetype_id');
                    $leftOverImages = $imagetypeNames->diffKeys($currentStoryImages);
                    // dd($leftOverImages);
                    $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
                    $otherImages = Imagetype::ofGroup($storyGroup)->isRequired(0)->get();
                    return view('admin.story.form', compact('story', 'stypes', 'tags','stypelist','requiredImages','otherImages', 'leftOverImages'));

              // return view('admin.story.form', compact('story', 'stypes', 'tags','stypelist',''));
                }


    }
    public function update(Requests\UpdateStoryRequest $request, $id)
    {

      // dd($request->input('tags'));

        $story = $this->story->findOrFail($id);

        $story->fill($request->only('title', 'slug', 'subtitle', 'teaser','content','external_link', 'story_type','is_approved', 'is_featured'));
        $story->start_date = \Carbon\Carbon::parse($request->start_date);
        $story->end_date = $request->end_date == null ? null:  \Carbon\Carbon::parse($request->end_date);
        $story->save();
        $taglistRequest = $request->input('tag_list') == null ? [] : $request->input('tag_list');
        $story->tags()->sync($taglistRequest);

        $storyGroup = $story->storyGroup->group;
        $requiredImages = Imagetype::ofGroup($storyGroup)->isRequired(1)->get();
        $countRequiredImages = $requiredImages->count();


        $currentStoryImages = $story->storyImages()->where('is_active', 1)->get();
        $countCurrentStoryImages = $currentStoryImages->count();

        if($countCurrentStoryImages >= $countRequiredImages){
            $story->is_promoted = 1;
        } else {
            $story->is_promoted = 0;
        }
        $story->save();




        // $story->syncTags($story, $request->input('tag_list'));


        flash()->success('Story has been updated.');
        return redirect(route('admin.story.edit', $story->id));
        //return redirect(route('admin.story.edit', $story->id))->with('status', 'Story has been updated.');
    }

    public function confirm($id)
    {
        $story = $this->story->findOrFail($id);


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
        $story = $this->story->findOrFail($id);
        $stype = $story->story_type;

        if ($stype == 'external') {
                    $smallStoryImg = $story->storyImages()->where('image_type', 'small')->first();

            return view('admin.story.previewexternal', compact('story','smallStoryImg'));
        } else if ($stype == 'news') {

            return view('admin.story.preview', compact('story'));
        } else {

          $mainStoryImg = $story->storyImages()->where('image_type', 'story')->first();

          $smallStoryImg = $story->storyImages()->where('image_type', 'small')->first();
          // dd($smallStoryImg);
          return view('admin.story.preview', compact('story','mainStoryImg','smallStoryImg'));
        }


    }

    public function destroy($id)
    {
        $story = $this->story->findOrFail($id);
        $story->delete();
        flash()->warning('Story has been deleted.');
        return redirect(route('admin.story.index'));//->with('status', 'Story has been deleted.');
    }


        // public function imageUpload(Request $request)
        // {
        // $file = $request->file('upload');
        // $uploadDestination = public_path() . '/imgs/uploads/story';
        //
        // $filename = preg_replace('/\s+/', '', $file->getClientOriginalName());
        // $fileName = md5($filename) . "_" . $filename;
        // $file->move($uploadDestination, $fileName);
        // }

        // public function imageBrowse(Request $request)
        // {
        // 	$test = $_GET['CKEditorFuncNum'];
        // 	$images = [];
        // 	$files = \File::files(public_path() . '/imgs/uploads/story');
        // 	foreach ($files as $file) {
        // 		$images[] = pathinfo($file);
        // 	}
        //
        // 	return view('admin.story.imageview',[
        // 				'files' => $images,
        // 				'test' => $test
        // 	]);
        // 	}

        public function imageBrowse(Request $request)
            {
                dd($request->all());
                $this->validate($request, [
                    'image' => 'required|dimensions:max_width=900,max_height=500|size:3000|'
                ]);
                $CKEditor = Input::get('CKEditor');
                  $funcNum = Input::get('CKEditorFuncNum');
                    $message = $url = '';
                    $uploadDestination = public_path() . '/imgs/uploads/story/';

                    if (Input::hasFile('upload')) {
                    $file = Input::file('upload');
                    if ($file->isValid()) {
                        $filename = $file->getClientOriginalName();
                        $file->move($uploadDestination, $filename);
                        $url = $uploadDestination . $filename;
                    } else {
                        $message = 'An error occured while uploading the file.';
                    }
                } else {
                    $message = 'No file uploaded.';
                }
                return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';

            }
            // Route::post('/upload_image', function() {
            public function imageUpload(Request $request)
            {


                    $file = $request->file('upload');


                    $uploadDestination = public_path() . '/imgs/uploads/story/';
                    $filename = preg_replace('/\s+/', "", $file->getClientOriginalName());
                    $fileName = md5($filename) . "_" . $filename;
                    $file->move($uploadDestination, $fileName);
            }
            // });

    private function syncTags(Story $story, array $tags)
    {
      $story->tags()->sync($tags);

    }

}
