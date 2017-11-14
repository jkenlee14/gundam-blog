@extends('layouts.app')

@section('content')
<div class="container-fluid postbody">
	<div class="col-md-10 col-md-offset-1">
	<h3>Posts Under Category: <span class="darkgray">{{$categoryname->name}}</span></h3> <h4 class="postcounter">{{count($categoryname->categoryposts)}}
	@if(count($categoryname->categoryposts)==1)
	Post
	@else
	Posts
	@endif </h4>
		@if(count($categoryposts)>0)
			@foreach($categoryposts as $categorypost)
				<div class="well categorywell">
							<div class="row">
								<div class="col-md-4">
									<img class="img-responsive postimage" src="{{asset('assets/images/' . $categorypost->cover_image)}}">
								</div>
								<div class="col-md-8">
									<h3><a href="/posts/{{$categorypost->id}}">{{$categorypost->title}}</a></h3>
									<small>posted: <abbr title="{{$categorypost->created_at}}">{{$categorypost->created_at->diffForHumans()}}</abbr></small>
									@if ($categorypost->created_at != $categorypost->updated_at)
										<small>edited: <abbr title="{{$categorypost->updated_at}}">{{$categorypost->updated_at->diffForHumans()}}</abbr></small>
									@endif
									<small>posted by: {{$categorypost->user->name}}</small>
									<small>posted in: {{$categorypost->category->name}}</small>
								</div>
							</div>
						</div>
					@endforeach
					<div class="text-center">
					{{$categoryposts->links()}}
					</div>
		@else
			<div class="well margintop">
				<p>No posts in this category!</p>
			</div>
		@endif
	</div>
</div>
@endsection