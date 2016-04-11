<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>{{$title}}</title>
        <!-- Bootstrap -->
        <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('css/main.css')}}" rel="stylesheet">
        @yield('css')
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        @yield('content')

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="{{url('js/jquery.min.js')}}"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{url('js/bootstrap.min.js')}}"></script>
        <script src="{{url('js/typehead.min.js')}}"></script>
        <script>
            $('.typeahead').typeahead({
            source:function(query, process){
                return $.get("{{route('search')}}",{data : query},function(data){
                    return process(data.search_results);
                })
                
            }
            ,
                    autoSelect: true
            });
        </script>
        @yield('javascript')
    </body>
</html>