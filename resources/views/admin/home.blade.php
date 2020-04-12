@extends('components.layout')

@section('content')
	<div class="col-md-8">
		@if(Session('message'))
				<div class="alert alert-{{Session('type') }}">{{Session('message')}}</div>
			
		@endif


		<div class="card">

			<div class="card-header">
				<h5>Wellcome to admin panel</h5>
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
				
				<a href="{{ route('categories.index') }}" class="btn btn-info">Category</a>
				<a href="{{ route('post.index') }}" class="btn btn-success">Post</a>
			
			</div>
		</div>

	</div>

@endsection

@section('sidebar')
	@includeIf('admin.components.sidebar')
@endsection
