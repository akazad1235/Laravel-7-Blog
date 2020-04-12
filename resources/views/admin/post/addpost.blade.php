@extends('components.layout')

@section('content')
	<div class="col-md-8">
		@if(Session('message'))
				<div class="alert alert-{{Session('type') }}">{{Session('message')}}</div>
			
		@endif
		<div class="card">

			<div class="card-header">
				<div class="heading float-left">
					<h5>Add Post</h5>
				</div>
				<div class="heading float-right">
					<a href=" "><button class="btn btn-info">Add Post</button></a>
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
			<form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
				@csrf
			  <div class="form-group">
			    <label for="name">Title</label>
			    <input type="text" class="form-control" name="name" >
			  </div>

			  <div class="form-group">
			    <label for="catName">Category Name</label>
			    <select id="catName"  class="form-control" name="category">
			    	<option>Select</option>
			    	
			    	 @foreach ($category as $value)
			                <option value="{{ $value->id}}">{{ $value->name}}</option>
			            @endforeach
			    </select>
			  </div>

			   <div class="form-group">
			    <label for="content">Content</label>
			    <textarea class="form-control" name="content" id="content"></textarea>
			  </div>

			    <div class="form-group">	
			   <label for="img">Image</label>
			  		<input type="file" class="form-control" name="image" id="img" >
			  	</div> 

			  <div class="form-group">
			    <label for="catName">Status</label>
			    <select id="catName"  class="form-control" name="status">
			    	<option>Select</option>
			    	<option value="published">Published</option>
			    	<option value="draft">Draft</option>
			    </select>
			  </div>
			
	
			  <button type="submit" class="btn btn-primary">Save Post</button>
			</form>
			</div> 
		</div>
	</div>

@endsection
<!-- called for sidebar -->
@section('sidebar')
	@includeIf('admin.components.sidebar')
@endsection