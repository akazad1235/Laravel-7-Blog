@extends('components.layout')

@section('content')
	<div class="col-md-8">
		@if(Session('message'))
				<div class="alert alert-{{Session('type') }}">{{Session('message')}}</div>
			
		@endif
		<div class="card">

			<div class="card-header">
				<div class="heading float-left">
					<h5>Wellcome to Edit Category </h5>
				</div>
				<div class="heading float-right">
					<a href="{{ route('categories.index') }} "><button class="btn btn-info">All Category</button></a>
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
			<form action="{{ route('categories.update', $data->id)}}" method="POST">
				@csrf
				@method("PUT")
			  <div class="form-group">
			    <label >Category Name</label>
			    <input type="text" class="form-control" name="name" value="{{ $data->name }}">
			  </div>
			
			<div class="form-group">
			    <label for="email">Status</label>
			     <div class="radio">
				  <label><input type="radio" name="status" value="1" {{ $data->status === 1 ? 'checked':'' }}>Active</label>
				  <label><input type="radio" name="status" value="0" {{ $data->status === 0 ? 'checked':''}}>Inactive</label>
				</div>
				
			  </div>
			  <button type="submit" class="btn btn-primary">Update</button>
			</form>
			</div>
		</div>
	</div>

@endsection
<!-- called for sidebar -->
 @section('sidebar')
	@includeIf('admin.components.sidebar')
@endsection