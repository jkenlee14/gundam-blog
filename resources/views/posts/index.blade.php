@extends('layouts.app')

@section('content')
	<div class="container-fluid postbody">
		<div class="col-md-10 col-md-offset-1">
			<h1>Posts</h1>
			@if(count($posts)>0)
				@foreach($posts as $post)
					<div class="well">
						<div class="row">
							<div class="col-md-4">
								<img class="img-responsive postimage" src="{{asset('assets/images/' . $post->cover_image)}}">
							</div>
							<div class="col-md-8">
								<h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
								<small>posted: <abbr title="{{$post->created_at}}">{{$post->created_at->diffForHumans()}}</abbr></small>
								@if ($post->created_at != $post->updated_at)
									<small>edited: <abbr title="{{$post->updated_at}}">{{$post->updated_at->diffForHumans()}}</abbr></small>
								@endif
								<small>posted by: {{$post->user->name}}</small>
								@if(count($post->category->name)>0)
									<small>posted in: <a href="/categories/{{$post->category->id}}">{{$post->category->name}}</a></small>
								@else
									<small>posted in: N/a</small>
								@endif
							</div>
						</div>
					</div>
				@endforeach
				{{$posts->links()}}
			@else
				<p>No posts found</p>
			@endif
		</div>
	</div>
@endsection