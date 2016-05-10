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

  public function __construct(Event $events)
  {
    $this->events = $events;
  }

  public function index()
  {
    $cd = Carbon::now()->addMonth();
    $dayInMonth = $cd->day;
    $monthArray = [];
    $cd_dayMonthStarts = $cd->firstOfMonth()->dayOfWeek;
    $cd_daysInMonth = $cd->daysInMonth;

    $dayCounter = 0;
    while ($dayCounter < $cd_dayMonthStarts) {
      $monthArray = array_add($monthArray,$dayCounter, ' ');
      $dayCounter++;
    }

    for ($x = 1; $x <= $cd_daysInMonth; $x++){
      $monthArray = array_add($monthArray,$dayCounter, $x);
      $dayCounter++;
    }
    $totalDaysInArray = count($monthArray);

    // $monthDayCollection = collect($monthArray);





    $events = $this->events->orderBy('start_date', 'desc')->paginate(10);
    JavaScript::put([
        'jsis' => 'hi',
        'currentDate' => Carbon::now(),
        'currentMonth' => $cd->month,
        'currentMonthWord' => $cd->format('M'),
        'currentYear' => $cd->format('Y'),
        'firstOfMonthDayNumber' => $cd->firstOfMonth()->format('w'),
        'dayArray' => $monthArray,
        'dayInMonth' => $dayInMonth,



    ]);
    return view('public.event.index', compact('events', 'cd','totalDaysInArray', 'monthArray', 'dayInMonth'));
  }

  public function show()
  {

  }
}
