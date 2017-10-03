<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Statistics like Highest Run Scorer, Leading Wicket Taker, Auction, Market Research and many more Musketeer Feature of the MMORPG game Hitwicket.com">
    <meta name="author" content="Master Coder">
    <meta name="google-site-verification" content="xmtTEG9WlnKpb1Sp-CjYmdZNjFHCFfnyLZg3P93xyYg" />
    <link rel="shortcut icon" href="{{ URL::to('/') }}/assets/ico/favicon.ico">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

    <title>{{ $title }} | Hitwicket Statistics</title>

	<!-- Begin Inspectlet Embed Code -->
<script type="text/javascript" id="inspectletjs">
	window.__insp = window.__insp || [];
	__insp.push(['wid', 515630222]);
	(function() {
		function __ldinsp(){var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); }
		if (window.attachEvent){
			window.attachEvent('onload', __ldinsp);
		}else{
			window.addEventListener('load', __ldinsp, false);
		}
	})();
</script>
<!-- End Inspectlet Embed Code -->
	
    <!-- Bootstrap core CSS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ URL::to('/') }}/css/main.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">HW Stats</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li {{ $title == "Auction" ? "class=\"active\"":""}}><a href="{{ URL::to('auction/') }}">Auction</a></li>
           <li {{ $title == "Auction Trends" ? "class=\"active\"":""}}><a href="{{ URL::to('auction/trends') }}">Auction Trends</a></li>
            <li {{ $title == "Price Quote" ? "class=\"active\"":""}}><a href="{{ URL::to('auction/quote') }}">Market Research</a></li>
            <li {{ $title == "Star Calculator" ? "class=\"active\"":""}}><a href="{{ URL::to('stars') }}">Star Calculator</a></li>
            <li class="dropdown {{ $title == "Star Calculator" ? "active":""}}">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Scripts <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ URL::to('scripts/hwplus') }}">Hitwicket+<span class="badge pull-right">v1.3</span></a></li>
              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-right" method="get" role="form" action="{{ URL::to('search/') }}">
            <div class="form-group">
              <input type="text" placeholder="Search...Players..Teams..." class="form-control" name="search">
            </div>
            <button type="submit" class="btn btn-success">Search</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div style="text-align: center;" class="container center-block">
        <h1>Hitwicket Stats</h1>
        <p>All the Hitwicket Stats You Need .... All at one place !!</p>
      </div>
    </div>

    <div class="container">
  <!--<ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li><a href="#">Library</a></li>
  <li class="active">Data</li>
</ol>-->
      <!-- Example row of columns -->
      @yield('header', '<div class="row"><div class="col-md-12"><div style="text-align: center;" class="alert alert-info"> Did You try the New <a href="/auction/quote" class="alert-link">Market Research </a>and <a href="/auction" class="alert-link">Enhanced Auction</a> Feature ?? </div></div></div>')
      <div class="row">
          @yield('content')
      </div>

      <hr>

      <footer>
        <p>&copy; HW Stats 2014</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ URL::to('/') }}/js/main.min.js"></script>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49507971-1', 'hwstats.tk');
  ga('send', 'pageview');

</script>
  </body>
</html>
