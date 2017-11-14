@extends('layouts.app')

@section('content')
<div class="container-fluid postbody">
	<div class="col-md-10 col-md-offset-1">
	<h3>Posts Under Tag: <span class="darkgray">{{$tagname->name}}</span></h3> <h4 class="postcounter">{{count($tagname->posts)}} 
	@if(count($tagname->posts)==1)
	Post
	@else
	Posts
	@endif</h4>
		@if(count($tagposts)>0)
			@foreach($tagposts as $tagpost)
				<div class="well categorywell">
							<div class="row">
								<div class="col-md-4">
									<img class="img-responsive postimage" src="{{asset('assets/images/' . $tagpost->cover_image)}}">
								</div>
								<div class="col-md-8">
									<h3><a href="/posts/{{$tagpost->id}}">{{$tagpost->title}}</a></h3>
									<small>posted: <abbr title="{{$tagpost->created_at}}">{{$tagpost->created_at->diffForHumans()}}</abbr></small>
									@if ($tagpost->created_at != $tagpost->updated_at)
										<small>edited: <abbr title="{{$tagpost->updated_at}}">{{$tagpost->updated_at->diffForHumans()}}</abbr></small>
									@endif
									<small>posted by: {{$tagpost->user->name}}</small>
									<small>posted in: {{$tagpost->category->name}}</small>
								</div>
							</div>
						</div>
					@endforeach
					<div class="text-center">
					{{$tagposts->links()}}
					</div>
		@else
			<div class="well margintop">
				<p>No posts in this tag!</p>
			</div>
		@endif
	</div>
</div>
@endsection