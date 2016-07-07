@extends('admin.layouts.adminlte')

@section('title', 'Roles')

    @section('content')
        <a href="{{ route('admin.role.create') }}" class="btn btn-success">Create New Role</a>
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<h3 class="box-title">Responsive Hover Table</h3>

									<div class="box-tools">
										<div class="input-group input-group-sm" style="width: 150px;">
											<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

											<div class="input-group-btn">
												<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</div>
								</div>
								<!-- /.box-header -->
								<div class="box-body table-responsive no-padding">
									<table class="table table-hover">
										<tr>
											<th>Id</th>
											<th>Name</th>
			                <th>Label</th>
			                <th>Edit</th>
			                <th>Delete</th>
										</tr>
										<tr>
											@foreach($roles as $role)
					                <tr>
														<td>
																{{ $role->id }}
														</td>
														  <td>{{ $role->name }}</td>
															<td>{{ $role->label }}</td>
					                    <td>
					                        <a href="{{ route('admin.role.edit', $role->id) }}">
																		<i class="fa fa-pencil"></i>

					                        </a>
					                    </td>
					                    <td>
					                        {{-- <a href="{{ route('admin.role.confirm', $role->id) }}">
					                                	<i class="fa fa-trash"></i>
					                        </a> --}}
					                    </td>
					                </tr>
					            @endforeach
										</tr>

									</table>
								</div>
								<!-- /.box-body -->
							</div>
							<!-- /.box -->
						</div>
					</div>
				</section>
				<!-- /.content -->
    {{-- {!! $roles->render() !!} --}}

    @endsection
