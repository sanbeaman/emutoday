@extends('admin.layouts.adminlte')
@section('title', $event->exists ? 'Editing '.$event->title : 'Create New Event')
	@section('style-vendor')
		@parent
	@endsection

	@section('style-plugin')
		@parent
		<!-- DataTables -->
		<link rel="stylesheet" href="/themes/adminlte/plugins/datatables/dataTables.bootstrap.css">
	@endsection

	@section('style-app')
		@parent
	@endsection


  @section('scripthead')
		@parent
  @endsection
@section('content')
	<!-- Main content -->
	<section class="content">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Event</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div id="mg-event-form-vue">
									<mg-event-form authorid="{{$currentUser->id}}" eventexists="{{$event->exists ? true: false}}" editeventid="{{$event->exists ? $event->id : null }}">
										{{-- <input slot="csrf" type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
									</mg-event-form>
							</div><!-- /#vue-event-form -->

					</div><!-- /.box-body -->
				</div><!-- /.box -->
	</section>

@endsection

@section('footer-vendor')
	{{-- <script src="{{ elixir('js/vendor-scripts.js') }}"></script> --}}
	@parent
@endsection

@section('footer-plugin')
	@parent
@endsection

@section('footer-app')
	{{-- <script>
var AdminLTEOptions = {
	//Enable sidebar expand on hover effect for sidebar mini
	//This option is forced to true if both the fixed layout and sidebar mini
	//are used together
	sidebarExpandOnHover: false,
	//BoxRefresh Plugin
	enableBoxRefresh: true,
	//Bootstrap.js tooltip
	enableBSToppltip: true
};
</script> --}}
{{-- <script src="/themes/admin-lte/dist/js/app.js" type="text/javascript"></script>
	<script src="/js/vue-ajax-form.js" ></script> --}}
@parent
@endsection


@section('footer-script')
@parent
  <script src="/js/mg-event-form-vue.js"></script>
@endsection
