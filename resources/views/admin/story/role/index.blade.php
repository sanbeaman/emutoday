@extends('admin.layouts.adminlte')
@section('title', 'Story')
	@section('style-vendor')
		@parent
	@endsection

	@section('style-plugin')
		@parent
		<!-- DataTables -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.css">
	@endsection
	@section('style-app')
		@parent
	@endsection
@section('content')
	@include('admin.layouts.modal')
	<div class="box">
		<div class="box-header">
			<div class="row">
				<div class="col-md-8">
						<h3 class="box-title">Story List</h3>
				</div><!-- /.col-md-5 -->
				<div class="col-md-4">
					<div class="box-tools">
						@if(isset($storys))
						<div class="input-group input-group-sm pull-left" style="width: 150px;">
							<input type="text" name="table_search" class="form-control" placeholder="Search">

							<div class="input-group-btn">
								<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
							</div>
						</div>
						@endif
						<div class="btn-group btn-group-sm pull-right">
							<a href="{{ route('admin_story_setup', ['stype' => 'storybasic']) }}" class="btn bg-orange"><i class="fa fa-plus-square"></i></a>
						</div><!-- /.btn-group -->
					</div>
				</div><!-- /.col-md-7 -->
			</div><!-- /.row -->
		</div><!-- /.box-header -->
	@if(isset($storys))

		<div class="box-body table-responsive no-padding">
			<table class="table table-hover">

				<tr>
					<th class="text-center">ID</th>
					<th class="text-left">Type</th>
					<th class="text-left">Title</th>
					<th class="text-center">Approved</th>
					<th class="text-left">Start Date</th>
					<th class="text-left">End Date</th>
					<th class="text-center">Preview</th>
					<th class="text-center">Edit</th>
					<th class="text-center">Delete</th>
				</tr>
				<tr>

					@foreach($storys as $story)
							<tr>
								<td>
										{{ $story->id }}
								</td>
									<td>{{ $story->story_type }}</td>
									<td>{{ $story->title }}</td>
									<td><i class='fa {{$story->is_approved == 1 ? 'fa-check-square-o' :'fa-square-o'}}'></i></td>
									<td>{{ $story->start_date }}</td>
									<td>{{ $story->end_date }}</td>
									<td>
											<a href="{{ route('admin.story.show', $story->id) }}">
												<i class="fa fa-eye"></i>

											</a>
									</td>
									<td>
											<a href="{{ route('admin.story.edit', $story->id) }}">
												<i class="fa fa-pencil"></i>

											</a>
									</td>
									<td>
											<i class="fa fa-trash"></i>
											{{-- <a href="{{ route('admin.role.confirm', $permission->id) }}">
																<i class="fa fa-trash"></i>
											</a> --}}
									</td>
							</tr>
					@endforeach
				@endif
				</tr>

			</table>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->




@endsection
@section('footer-plugin')
	@parent
	<script src="/themes/admin-lte/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/themes/admin-lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/themes/admin-lte/plugins/fastclick/fastclick.js"></script>
@endsection



@section('footer-script')
	@parent




	@endsection