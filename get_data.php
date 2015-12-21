<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie Database</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
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
      <a class="navbar-brand" href="#"><img alt="Poar Neem'n" src="img/pn.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Movies <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Directors</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Watchlist</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">View profile</a></li>
            <li><a href="#">Account settings</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="jumbotron">
    <div class="container">
        <h1>Welcome on the Poar Neem'n Movie Database!</h1>
        <p>Dit is een stomme tekst.</p>
        <p><a class="btn btn-primary btn-lg" href="#movielist" role="button">View movies</a></p>
        <div id="movielist"></div>
    </div>
</div>

<?
include("config.ini.php");

// get movies
$m_query = "SELECT * FROM `movie` ";
$movie = mysql_query($m_query);
$movie_array = array();

while($row = mysql_fetch_array($movie)) {
    $movie_array[] = array('name'=>$row['name'], 'release'=>$row['releasedate'], 'genre'=>$row['genre'], 'director'=>$row['director']);
} ?> 

<div class="container"> 
    <div class="row" id="newrow"> 

<?
$c = 0;
$row_numbers = array("4", "8", "12", "16", "20");

function divstart() {
    echo "<div class=row>";
}

function divend() {
    echo "</div>";
}

foreach ($movie_array as $i) { 
    if (in_array($c, $row_numbers)) {
        divstart();
    } ?>
    <div class="col-sm-3">
        <div class="thumbnail" data-toggle="modal" data-target="#myModal<? echo($c)?>">
            <img src="<?php echo ($i['imgurl']) ?>" alt="<?php echo($i['name']) ?>" height="200px" width="200px">      
            <div class="caption"><?php echo($i['name']) ?></div>
        </div>
        <div id="myModal<? echo($c)?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="<?= $i['imgurl'] ?>" class="img-responsive">
                        <h1><?php echo($i['name']) ?></h1>
                        <p>Release: <?php echo($i['release']) ?>
                        <br>Genre: <?php echo($i['genre']) ?>
                        <br>Director: <?php echo($i['director']) ?>
                        <br><br><?php echo($i['plot']) ?></p>
                        <p><a href="#" class="btn btn-default" role="button">+ Watchlist</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? 
    $c ++;
    if (in_array($c, $row_numbers)) {
        divend();
    } 
} ?>
</div>
</div>

  


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/slide.js"></script>
    <script type="text/javascript" src="image_enlarge/slide.js"></script>
</body>
</html>