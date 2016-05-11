<?php

namespace emutoday\Presenters;

use Laracasts\Presenter\Presenter;

class EventPresenter extends Presenter
{
  public function eventStartDateMonth(){

        //return $this->start_date;
        return  date_format($this->start_date, "M");
    }
    public function eventStartDateDay(){

      //  return $this->start_date;
        return  date_format($this->start_date, "d");
    }

    public function eventListDateString(){

      return date_format($this->start_date, 'D F j\\, Y');
    }

    //From 10:00 AM to 5:00 PM
    public function displayTimeRange()
    {
      return 'From ' . $this->start_time . 'to ' . $this->end_time;
    }

}
