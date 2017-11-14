@extends('layouts.app')

@section('content')
<div class="container-fluid postbody">
	
<div class="container-fluid">
	<h1>Meet the Staff</h1>
	<h2>Administrators</h2>
    @if(count($admins)>0)
        @foreach($admins as $admin)
            <div class="col-md-4">
             <div class="card-container manual-flip">
             <div class="card">
                 <div class="front">
                     <div class="cover">
                         {{-- <img src="{{ asset('assets/placeholder.jpg') }}"/> --}}
                     </div>
                     <div class="user">
                         <img class="img-circle" src="{{ asset('assets/images/profiles/' . $admin->profpicture) }}"/>
                     </div>
                     <div class="content">
                         <div class="main">
                             <h3 class="name">{{$admin->name}}</h3>
                             <p class="profession">Admin</p>

                             <p class="text-center">{{$admin->bio}}</p>
                         </div>
                         <div class="footer">
                             <button class="btn btn-simple" onclick="rotateCard(this)">
                                        <i class="fa fa-mail-forward"></i> More
                             </button>
                         </div>
                     </div>
                 </div> <!-- end front panel -->
                 <div class="back">
                     <div class="header">
                         <h5 class="motto">Social Media</h5>
                     </div>
                     <div class="content">
                         <div class="main">
                             <div class=" text-center">
                                <ul class="list-unstyled">
                                    <li><a href="{{$admin->socmedfb}}" class="facebook"><i class="fa fa-facebook fa-fw"></i> Facebook</a></li>
                                    <li><a href="{{$admin->socmedtwitter}}" class="twitter"><i class="fa fa-twitter fa-fw"></i> Twitter</a></li>
                                    <li><a href="{{$admin->socmedother}}" class="google"><i class="fa fa-globe fa-fw"></i> Other</a></li>
                                </ul>
                         </div>
                             <div class="stats-container">
                                 <div class="stats">
                                     <h4></h4>
                                     <p>
                                         
                                     </p>
                                 </div>
                                 <div class="stats">
                                     <h4></h4>
                                     <p>
                                         
                                     </p>
                                 </div>
                                 <div class="stats">
                                     <h4></h4>
                                     <p>
                                         
                                     </p>
                                 </div>
                             </div>

                         </div>
                     </div>
                     <div class="footer">
                        <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                                    <i class="fa fa-reply"></i> Back
                                </button>
                         
                     </div>
                 </div> <!-- end back panel -->
             </div> <!-- end card -->
         </div> <!-- end card-container -->
        </div>
        @endforeach
    @else
    <div class="container">
        <p>No Admins :(</p>
    </div>
    @endif
	
</div>
    <div class="container-fluid">
    	<h2>Contributors</h2>
        @if(count($contributors)>0)
        @foreach($contributors as $contributor)
            <div class="col-md-4">
             <div class="card-container manual-flip">
             <div class="card">
                 <div class="front">
                     <div class="cover">
                         {{-- <img src="{{ asset('assets/placeholder.jpg') }}"/> --}}
                     </div>
                     <div class="user">
                         <img class="img-circle" src="{{ asset('assets/images/profiles/' . $contributor->profpicture) }}"/>
                     </div>
                     <div class="content">
                         <div class="main">
                             <h3 class="name">{{$contributor->name}}</h3>
                             <p class="profession">Contributor</p>

                             <p class="text-center">{{$contributor->bio}}</p>
                         </div>
                         <div class="footer">
                             <button class="btn btn-simple" onclick="rotateCard(this)">
                                        <i class="fa fa-mail-forward"></i> More
                             </button>
                         </div>
                     </div>
                 </div> <!-- end front panel -->
                 <div class="back">
                     <div class="header">
                         <h5 class="motto">Social Media</h5>
                     </div>
                     <div class="content">
                         <div class="main">
                             <div class=" text-center">
                                <ul class="list-unstyled">
                                    <li><a href="{{$contributor->socmedfb}}" class="facebook"><i class="fa fa-facebook fa-fw"></i> Facebook</a></li>
                                    <li><a href="{{$contributor->socmedtwitter}}" class="twitter"><i class="fa fa-twitter fa-fw"></i> Twitter</a></li>
                                    <li><a href="{{$contributor->socmedother}}" class="google"><i class="fa fa-globe fa-fw"></i> Other</a></li>
                                </ul>
                         </div>
                             <div class="stats-container">
                                 <div class="stats">
                                     <h4></h4>
                                     <p>
                                         
                                     </p>
                                 </div>
                                 <div class="stats">
                                     <h4></h4>
                                     <p>
                                         
                                     </p>
                                 </div>
                                 <div class="stats">
                                     <h4></h4>
                                     <p>
                                         
                                     </p>
                                 </div>
                             </div>

                         </div>
                     </div>
                     <div class="footer">
                        <button class="btn btn-simple" rel="tooltip" title="Flip Card" onclick="rotateCard(this)">
                                    <i class="fa fa-reply"></i> Back
                                </button>
                         
                     </div>
                 </div> <!-- end back panel -->
             </div> <!-- end card -->
         </div> <!-- end card-container -->
        </div>
        @endforeach
    @else
    <div class="container">
        <p>No Contributors :(</p>
    </div>
    @endif
    	
    </div>
</div>

<script type="text/javascript">
    $().ready(function(){
        $('[rel="tooltip"]').tooltip();

    });

    function rotateCard(btn){
        var $card = $(btn).closest('.card-container');
        console.log($card);
        if($card.hasClass('hover')){
            $card.removeClass('hover');
        } else {
            $card.addClass('hover');
        }
    }
</script>
@endsection