<?php
namespace emutoday\Http\Controllers\EmuToday;

use emutoday\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use emutoday\Event;
use Carbon\Carbon;
use JavaScript;
class EventController extends Controller
{

  protected $events;

  public function __construct(Event $event)
  {
    $this->event = $event;
  }

	public function save()



}
