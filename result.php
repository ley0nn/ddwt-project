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
      <a class="navbar-brand" href="index.php"><img alt="Poar Neem'n" src="img/pn.png"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Movies</a></li>
        <li><a href="users.php">Users</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search" method="post" action="result.php" id="searchform">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Movie, Director, User..." name="name">
        </div>
        <button type="submit" name="submit" value="Search" class="btn btn-default">Search</button>
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

<?
include("config.ini.php");


$search=$_POST['name']; 
echo ($name);

// get movies
$m_query = "SELECT * FROM `movie_collection` 
    WHERE title COLLATE UTF8_GENERAL_CI LIKE '%{$search}%' 
    OR genre COLLATE UTF8_GENERAL_CI LIKE '%{$search}%' 
    OR director COLLATE UTF8_GENERAL_CI LIKE '%{$search}%' 
    OR year COLLATE UTF8_GENERAL_CI LIKE '%{$search}%' 
    order by title";
$movie = mysql_query($m_query, $con);
$movie_array = array();

while($row = mysql_fetch_array($movie)) {
    $movie_array[] = array('name'=>$row['title'], 'release'=>$row['year'], 'genre'=>$row['genre'], 'director'=>$row['director'], 'plot'=>$row['plot'], 'imgurl'=>$row['poster'],);
} ?> 

<div class="jumbotron">
    <div class="container" id="searchresults">
        <p>Results for: <?=$search?>.</p>
        <p><a class="btn btn-primary btn-lg" href="index.php#movielist" role="button">All movies</a></p>
    </div>
</div>

<div class="container"> 

<?
$c = 0;

foreach ($movie_array as $i) { 
    if ($c % 4 == 0) {
        echo "<div class=row>";
    }
    //$test = "http://ia.media-imdb.com/images/M/MV5BMTk4ODQzNDY3Ml5BMl5BanBnXkFtZTcwODA0NTM4Nw@@._V1_SX300.jpg";
    //$test = $i['imgurl']; 
    $test = "/img/darkknight.jpg" ?>

    <div class="col-sm-3">
        <div class="thumbnail" data-toggle="modal" data-target="#myModal<? echo($c)?>">
            <? if($row->poster == "N/A"){
                echo '<img src="http://entertainment.ie/movie_trailers/trailers/flash/posterPlaceholder.jpg">'; 
            } else {
                echo '<img src="img/darkknight.jpg">';
            } ?>
            <div class="caption"><?php echo($i['name']) ?></div>
        </div>
        <div id="myModal<? echo($c)?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="img/darkknight.jpg" class="img-responsive"/>
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
    if ($c % 4 == 0) {
        echo "</div>";
    } 


} ?>
</div>

  


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/slide.js"></script>
    <script type="text/javascript" src="image_enlarge/slide.js"></script>
</body>
</html>