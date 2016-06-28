@extends('admin.layouts.adminlte')

@section('title', 'View Pages')
	@section('style-plugin')
		@parent
			<!-- daterange picker -->
	<!-- bootstrap datepicker -->
	<!-- iCheck for checkboxes and radio inputs -->
	<!-- Bootstrap Color Picker -->
	<!-- Bootstrap time Picker -->
	<!-- Select2 -->
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="/themes/admin-lte/plugins/datatables/dataTables.bootstrap.css">

			@endsection
			@section('scripthead')
						{{-- @include('admin.layouts.scriptshead') --}}
			@show
			@include('include.js')
	@section('content')
	@include('admin.layouts.modal')
		<!-- Main content -->


			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Page List Table</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table id="main-page-table" class="table table-bordered table-hover">
						<thead>
							<tr>
									<th class="text-center">id</th>
									<th class="text-left">Template</th>
									<th class="text-left">uri</th>
									<th class="text-left">Active</th>
									<th class="text-left">Start Date</th>
									<th class="text-left">End Date</th>
									<th class="text-left">Edit</th>
									<th class="text-left">Delete</th>
							</tr>
						</thead>
					</table>
				</div><!-- /.box-body -->
					<a href="{{ route('admin.page.create') }}" class="button">Create New Page</a>
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
	<script>
	$(function () {

		var table = $('#main-page-table').DataTable({
			"ajax": "/api/page",
			"columns": [
				{"data": "id"},
				{"data": "template"},
				{"data": "uri"},
				{"data": "active"},
				{"data": "start_date"},
				{"data": "end_date"},
				{"date": null,
					"defaultContent": "<a href='#'><i class='fa fa-pencil'></i></a>"
				},
				{"date": null,
					"defaultContent": "<a href='#'><i class='fa fa-trash'></i></a>"
				}
			]
		});
		//
		// function openroute(rte,id){
		// 	window.location.href =
		// }
		//

		$('#main-page-table tbody').on('click', '.fa-pencil', function () {

			var data = table.row( $(this).parents('tr') ).data();
		//	var storyid = data["id"];
			window.location.href = '/admin/page/'+ data["id"] + '/edit';

			//openroute('edit',data["id"]);
			// var data = table.row( $(this).parents('tr') ).data();
			// 	alert( data["id"]);
		});
		$('#main-page-table tbody').on('click', '.fa-trash', function () {

			var data = table.row( $(this).parents('tr') ).data();
			var dataid = data["id"];
			var recordid = 'Record ID: '+ dataid;
			var datatitle = data["title"];
			var modal = $('#modal-confirm-delete').modal('show');
			modal.find('#modal-confirm-title').html('Delete Page');
			modal.find('#record-info').html(datatitle);
			modal.find('#record-id').html(recordid);
			modal.find('#hidden-id').val(dataid);

			document.getElementById("btn-confirm-delete").addEventListener("click", function(){
				form = document.getElementById('admin_destroy');
				form.id = 'page_id';
				form.action = '/admin/page/delete';
				form._method = 'POST';
				form.submit();
			});
			//alert('/admin/announcement/'+ data["id"] + '/confirm')
			// window.location.href = '/admin/story/'+ data["id"] + '/confirm';

		})
		// $('#main-magazine-table tbody').on('click', '.fa-trash', function () {
		//
		// 	var data = table.row( $(this).parents('tr') ).data();
		// //	var storyid = data["id"];
		// 	window.location.href = '/admin/magazine/'+ data["id"] + '/confirm';
		//
		// 	//openroute('edit',data["id"]);
		// 	// var data = table.row( $(this).parents('tr') ).data();
		// 	// 	alert( data["id"]);
		// })


	});
</script>

@endsection
