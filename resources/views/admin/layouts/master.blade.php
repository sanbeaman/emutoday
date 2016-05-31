<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')  &mdash; EMU</title>
    @section('style')
          @include('admin.layouts.styles')
    @show
    @section('scripthead')
          @include('admin.layouts.scriptshead')
    @show
    @include('include.js')
  </head>

  <body>
<header id="header" class="header">
</header>
<div data-sticky-container>
  <div data-sticky data-margin-top='0' data-top-anchor="header:bottom" data-btm-anchor="content:bottom">
    <div class="top-bar">
      <div class="top-bar-title">
        <ul class="menu">
          <li><span class="navbar-text">Hello, {{ $admin->name }}</span></li>
          <li><a href="{{ route('auth.logout') }}">Logout</a></li>
        </ul>
      </div> <!--  top-bar-title -->
      <div class="top-bar-right">
        <ul class="menu">
          <li><a href="/admin/dashboard">Dashboard</a></li>
          <li><a href="/admin/users">Users</a></li>
          <li><a href="/admin/story">Story List</a></li>
          <li><a href="/admin/storyimages">Images</a></li>
          <li><a href="/admin/page">Pages</a></li>
          <li><a href="/admin/magazine">Magazine</a></li>
          <li><a href="/admin/announcement">Announcements</a></li>
          <li><a href="/admin/event">Events</a></li>
          <li><a href="/admin/twitter">Twitter</a></li>
        </ul>
      </div> <!-- top-bar-right -->

    </div> <!--  top-bar -->
  </div> <!--  data-sticky -->

</div><!--  data-sticky-container-->
<div class="container row column" id="content">
      @include('flash::message')
      @include('admin/partials.errors')
      @yield('content')
  </div>
  @section('footer')
    @include('admin.layouts.scriptsfooter')
    <script>
    $('.top-bar').on('sticky.zf.stuckto:top', function(){
  $(this).addClass('shrink');
}).on('sticky.zf.unstuckfrom:top', function(){
  $(this).removeClass('shrink');
})

</script>
  @show
</body>
</html>
