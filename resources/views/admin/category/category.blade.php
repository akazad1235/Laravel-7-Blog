@extends('components.layout')

@section('content')
	<div class="col-md-8">
		@if(Session('message'))
				<div class="alert alert-{{Session('type') }}">{{Session('message')}}</div>
			
		@endif


		<div class="card">

			<div class="card-header">
				<div class="heading float-left">
					<h5>Wellcome to cat panel</h5>
				</div>
				<div class="heading float-right">
					<a href="{{ route('categories.create')}} "><button class="btn btn-info">Add Category</button></a>
				</div>
				@if ($errors->any())
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif
			
			</div>
			<div class="card-body">
				<table class="table border">
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Status</th>
						<th>Action</th>
						
					</tr>
					
					@foreach($cat as $value)
						<tr>
						<td>{{ $value->id}}</td>
						<td>{{ $value->name}}</td>
						<td>
							<p class="text text-{{ ($value->status === 1 ? 'success' : 'danger') }}">{{ ($value->status === 1 ? 'Active' : 'Inactive') }} </p>
						</td>
						<td>
							<a href="{{route('categories.edit', [$value->id, $value->name, $value->slug, $value->status])}}" class="btn btn-success">Edit</a>
							

							<form action="{{route('categories.delete', $value->id )}}" method="post">
								@CSRF
								@method('delete')
							<button type="submit" class="btn btn-danger" name="delete">Update</button>
							</form>
							
						</td>
					</tr>
					@endforeach
					
				</table>
				{{ $cat->links() }} 
				{{ $cat->count() }} to {{ $cat->lastItem() }} page{{$cat->total()}}
			
			</div>
		</div>

	</div>

@endsection

@section('sidebar')
	@includeIf('admin.components.sidebar')
@endsection