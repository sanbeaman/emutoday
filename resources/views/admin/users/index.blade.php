@extends('admin.layouts.adminlte')

@section('title', 'Users')

    @section('content')
        <a href="{{ route('admin.users.create') }}" class="button">Create New User</a>
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
											<th>Email</th>
			                <th>Last Name</th>
											<th>First Name</th>
											<th>Phone</th>
											<th>Roles</th>
			                <th>Edit</th>
			                <th>Delete</th>
										</tr>
										<tr>
											@foreach($users as $user)
					                <tr>
														<td>
																<a href="#">{{ $user->id }}</a>
														</td>
														<td>
																<a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->email }}</a>
														</td>
														  <td>{{ $user->last_name }}</td>
															<td>{{ $user->first_name }}</td>

					                    <td>{{ $user->phone }}</td>
															<td>{{ $user->roles->pluck('name') }}</td>
					                    <td>
					                        <a href="{{ route('admin.users.edit', $user->id) }}">
																		<i class="fa fa-pencil"></i>

					                        </a>
					                    </td>
					                    <td>
					                        <a href="{{ route('admin.users.confirm', $user->id) }}">
					                                	<i class="fa fa-trash"></i>
					                        </a>
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
    {!! $users->render() !!}

    @endsection
