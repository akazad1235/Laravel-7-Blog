@extends('components.layout')

@section('content')
	<div class="col-md-8">
		@if(Session('message'))
				<div class="alert alert-{{Session('type') }}">{{Session('message')}}</div>
			
		@endif
		<div class="card">

			<div class="card-header">
				<h5>User Login</h5>
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
			<form action="{{ route('login')}}" method="POST">
				@csrf
			  
			  <div class="form-group">
			    <label for="email">Email address</label>
			    <input type="email" class="form-control" name="email" id="email">
			  </div>

			  <div class="form-group">	
			    <label for="pass">Password</label>
			    <input type="password" class="form-control" name="password" id="pass" >
			  </div>

			  <button type="submit" class="btn btn-primary">Login</button>
			</form>
			</div>
		</div>
	</div>

@endsection
<!-- called for sidebar -->
 @section('sideber')
    @includeIf('components.sideber')

@endsection
