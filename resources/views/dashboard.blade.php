@extends('layouts.app')

@section('content')
    <div class="container-fluid postbody">
        <div class="col-md-10 col-md-offset-1">
            <h1>Dashboard</h1>
            <a href="posts\create" class="btn btn-success backbtn">Create Post</a>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#postlist">Post List</a></li>
                <li><a data-toggle="tab" href="#categories">Categories</a></li>
                <li><a data-toggle="tab" href="#tags">Tags</a></li>
            </ul>
            <div class="tab-content">
                <div id="postlist" class="tab-pane fade in active"> {{-- postlist tab --}}
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Post Title</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @if (count($posts)>0)
                            @foreach ($posts as $post)
                                <tr>
                                    <td><a href="posts\{{$post->id}}">{{$post->title}}</a></td>
                                    <td class="text-center"><a class="btn btn-default" href="/posts/{{$post->id}}/edit">Edit</a></td>
                                    <td class="text-center">
                                    <!-- Trigger the modal with a button -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeletePost{{$post->id}}">Delete</button>
                                        <!-- Modal -->
                                        <div id="DeletePost{{$post->id}}" class="modal fade" role="dialog">
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
                                    </td>
                                </tr>   
                            @endforeach
                        @else
                            <p>You have no posts!</p>
                        @endif
                    </table>
                </div> {{-- end of postlist tab --}}
                <div id="categories" class="tab-pane fade">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Category</th>
                            <th></th>
                            <th></th>
                        </tr>
                            @if(count($categories)>0)
                                @foreach($categories as $category)
                                <tr>
                                    <td class="text-center">{{$category->name}}</td>
                                    <td class="text-center"><button class="btn btn-info" data-toggle="modal" data-target="#UpdateCategory{{$category->id}}">Edit</button>
                                        {{-- Modal start (update category) --}}
                                        <div id="UpdateCategory{{$category->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                {{-- Modal Content --}}
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Edit Category</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! Form::open(['action' => ['DashboardController@updateCategory', $category->id ], 'method' => 'POST' , 'enctype' => 'multipart/form-data']) !!}
                                                            <div class="form-group">
                                                                {{Form::label('updatename', 'Category Name')}}
                                                                {{Form::text('updatename', $category->name, ['class'=>'form-control'])}}
                                                            {{Form::hidden('_method', 'PUT')}}
                                                            {{Form::hidden('id', $category->id)}}
                                                            </div>
                                                            {{Form::submit('Edit Category', ['class' => 'btn btn-primary submitbutton'])}}
                                                        {!! Form::close() !!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> {{-- Modal end (update category) --}}
                                    </td>

                                    <td class="text-center">
                                    <!-- Trigger the modal with a button -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteCategory{{$category->id}}">Delete</button>
                                        <!-- Modal -->
                                        <div id="DeleteCategory{{$category->id}}" class="modal fade" role="dialog">
                                          <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Delete Category</h4>
                                              </div>
                                              <div class="modal-body">
                                                <p>Are you sure you want to delete this category?</p>
                                              </div>
                                              <div class="modal-footer">
                                                {!!Form::open(['action'=>['DashboardController@deleteCategory', $post->id], 'method' => 'POST', 'class' => 'pull-left'])!!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::hidden('id', $category->id)}}
                                                    {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                                {!!Form::close()!!}
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </td>
                                    
                                @endforeach
                                </tr>
                            @else
                                <p class="margintop">No Categories! Create one!</p>
                            @endif
                    </table>
                    {{-- modal start --}}
                    <a href="#" class="btn btn-success spacer" data-toggle="modal" data-target="#addCategory">Add Category</a>
                    <!-- Modal -->
                    <div id="addCategory" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Category</h4>
                          </div>
                          <div class="modal-body">
                            {!! Form::open(['action'=>'DashboardController@storeCategory', 'method' => 'POST']) !!}
                                <div class="form-group">
                                    {{Form::label('categoryname', 'Category Name')}}
                                    {{Form::text('categoryname', '', ['class'=>'form-control', 'placeholder' => 'Category Name'])}}
                                </div>
                                {{Form::submit('Submit Category', ['class' => 'btn btn-primary submitbutton'])}}
                            {!! Form::close() !!}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    {{-- divider --}}

                    {{-- modal start --}}


                </div>
                <div id="tags" class="tab-pane fade">
                   <table class="table table-striped table-bordered">
                        <tr>
                            <th>Tags</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @if(count($tags)>0)
                            @foreach($tags as $tag)
                            <tr>
                                <td class="text-center">{{$tag->name}}</td>
                                <td class="text-center"><button class="btn btn-info" data-toggle="modal" data-target="#UpdateTag{{$tag->id}}">Edit</button>
                                        {{-- Modal start (update category) --}}
                                        <div id="UpdateTag{{$tag->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                {{-- Modal Content --}}
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Edit Tag</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! Form::open(['action' => ['DashboardController@updateTag', $tag->id ], 'method' => 'POST' , 'enctype' => 'multipart/form-data']) !!}
                                                            <div class="form-group">
                                                                {{Form::label('updatetagname', 'Tag Name')}}
                                                                {{Form::text('updatetagname', $tag->name, ['class'=>'form-control'])}}
                                                            {{Form::hidden('_method', 'PUT')}}
                                                            {{Form::hidden('id', $tag->id)}}
                                                            </div>
                                                            {{Form::submit('Edit Tag', ['class' => 'btn btn-primary submitbutton'])}}
                                                        {!! Form::close() !!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> {{-- Modal end (update category) --}}
                                    </td>
                                    {{-- spacer --}}

                                <td class="text-center">
                                    <!-- Trigger the modal with a button -->
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#DeleteTag{{$tag->id}}">Delete</button>
                                        <!-- Modal -->
                                        <div id="DeleteTag{{$tag->id}}" class="modal fade" role="dialog">
                                          <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Delete Tag</h4>
                                              </div>
                                              <div class="modal-body">
                                                <p>Are you sure you want to delete this tag?</p>
                                              </div>
                                              <div class="modal-footer">
                                                {!!Form::open(['action'=>['DashboardController@deleteTag', $tag->id], 'method' => 'POST', 'class' => 'pull-left'])!!}
                                                    {{Form::hidden('_method', 'DELETE')}}
                                                    {{Form::hidden('id', $tag->id)}}
                                                    {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                                {!!Form::close()!!}
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </td>
                            </tr>

                            @endforeach
                        @else
                            <p class="margintop">No tags! create one!</p>
                        @endif
                   </table>
                   {{-- modal start --}}
                    <a href="#" class="btn btn-success spacer" data-toggle="modal" data-target="#addTag">Add Tag</a>
                    <!-- Modal -->
                    <div id="addTag" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Add Category</h4>
                          </div>
                          <div class="modal-body">
                            {!! Form::open(['action'=>'DashboardController@storeTag', 'method' => 'POST']) !!}
                                <div class="form-group">
                                    {{Form::label('tagname', 'Tag Name')}}
                                    {{Form::text('tagname', '', ['class'=>'form-control', 'placeholder' => 'Tag Name'])}}
                                </div>
                                {{Form::submit('Submit Tag', ['class' => 'btn btn-primary submitbutton'])}}
                            {!! Form::close() !!}
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    {{-- divider --}}


                </div>
            </div>

        </div>
    </div>
@endsection
