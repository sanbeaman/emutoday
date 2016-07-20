@extends('admin.layouts.adminlte')
@section('title', 'Bugz')
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
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Announcement List</h3>
				@include('admin.layouts.components.boxtools', ['rte' => 'announcement', 'path' => 'admin/announcement'])
			</div>	<!-- /.box-header -->




	@if(isset($bugzs))

		<div class="box-body table-responsive no-padding">
			<table class="table table-hover">

				<tr>
					<th class="text-center">id</th>
					<th class="text-center">userID</th>
					<th class="text-left">type</th>
					<th class="text-left">screen</th>

					<th class="text-left">notes</th>
						<th class="text-center">priority</th>
							<th class="text-center">response</th>
					<th class="text-center">completed</th>
					<th class="text-center">confirmed</th>
						<th class="text-center">created on</th>
							<th class="text-center">updated on</th>
					<th class="text-center">Edit</th>
					<th class="text-center">Delete</th>
				</tr>
				<tr>

					@foreach($bugzs as $item)
							<tr>
								<td>
										{{ $item->id }}
								</td>
									<td>{{ $item->user_id }}</td>
									<td>{{ $item->type }}</td>
									<td>{{ $item->screen }}</td>
									<td>{{ $item->notes }}</td>
									<td>{{ $item->priority }}</td>
										<td>{{ $item->note_reply }}</td>
									<td><i class='fa {{$item->complete == 1 ? 'fa-check-square-o' :'fa-square-o'}}'></i></td>
									<td><i class='fa {{$item->confirmed == 1 ? 'fa-check-square-o' :'fa-square-o'}}'></i></td>
									<td>{{ $item->created_at }}</td>
									<td>{{ $item->updated_at }}</td>
									<td>
											<a href="{{ route('admin.bugz.edit', $item->id) }}">
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
