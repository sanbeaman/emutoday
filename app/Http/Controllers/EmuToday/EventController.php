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

    $cd = Carbon::now()->subYear();
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


    $firstOfYear =  Carbon::create($cd->year,1,1);
    $lastDayOfYear = Carbon::create($cd->year,12,31);

  //  $groupedevents = $this->events->whereBetween('start_date', [$firstOfYear, $lastDayOfYear])->get();
    $monthNumber = $cd->month;
    $events_this_year = Event::where( \DB::raw('YEAR(start_date)'), '=', date('Y') )->get();
    $events_this_month = Event::where( \DB::raw('MONTH(start_date)'), '=', $monthNumber )->get();
    $events = $this->events->where('start_date', '>', $cd )->orderBy('start_date', 'asc')->get();

    $groupedevents = $events_this_month->groupBy(function ($item, $key) {
        $startdate = $item['start_date'];
        return $startdate->day;
      //  return substr($item['account_id'], -3);
    });
    JavaScript::put([
        'jsis' => 'hi',
        'currentDate' => Carbon::now(),
        'currentMonth' => $cd->month,
        'currentMonthWord' => $cd->format('M'),
        'currentYear' => $cd->format('Y'),
        'firstOfMonthDayNumber' => $cd->firstOfMonth()->format('w'),
        'dayArray' => $monthArray,
        'dayInMonth' => $dayInMonth,
        'groupedevents' => $groupedevents,



    ]);
    return view('public.event.index', compact('events', 'cd','totalDaysInArray', 'monthArray', 'dayInMonth'));
  }

  public function show()
  {

  }
}
