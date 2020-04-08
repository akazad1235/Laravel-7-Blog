@extends('components.layout')

@section('content')
	<div class="col-md-8">
		@if(Session('message'))
				<div class="alert alert-{{Session('type') }}">{{Session('message')}}</div>
			
		@endif
		<div class="card">

			<div class="card-header">
				<h5>User Register</h5>
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
			<form action="{{ route('register')}}" method="POST" enctype="multipart/form-data">
				@csrf
			  
			  <div class="form-group">
			    <label for="name">Name</label>
			    <input type="name" class="form-control" name="name" id="name">
			  </div>

			   <div class="form-group">
			    <label for="email">Email address</label>
			    <input type="email" class="form-control" name="email" id="email">
			  </div>


			  <div class="form-group">	
			    <label for="pass">Password</label>
			    <input type="password" class="form-control" name="password" id="pass" >
			  </div>

			  <div class="form-group">	
			    <label for="re-pass">Re-Password</label>
			    <input type="password" class="form-control" name="password_confirmation" id="re-pass" >
			  </div>

			   <div class="form-group">	
			   <label for="img">Image</label>
			  		<input type="file" class="form-control" name="image" id="img" >
			  	</div> 


			  <button type="submit" class="btn btn-primary">Register</button>
			</form>
			</div>
		</div>
	</div>

@endsection

<!-- called for sideber -->
 @section('sideber')
    @includeIf('components.sideber')

@endsection
