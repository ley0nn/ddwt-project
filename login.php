<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Database</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <!--<link href="css/registerstyle.css" rel="stylesheet">-->
    <link rel="shortcut icon" href="img/pn.png">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img alt="Poar Neem'n" src="img/pn.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Movies <span class="sr-only">(current)</span></a></li>
        <li><a href="users.php">Users</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search" method="post" action="result.php" id="searchform">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Movie, Director, User..." name="name">
        </div>
        <button type="submit" name="submit" value="Search" class="btn btn-default">Search</button>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container" style="margin-top: 100px;">
    <div class="row center">
        <div class="col-sm-5 center">
            <h1>Login</h1>
            <form method="post" action="logincheck.php" name="loginform" id="loginform">
                <fieldset class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </fieldset>   
                <fieldset class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </fieldset>
                <button type="submit" class="btn btn-primary btn-block" name="submit" id="submit">Login</button><br>
            </form>
            <a href="register.php" class="btn btn-default btn-block" role="button">Create Free Account</a>       
        </div>
    </div>
</div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/slide.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
    <script type="text/javascript" src="image_enlarge/slide.js"></script>
</body>
</html>