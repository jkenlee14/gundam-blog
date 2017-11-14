@extends('layouts.app')

@section('content')
<div class="container-fluid postbody">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="row">{{-- interior row --}}
				<div class="col-md-9 carouselcontainer"> {{-- for carousel --}}
					<h1>Random Articles</h1>
					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						  <!-- Indicators -->
						  <ol class="carousel-indicators">
						    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						    <li data-target="#myCarousel" data-slide-to="1"></li>
						    <li data-target="#myCarousel" data-slide-to="2"></li>
						  </ol>

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner">
						  	@if (count($carousels)>0)
						  	<?php $counter = 0 ?>
						  		@foreach($carousels as $carousel)
						  			@if($counter == 0)
						  				<div class="item active">
						  					<?php $counter =1 ?>
						  			@else
						  				<div class="item">
						  			@endif
						  					<img class="image-responsive" src="{{asset('assets/images/' . $carousel->cover_image)}}">
						  					<div class="carousel-caption">
						  						<h3><a class="graylink" href="/posts/{{$carousel->id}}">{{$carousel->title}}</a></h3>
						  						<p>{!!mb_strimwidth(strip_tags($carousel->body), 0, 20, '...')!!}</p>
						  					</div>
						  				</div>
						  		@endforeach
						  	@endif
						  </div>

						  <!-- Left and right controls -->
						  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
						    <span class="glyphicon glyphicon-chevron-left"></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="right carousel-control" href="#myCarousel" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right"></span>
						    <span class="sr-only">Next</span>
						  </a>
						</div>
					</div> {{-- end of carousel --}}
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
					<div class="col-md-9">
						<div class="panel panel-default"> {{-- panel --}}
							<div class="panel-heading"><h3>Recent Posts</h3></div>
							<div class="panel-body"> {{-- panel body --}}
								<div class="row is-flex">
									@if(count($posts)>0)
										@foreach($posts as $post)
											<div class="col-md-4 spacer">
													<div class="panel panel-default">
														<div class="panel-heading homeheading">
															<a class="blacklink" href="/posts/{{$post->id}}"><h4>{{$post->title}}</h4></a>
														</div>
														<div class="panel-body blogpost">
															
															<img class="image-responsive postimage" src="{{asset('assets/images/' . $post->cover_image)}}">
															<p class="">{!!mb_strimwidth(strip_tags($post->body), 0, 60, '...')!!}</p>
														</div>
														<div class="panel-footer">
															<small>posted: <abbr title="{{$post->created_at}}">{{$post->created_at->diffForHumans()}}</abbr></small><br>
															@if ($post->created_at != $post->updated_at)
																<small>edited: <abbr title="{{$post->updated_at}}">{{$post->updated_at->diffForHumans()}}</abbr></small><br>
															@endif
															<small>posted by: {{$post->user->name}}</small>
														</div>
													</div>
											</div>
										@endforeach
									@else
										<p>No posts to show!</p>
									@endif
								</div>
							</div> {{-- end of panel body --}}
							<div class="panel-footer">
								<div class="text-center">
									
								{{$posts->links()}}
								</div>
							</div>
						</div> {{-- end of panel --}}

					</div>
					<div class="col-md-3">
						<div class="well">
							<h3>Tags</h3>
							@if(count($tags)>0)
								@foreach($tags as $tag)
									<a href="/tags/{{$tag->id}}"><h1 class="label label-default">{{$tag->name}}</h1></a>
								@endforeach
							@else
								<h4 class="label label-default">No tags</h4>
							@endif
						</div>
					</div>
				</div>
			</div> {{-- end of interior row --}}
		</div>
	</div>
</div>
@endsection