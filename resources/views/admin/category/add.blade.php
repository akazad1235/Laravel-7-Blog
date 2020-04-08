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
			<form action="{{ route('categories.store')}}" method="POST">
				@csrf
			  <div class="form-group">
			    <label >Category Name</label>
			    <input type="text" class="form-control" name="name" >
			  </div>
			
			<div class="form-group">
			    <label for="email">Status</label>
			     <div class="radio">
				  <label><input type="radio" name="status" checked value="1">Active</label>
				  <label><input type="radio" name="status" value="0">Inactive</label>
				</div>
				
			  </div>
			  <button type="submit" class="btn btn-primary">Save Category</button>
			</form>
			</div>
		</div>
	</div>

@endsection
<!-- called for sidebar -->
@section('sidebar')
	@includeIf('admin.components.sidebar')
@endsection