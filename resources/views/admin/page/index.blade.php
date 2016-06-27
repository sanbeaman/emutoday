@extends('admin.layouts.adminlte')

@section('title', 'View Pages')
	@section('style-plugin')
		@parent
			<!-- daterange picker -->
	<link rel="stylesheet" href="/themes/adminlte/plugins/daterangepicker/daterangepicker-bs3.css">
	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="/themes/adminlte/plugins/datepicker/datepicker3.css">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="/themes/adminlte/plugins/iCheck/all.css">
	<!-- Bootstrap Color Picker -->
	<link rel="stylesheet" href="/themes/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.css">
	<!-- Bootstrap time Picker -->
	<link rel="stylesheet" href="/themes/adminlte/plugins/timepicker/bootstrap-timepicker.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="/themes/adminlte/plugins/select2/select2.min.css">

	<link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="/themes/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
			@endsection
			@section('scripthead')
						{{-- @include('admin.layouts.scriptshead') --}}
			@show
			@include('include.js')
	@section('content')

		<!-- Main content -->
		<section class="content">
			<a href="{{ route('admin.page.create') }}" class="button">Create New Page</a>

			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Bordered Table</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<table class="table table-bordered">
						<tr>
							<th style="width: 10px">ID</th>
                <th>template</th>
                <th>uri</th>
                <th>start date</th>
                <th>end date</th>
                <th>updated at</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            @foreach($pages as $page)
                <tr>
                    <td><a href="{{ route('admin.page.show', $page->id) }}">{{ $page->id }}</a></td>
                    <td>{{ $page->template }}</td>
                    <td>{{ $page->uri }}</td>
                    <td>{{ $page->start_date }}</td>
                    <td>{{ $page->end_date }}</td>
                    <td>{{ $page->updated_at}}</td>
                    <td>
                        <a href="{{ route('admin.page.edit', $page->id) }}">
                          <i class='fa fa-pencil'></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.page.confirm', $page->id) }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
	</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
</section>
@endsection

@section('footer-plugin')
	@parent
@endsection


@section('footer-script')
	@parent
@endsection
