<?php

namespace emutoday\Http\Controllers\Admin;


use emutoday\Page;
use emutoday\Story;

use Illuminate\Http\Request;

use emutoday\Http\Requests;

class PagesController extends Controller
{

    protected $pages;

    public function __construct(Page $pages, Story $storys)
    {
        $this->pages = $pages;
        $this->storys = $storys;
    }

    public function index()
    {
        $pages = $this->pages->orderBy('updated_at', 'desc');

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


    public function edit($id)
    {
        $page = $this->pages->findOrFail($id);
        $storys =  $this->storys->orderBy('updated_at', 'desc')->take(8)->get();
        return view('admin.pages.edit', compact('page', 'storys'));
    }

}
