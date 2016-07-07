<div class="box-tools">
	<div class="btn-toolbar btn-group-sm">
		{{-- <div class="input-group input-group-sm" style="width: 150px;">
			<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
			<div class="input-group-btn">
				<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
			</div>
		</div> --}}
		<a href="/admin/{{$rte}}" class="btn bg-orange {{ set_active($path,'disabled') }}"><i class="fa fa-list"></i></a>

	<a href="/admin/{{$rte}}/create" class="btn bg-orange {{ set_active($path.'/create', 'disabled') }}"><i class="fa fa-plus-square"></i></a>
	</div><!-- /.btn-toolbar -->

</div><!-- /.box-tools -->
