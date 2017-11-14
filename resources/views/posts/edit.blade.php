@extends('layouts.app')

@section('content')
	<div class="container-fluid postbody">
		<div class="col-md-10 col-md-offset-1">
			<h1>Edit Post</h1>
			{!! Form::open(['action'=>['PostsController@update', $post->id], 'method' => 'POST' , 'enctype' => 'multipart/form-data']) !!}
				<div class="form-group">
					{{Form::label('title', 'Title')}}
					{{Form::text('title', $post->title, ['class'=> 'form-control', 'placeholder' => 'Title'])}}
				</div>
				<div class="form-group">
					{{Form::label('body', 'Body')}}
					{{Form::textarea('body', $post->body, ['class'=> 'form-control', 'placeholder' => 'Body Text', 'id' => 'article-ckeditor'])}}
				</div>
				<div class="form-group">
					{{Form::label('category_id', 'Category')}}
					{!!Form::select('category_id', $category_list, $post->category_id , ['class' => 'form-control'])!!}
				</div>
				<div class="form-group">
					{{Form::label('tags', 'Tags')}}
					{!!Form::select('tags[]', $tag_list, $tag_selected , ['class' => 'form-control customselect', 'multiple' => 'multiple'])!!}
				</div>
				<div class="form-group">
					{{Form::file('cover_image')}}
				</div>
				{{Form::hidden('_method', 'PUT')}}
				{{Form::submit('Submit Post', ['class' => 'btn btn-primary submitbutton'])}}

			{!! Form::close() !!}
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('.customselect').select2();
		});
	</script>

@endsection