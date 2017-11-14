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
                <li><a data-toggle="tab" href="#profile">Edit Profile</a></li>
                @if(Auth::user()->accesslevel == 1)
                <li><a data-toggle="tab" href="#register">Register New Posters</a></li>
                <li><a data-toggle="tab" href="#accounts">Manage Accounts</a></li>
                @endif
                
            </ul>
            <div class="tab-content">{{-- tab content --}}
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
                                                {!!Form::open(['action'=>['DashboardController@deleteCategory', $category->id], 'method' => 'POST', 'class' => 'pull-left'])!!}
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
            
            <div id="profile" class="tab-pane fade">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>

                <div id="register" class="tab-pane fade">
            <div class="panel panel-default authpanels">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
                </div>

                <div id="accounts" class="tab-pane fade">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>

        </div>{{-- end of tab content --}}
    </div>
@endsection
