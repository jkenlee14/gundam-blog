<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hyper Mega Gunpla Blog') }}</title>

    {{-- scripts CDNs--}}

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <link href="{{ asset('css/rotating-card.css') }}" rel="stylesheet">

    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">

    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Favicon Link -->
    <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon"/>
</head>
<body>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <div id="app">
        <main>
        @include('inc.navbar')
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
        </main>
    </div>

    <!-- Scripts -->
    

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
            <script>
                CKEDITOR.replace( 'article-ckeditor' );
            </script>
    <script type="text/javascript" src="{{ asset('js/jquery-1.10.2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"><script>
    <script type="text/javascript">
    $().ready(function(){
        $('[rel="tooltip"]').tooltip();

    });

     $(function() {
        $('.spacer').matchHeight();
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
     @include('inc.footer')
</body>
</html>