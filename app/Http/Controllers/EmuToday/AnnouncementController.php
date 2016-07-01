<?php

namespace emutoday\Http\Controllers\EmuToday;
use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use emutoday\Announcement;

use emutoday\Http\Requests\StoreAnnouncementRequest;

use Carbon\Carbon;
use JavaScript;


class AnnouncementController extends Controller
{
  protected $announcements;

  public function __construct(Announcement $announcement)
  {
      $this->announcement = $announcement;
  }

  // public function index($id = null)
  public function index($id = null)
  {

      $announcements = $this->announcement->paginate(4);
      return view('public.announcement.index', compact('announcements', 'id'));

  }

	public function create(Announcement $announcement)
	{

		return view('public.announcement.form', compact('announcement'));
	}


	public function store(StoreAnnouncementRequest $request)
	{
		$announcements = $this->announcement->create($request->only('title', 'announcement', 'start_date', 'end_date'));
		flash()->success('Announcement has been saved and will be sent for approval');
		return redirect(route('emu-today.announcement.index'));
	}
	public function edit($id)
	{

	}

	public function update()
	{

	}
}
