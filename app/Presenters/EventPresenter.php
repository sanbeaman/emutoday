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


}
