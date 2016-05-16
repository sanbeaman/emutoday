<?php

namespace emutoday\Http\Controllers\EmuToday;
use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use emutoday\Announcement;

use Carbon\Carbon;
use JavaScript;


class AnnouncementController extends Controller
{
  protected $announcements;

  public function __construct(Announcement $announcements)
  {
      $this->announcements = $announcements;
  }

  public function index($id = null)
  {

      $announcements = $this->announcements->paginate(4);
      return view('public.announcement.index', compact('announcements', 'id'));

  }
}
