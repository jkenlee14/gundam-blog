    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">{{config('app.name', 'Laravel Blog1')}}</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li class="dropdown">
            	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
            	<ul class="dropdown-menu" role="menu">
            		{{-- <li><a href="#">Category 1</a></li>
            		<li><a href="#">Category 2</a></li>
            		<li><a href="#">Category 3</a></li>
            		<li><a href="#">Category 4</a></li>
            		<li><a href="#">Category 5</a></li>
            		<li><a href="#">Category 6</a></li> --}}
                    @if(count($categorylist)>0)
                        @foreach($categorylist as $category)
                            <li><a href="/categories/{{$category->id}}">{{$category->name}}</a></li>
                        @endforeach
                    @else
                        <li>No Categories!</li>
                    @endif
            	</ul>
            </li>
            <li><a href="/posts">Posts</a></li>
          </ul>


                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                              <li><a href="/dashboard">Dashboard</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>