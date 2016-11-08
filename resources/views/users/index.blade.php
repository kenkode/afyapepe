@extends('layouts.admin')
@section('content')
<div class="content-page  equal-height">
					<div class="content">
							<div class="container">
	<div class="row">
   <div class="col-lg-12 margin-tb">
    <div class="pull-left">
   <h2>Users Management</h2>
    </div>
	@role('Admin')
  <div class="pull-right">
  <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
</div>
@endrole
	    </div>

	</div>

	@if ($message = Session::get('success'))

		<div class="alert alert-success">

			<p>{{ $message }}</p>

		</div>

	@endif

	<table class="table table-bordered">

		<tr>

			<th>No</th>

			<th>Name</th>

			<th>Email</th>
			<th>Department</th>

			<th>Roles</th>
@role('Admin')
			<th width="280px">Action</th>
@endrole
		</tr>

	@foreach ($data as $key => $user)

	<tr>

		<td>{{ ++$i }}</td>

		<td>{{ $user->name }}</td>

		<td>{{ $user->email }}</td>
    <td>{{ $user->role }}</td>
		<td>

			@if(!empty($user->roles))

				@foreach($user->roles as $v)

					<label class="label label-success">{{ $v->display_name }}</label>

				@endforeach

			@endif

		</td>
@role('Admin')
		<td>

			<a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>

			<a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>

			{!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}

            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

        	{!! Form::close() !!}

		</td>
@endrole
	</tr>

	@endforeach

	</table>

	{!! $data->render() !!}
</div><!--container-->
</div><!--content -->
</div><!--content page-->
@endsection
