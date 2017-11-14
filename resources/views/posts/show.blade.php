@extends('layouts.app')

@section('content')
	<div class="container-fluid postbody">
		<div class="col-md-10 col-md-offset-1">
			<a href="/posts" class="btn btn-default backbtn">Back</a>
			<h1>{{$post->title}}</h1>
			<small>posted: <abbr title="{{$post->created_at}}">{{$post->created_at->diffForHumans()}}</abbr></small>
			@if ($post->created_at != $post->updated_at)
				<small>edited: <abbr title="{{$post->updated_at}}">{{$post->updated_at->diffForHumans()}}</abbr></small>
			@endif
			<br>
			<div class="fb-like" data-href="{{url()->current()}}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
			<br><br>
			<img class="image-responsive postimagefull" src="{{asset('assets/images/' . $post->cover_image)}}">
			<br><br>
			<div class="col-md-10 col-md-offset-1">
			{!! $post->body !!}
			</div>
			<br>
			<div class="pull-left">
				<small>posted by: {{$post->user->name}}</small> &nbsp;
				@if(count($post->category->name)>0)
					<small>posted in: <a href="/categories/{{$post->category->id}}">{{$post->category->name}}</a></small>
				@else
					<small>posted in: N/a</small>
				@endif
			</div>

			<div class="pull-right">
				@if(count($post->tags)>0)
				@foreach($post->tags as $tag)
					<a href="/tags/{{$tag->id}}"><h4 class="label label-default">{{$tag->name}}</h4></a>
				@endforeach
			@else
				<h4 class="label label-default">No tags</h4>
			@endif
			</div>
			<br>
			<hr>
			@if (!Auth::guest())
				@if (Auth::user()->id == $post->user_id)
					<a class="btn btn-default pull-left" href="/posts/{{$post->id}}/edit">Edit</a>
					<!-- Trigger the modal with a button -->
					<button type="button" class="btn btn-danger pull-left" data-toggle="modal" data-target="#DeletePost">Delete</button>
					<!-- Modal -->
					<div id="DeletePost" class="modal fade" role="dialog">
					  <div class="modal-dialog">

					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Delete Post</h4>
					      </div>
					      <div class="modal-body">
					      	<p>Are you sure you want to delete this post?</p>
					      </div>
					      <div class="modal-footer">
					      	{!!Form::open(['action'=>['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-left'])!!}
								{{Form::hidden('_method', 'DELETE')}}
								{{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
							{!!Form::close()!!}
					        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					      </div>
					    </div>
					  </div>
					</div>
				@endif
			@endif
			<br><br>
			<div class="comments">
				
			<button href="#disqus" data-toggle="collapse" class="btn btn-info btn-large commentbutton backbtn">Expand for comments</button>
			<div id="disqus" class="collapse">
			<div id="disqus_thread"></div>
			</div>
			</div>
			<script>

			/**
			*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
			*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
			
			var disqus_config = function () {
			this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
			this.page.identifier = {{$post->id}}; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
			};
			
			(function() { // DON'T EDIT BELOW THIS LINE
			var d = document, s = d.createElement('script');
			s.src = 'https://hyper-mega-gunpla-blog.disqus.com/embed.js';
			s.setAttribute('data-timestamp', +new Date());
			(d.head || d.body).appendChild(s);
			})();
			</script>
			<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

		</div>
	</div>
@endsection