@extends('admin.layouts.adminlte')

@section('title', 'Users')

    @section('content')
        <a href="{{ route('admin.users.create') }}" class="button">Create New User</a>
				<section class="content">
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header with-border">
									<h3 class="box-title">User Table</h3>
									@include('admin.layouts.components.boxtools', ['rte' => 'users', 'path' => 'admin/users'])
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
