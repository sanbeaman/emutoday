@extends('admin.layouts.adminlte')

@section('title', 'Announcement')
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
@section('content')
		@include('admin.layouts.modal');
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Announcement List</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<table id="main-announcement-table" class="table table-bordered table-hover">
							<thead>
								<tr>
		                <th class="text-center">ID</th>
		                <th class="text-left">Title</th>
										<th class="text-center">Approved</th>
										  <th class="text-center">Promoted</th>
											<th class="text-left">Start Date</th>
											<th class="text-left">End Date</th>
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
{{--
			<label id="stype-filter" for="stype">Filter By Type:
		{!! Form::select('stype', $stypes, $stype, ['id'=> 'stype1', 'class' => 'form-control input-sm']) !!}

		</label> --}}

	</section>
	<!-- /.content -->
@endsection
@section('footer-plugin')
	@parent
	<script src="/themes/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="/themes/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/themes/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/themes/adminlte/plugins/fastclick/fastclick.js"></script>
@endsection



@section('footer-script')
	@parent
	<script>
$(function () {
			var table = $('#main-announcement-table').DataTable({
				"ajax": "/api/announcement",
				"columns": [
					{"data": "id"},
					{"data": "title"},
					{"data": "approved",
	 						"render": function ( data, type, row ) {
								var checkpart = (data == 1)? 'checked="checked"': '';
								return '<input type="radio" name="id' + row.id+'" value=1 ' + checkpart + '>';

										}
									},
					{"data": "promoted"},
					{"data": "start_date"},
					{"data": "end_date"},
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

			$('#main-announcement-table tbody').on('click', '.fa-pencil', function () {

				var data = table.row( $(this).parents('tr') ).data();
				window.location.href = '/admin/announcement/'+ data["id"] + '/edit';

				//openroute('edit',data["id"]);
				// var data = table.row( $(this).parents('tr') ).data();
				// 	alert( data["id"]);
			});

			$('#main-announcement-table tbody').on('click', '.fa-trash', function () {

				var data = table.row( $(this).parents('tr') ).data();
				alert('/admin/announcement/'+ data["id"] + '/confirm')
				// window.location.href = '/admin/story/'+ data["id"] + '/confirm';

			})
			// $("#stype1").change(function (e) {
			// 	console.log('	table.draw()');
			// 		table.draw();
			// });
			//
			// $("#main-story-table_length").prepend($("#stype-filter"));
		});

		$('#confirm-delete').on('show.bs.modal', function(e) {
				$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

				$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
		});
</script>
@endsection
