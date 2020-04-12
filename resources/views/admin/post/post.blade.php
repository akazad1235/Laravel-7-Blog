@extends('components.layout')

@section('content')
	<div class="col-md-8">
		@if(Session('message'))
				<div class="alert alert-{{Session('type') }}">{{Session('message')}}</div>
			
		@endif


		<div class="card">

			<div class="card-header">
				<div class="heading float-left">
					<h5>All Post List</h5>
				</div>
				<div class="heading float-right">
					<a href="{{ route('post.create') }} "><button class="btn btn-info">Add Post</button></a>
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
						<th>User</th>
						<th>Category</th>
						<th>Title</th>
						<th>Status</th>
						<th>Action</th>
						
					</tr>
					
					@foreach($post as $value)
						<tr>
						<td>{{ $value->id}}</td>
						<td>{{ $value->user->name}}</td>
						<td>{{ $value->category->name}}</td>
						<td>{{ $value->title}}</td>
						<td>
							<p class="text text-{{ ($value->status === 'published' ? 'success' : 'danger') }}">{{ ($value->status === 'published' ? 'Published' : 'Draft') }} </p>
						</td>
						<td>
							<a href="{{ route('post.edit', $value->id)}}" class="btn btn-success">Edit</a>
							

							<form action="{{ Route('post.delete', $value->id)}} " method="post" onclick=" return confirm('Are your Want to Post Delete')">
								@CSRF
								@method('delete')
							<button type="submit" class="btn btn-danger" name="delete">Delete</button>
							</form>
							
						</td>
					</tr>
					@endforeach
					
				</table>
				
			
				{{ $post->links() }} 
				{{ $post->count() }} to {{ $post->lastItem() }} page{{$post->total()}}
			
			
			</div>
		</div>

	</div>

@endsection

@section('sidebar')
	@includeIf('admin.components.sidebar')
@endsection