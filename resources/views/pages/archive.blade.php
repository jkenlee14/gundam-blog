@extends('layouts.app')

@section('content')
	<div class="container-fluid postbody">
		<div class="col-md-10 col-md-offset-1">
			<div class="row">
				<div class="col-md-9">
					@if(count($posts)>0)
					<h1>Archive of {{request('month') . ' '. request('year')}}</h1>
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
					@else
						<p>No posts found</p>
					@endif
					<div class="text-center">
						
					{{$posts->links()}}
					</div>
				</div>
				<div class="col-md-3">
						<div class="well archivemargin">
							<h3>Archives</h3>
							<ol class="list-unstyled">
								@if(count($archives)>0)
									@foreach($archives as $archive)
										<li><a href="/archive/?month={{$archive['month']}}&year={{$archive['year']}}">{{$archive['month'].' '.$archive['year']. ' (' .$archive['published'].')'}}</a></li>
									@endforeach
								@else
									<li>No Posts!</li>
								@endif
							</ol>
						</div>
					</div>
			</div>
		</div> {{-- end of col md 10 --}}
	</div>
@endsection