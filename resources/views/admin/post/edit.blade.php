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
			<form action="{{route('post.update', $editData->id)}}" method="POST" enctype="multipart/form-data">
				@csrf
				@method("PUT")
			  <div class="form-group">
			    <label for="name">Title</label>
			    <input type="text" class="form-control" name="name"  value="{{ $editData->title}}">
			  </div>

			  <div class="form-group">
			    <label for="catName">Category Name</label>
			    <select id="catName"  class="form-control" name="category_id">
			    	<option>Select</option>
			    	@foreach($categories as $value)
					<option {{ $value->id == $editData->category_id ? 'selected' : '' }}  value="{{ $value->id}}">
						{{ $value->name}}</option>
					
			    	@endforeach
			    </select>
			  </div>

			   <div class="form-group">
			    <label for="content">Content</label>
			    <textarea class="form-control" name="content" id="content">{{ $editData->content}}</textarea>
			  </div>

			    <div class="form-group">	
			   <label for="img">Image</label><br>
			   		<img style="width: 200px; height:150px" src="{{ asset('/uploads/post/'.$editData->thumbnail)}}">
			  		<input type="file" class="form-control mt-3" name="image" id="img" >
			  	</div> 


			  <div class="form-group">
			    <label for="catName">Status</label>
			    <select id="catName"  class="form-control" name="status">
			    	<option>Select</option>
			    	<option {{ $editData->status == 'published' ? 'selected' : '' }} value="published">Published</option>
			    	<option {{ $editData->status == 'draft' ? 'selected' : '' }} value="draft ">Draft</option>
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



