<?php

namespace emutoday\Http\Controllers\Admin;


use emutoday\Story;
use emutoday\User;
use emutoday\Tweet;

class DashboardController extends Controller
{

    public function index(Story $storys, User $users, Tweet $tweets)
    {
       $tweets = Tweet::orderBy('created_at','desc')->paginate(5);
      //  $tweetsApproved = emutoday\Tweet::where('approved',1)->orderBy('created_at','desc')->take(5)->get();

        // $storys = $storys->orderBy('updated_at', 'desc')->take(5)->get();
        // $users = $users->whereNotNull('last_login_at')->orderBy('last_login_at', 'desc')->take(5)->get();
        //flash()->info("butttttttttt");
        return view('admin.dashboard', compact('tweets'));

    }
}
