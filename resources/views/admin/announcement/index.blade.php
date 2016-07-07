@extends('admin.layouts.adminlte')

@section('title', 'Announcement')
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
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Announcement List</h3>
						@include('admin.layouts.components.boxtools', ['rte' => 'announcement', 'path' => 'admin/announcement'])

					</div><!-- /.box-header -->
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
			var table = $('#main-announcement-table').DataTable({
				"ajax": "/api/announcement",
				"columns": [
					{"data": "id"},
					{"data": "title"},
					{"data": "approved",
	 						"render": function ( data, type, row ) {
								var checkicon = (data == 1)?'check-square-o' :'square-o';
								return "<i class='fa fa-"+checkicon+"'></i>";
										}
					},
					{"data": "promoted",
							"render": function ( data, type, row ) {
								var checkicon = (data == 1)?'check-square-o' :'square-o';
								return "<i class='fa fa-"+checkicon+"'></i>";
										}
					},
					{"data": "start_date"},
					{"data": "end_date"},
					{"date": null,
						"defaultContent": "<a href='#'><i class='fa fa-pencil'></i></a>"
					},
					{"date": null,
					"defaultContent": "<a href='#'><i class='fa fa-trash'></i></a>"

						// "defaultContent": "<button type='button' class='btn btn-xs btn-default btn-flat' data-toggle='modal' data-target='#confirm-delete'><i class='fa fa-trash'></i></button>"
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
			});

			$('#main-announcement-table tbody').on('click', '.fa-trash', function () {

				var data = table.row( $(this).parents('tr') ).data();
				var dataid = data["id"];
				var recordid = 'Record ID: ' + dataid;

				var datatitle = data["title"];
				var modal = $('#modal-confirm-delete').modal('show');
				modal.find('#modal-confirm-title').html('Delete Announcement');
				modal.find('#record-info').html(datatitle);
				modal.find('#record-id').html(recordid);
				modal.find('#hidden-id').val(dataid);

				document.getElementById("btn-confirm-delete").addEventListener("click", function(){
					form = document.getElementById('admin_destroy');
					form.id = 'announcement_id';
					form.action = '/admin/announcement/delete';
					form._method = 'POST';
					form.submit();
				});
				//alert('/admin/announcement/'+ data["id"] + '/confirm')
				// window.location.href = '/admin/story/'+ data["id"] + '/confirm';

			})


 // 		function sendDelete(){
 //
 //    form = document.getElementById('admin_destroy');
 //    form.id = 'announcement_id';
 //    form.action = 'admin_announcement_delete';
 //    form._method = 'DELETE';
 //    alert(form.action);  // --- returns "undefined"
 //    //form.submit();
 // }
			// $("#stype1").change(function (e) {
			// 	console.log('	table.draw()');
			// 		table.draw();
			// });
			//
			// $("#main-story-table_length").prepend($("#stype-filter"));
		});
		// $('#confirm-delete').on('show.bs.modal', function(e) {
		// 		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
		//
		// 		$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
		// });
</script>
@endsection
