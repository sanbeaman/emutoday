<?php

namespace emutoday\Http\Controllers\Api;

use emutoday\Category;
use emutoday\Event;
use Carbon\Carbon;

use emutoday\Emutoday\Transformers\CategoryTransformer;


class CategoriesController extends ApiController
{

  protected $categoryTransformer;

/**
 * [__construct description]
 * @param [type] $categoryTransformer [description]
 */
  function __construct(CategoryTransformer $categoryTransformer)
  {
    $this->categoryTransformer = $categoryTransformer;
  }
    /**
     * Display a listing of the resource.
     * @param null $eventid
     * @return \Illuminate\Http\Response
     */
    public function index($eventid = null)
    {

      $categories = $this->getCategories($eventid);
       return $this->respond([
          'data' => $this->categoryTransformer->transformCollection($categories->all())
       ]);
    }

    public function activeCategories($currentdate = null)
    {

        if ($currentdate == null) {
          $cd = Carbon::now();
        } else {
            $cd = Carbon::parse($currentdate);
        }

        $activateCategories = Category::with(['events' => function($query) use ($cd) {
              $query->where('start_date', '>', $cd)->addSelect('id','title');
            }])->addSelect('id','category','slug')->get();
          // $cats = Category::with('events')->afterThisDate(Carbon::now()->subYear())->get();
          return $this->respond($activateCategories);
    }
    /**
     * [getCategories description]
     * @param  [type] $eventid [description]
     * @return [type]          [description]
     */
    private function getCategories($eventid)
    {

      $categories = $eventid ? Event::findOrFail($eventid)->categories: Category::all();
      return $categories;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
