<?php

namespace emutoday\Http\Controllers\Admin;

use emutoday\Story;
use emutoday\StoryImage;
use emutoday\Tag;
use emutoday\User;

use Illuminate\Http\Request;
use emutoday\Http\Requests;

use JavaScript;

class StoryController extends Controller
{
    private $story;

    public function __construct(Story $story)
    {
        $this->story = $story;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
			$user = auth()->user();
			$storys =   $this->story->newQuery();
			if ($user->hasRole('contributor_1'))
			{
				$storys = $storys->where('author_id', $user->id)->get();
				  return view('admin.story.role.index', compact('storys'));
			} else {




				$stype = $request->get('stype');
				$order = $request->get('order');
				$dir = $request->get('dir');
				$page_appends = null;

				if (!$stype || $stype == 'all') {
					$stype = 'all';
				} else {
					$storys = $storys->where('story_type', $stype);
				}

				if (!$order && !$dir) {
            $order = 'created_at';
						$dir = 'desc';
        }
				$storys = $storys->orderBy($order, $dir);
				// Tell the Paginator to append the following to the page URL as well
				$page_appends = [
						'order' => $order,
						'dir' => $dir,
				];
        $storys = $storys->paginate(5);
				// $stypes = \emutoday\StoryType::where('level', 1)->lists('name','shortname');
				$stypes = \emutoday\StoryType::all()->pluck('name','shortname');
				$stypes = $stypes->prepend('all', 'all');

				$data['storys'] = $storys;
			 	$data['dir'] = $dir == 'asc' ? 'desc' : 'asc';
			 	$data['page_appends'] = $page_appends;
				$data['stype'] = $stype;
				$data['stypes'] = $stypes;



        return view('admin.story.index', $data);
					}
    }

		public function list($stype)
		{
		$storys = $this->story->where('story_type', $stype)->get();
		return view('admin.story.list', compact('storys','stype'));
		}

		/**
		 * Route::get('story/setup/{stype}/', ['as' => 'admin_story_setup', 'uses' => 'Admin\StoryController@setup']);
		 * @param  [type] $stype [description]
		 * @return [type]        [description]
		 */
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
        return view('admin.story.form', compact('story', 'stypes'));


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
      //  dd($request->end_date);
			 $pubStartDate = $request->start_date;
			 $pubEndDate = $request->end_date;
        // $pubStartDate = $request->start_date == null ?\Carbon\Carbon::now() : \Carbon\Carbon::parse($request->start_date) ;
        // $pubEndDate = $request->end_date == null ? null:  \Carbon\Carbon::parse($request->end_date);

        $story = $this->story->create(
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
    public function edit($id)
    {
        $story = $this->story->findOrFail($id);
				$stypes = $story->story_type;
        $tags = \emutoday\Tag::lists('name', 'id');

				$user = auth()->user();

				JavaScript::put([
							'storytype' => $story->story_type
					]);
					
				if ($user->hasRole('contributor_1'))
				{
					return view('admin.story.role.form', compact('story', 'stypes', 'tags'));
				} else {
      		return view('admin.story.form', compact('story', 'stypes', 'tags'));
				}


    }
    public function update(Requests\UpdateStoryRequest $request, $id)
    {

      // dd($request->input('tags'));

        $story = $this->story->findOrFail($id);

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

        if ($stype == 'storyexternal') {
					$smallStoryImg = $story->storyImages()->where('image_type', 'imagesmall')->first();

            return view('admin.story.previewexternal', compact('story','smallStoryImg'));
        } else if ($stype == 'storybasic') {

            return view('admin.story.preview', compact('story'));
        } else {

          $mainStoryImg = $story->storyImages()->where('image_type', 'imagemain')->first();

          $smallStoryImg = $story->storyImages()->where('image_type', 'imagesmall')->first();
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
