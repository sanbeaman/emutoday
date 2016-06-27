@extends('admin.layouts.adminlte')

@section('title', 'View Magazines')
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
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Magazine List</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<table id="main-magazine-table" class="table table-bordered table-hover">
							<thead>
								<tr>
										<th class="text-center">ID</th>
										<th class="text-left">Year</th>
										<th class="text-left">Season</th>
										<th class="text-center">Title</th>
										<th class="text-center">Published</th>
										<th class="text-center">Archived</th>
										<th class="text-left">Start Date</th>
										<th class="text-left">Edit</th>
										<th class="text-left">Delete</th>
								</tr>
							</thead>

						</table>
						{{-- {!! $storys->render() !!} --}}
						{{-- {{ $storys->links() }} --}}
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->


	</section>
	<!-- /.content -->
    <a href="{{ route('admin.magazine.create') }}" class="button">Create New Magazine</a>


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
	<script>


		$(function () {

			var table = $('#main-magazine-table').DataTable({
				"ajax": "/api/magazine",
				"columns": [
					{"data": "id"},
					{"data": "year"},
					{"data": "season"},
					{"data": "title"},
					{"data": "published"},
					{"data": "archived"},
					{"data": "start_date"},
					{"date": null,
						"defaultContent": "<i class='fa fa-pencil'></i>"
					},
					{"date": null,
						"defaultContent": "<i class='fa fa-trash'></i>"
					}
				]
			});
			//
			// function openroute(rte,id){
			// 	window.location.href =
			// }
			//

			$('#main-magazine-table tbody').on('click', '.fa-pencil', function () {

				var data = table.row( $(this).parents('tr') ).data();
			//	var storyid = data["id"];
				window.location.href = '/admin/magazine/'+ data["id"] + '/edit';

				//openroute('edit',data["id"]);
				// var data = table.row( $(this).parents('tr') ).data();
				// 	alert( data["id"]);
			});

			$('#main-magazine-table tbody').on('click', '.fa-trash', function () {

				var data = table.row( $(this).parents('tr') ).data();
			//	var storyid = data["id"];
				window.location.href = '/admin/magazine/'+ data["id"] + '/confirm';

				//openroute('edit',data["id"]);
				// var data = table.row( $(this).parents('tr') ).data();
				// 	alert( data["id"]);
			})


		});
</script>

	@endsection
