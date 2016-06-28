<?php

namespace emutoday\Http\Controllers\Api;

use Illuminate\Http\Request;

use emutoday\Http\Requests;
use emutoday\Page;

use emutoday\Emutoday\Transformers\FractalPageTransformer;
use League\Fractal\Manager;
use League\Fractal;

class PageController extends ApiController
{
	/**
	 * @var page
	 */
	protected $page;

	function __construct(Page $page)
	{
			$this->page = $page;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

			$fractal = new Manager();

			$page = Page::all();

			$resource = new Fractal\Resource\Collection($page->all(), new FractalPageTransformer);
				// Turn all of that into a JSON string
				return $fractal->createData($resource)->toJson();
			// return $this->respond([
			//     'data' => $this->storyTransformer->transformCollection($storys->all())
			// ]);
	}

	public function delete(Request $request)
	{
		$page = $this->page->findOrFail($request->get('id'));
		$page->delete();
		flash()->warning('Page has been deleted.');
		return redirect(route('admin.page.index'));//->with('status', 'Story has been deleted.');
	}



}
