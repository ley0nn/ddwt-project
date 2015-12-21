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
        <li class="active"><a href="index.php">Movies <span class="sr-only">(current)</span></a></li>
        <li><a href="users.php">Users</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search" method="post" action="result.php" id="searchform">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Movie, Director, User..." name="name">
        </div>
        <button type="submit" name="submit" value="Search" class="btn btn-default">Search</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Watchlist <span class="badge">4</span></a></li>
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
        <h1>Header</h1>
        <p>Tekst.</p>
        <p><a class="btn btn-primary btn-lg" href="#movielist" role="button">View movies</a></p>
        <div id="movielist"></div>
    </div>
</div>

<?
include("config.ini.php");

// get movies
$m_query = "SELECT * FROM `movie_collection` order by title ";
$movie = mysql_query($m_query);
$movie_array = array();

while($row = mysql_fetch_array($movie)) {
    $movie_array[] = array('name'=>$row['title'], 'release'=>$row['year'], 'genre'=>$row['genre'], 'director'=>$row['director'], 'plot'=>$row['plot'], 'imgurl'=>$row['poster'],);
} ?> 

<div class="container"> 

<?
$count = 0;
foreach ($movie_array as $i) { 
    if ($count % 4 == 0) {
        echo "<div class=row>";
    } 
    //<img src="'.$i['imgurl'].'" />
    //($i['imgurl']) 
    $darkknight = "img/darkknight.jpg";
    ?>
    <div class="col-sm-3">
        <div class="thumbnail" data-toggle="modal" data-target="#myModal<?=($count)?>">
            <? if($row->poster == "N/A"){
                echo '<img src="http://entertainment.ie/movie_trailers/trailers/flash/posterPlaceholder.jpg">'; 
            } else {
                echo '<img src="'.$darkknight.'" />';
            } ?>
            <div class="caption"><?= ($i['name']) ?></div>
        </div>
        <div id="myModal<?=($count)?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <img src="<?= ($darkknight) ?>" class="img-responsive"/>
                        <h1><?= ($i['name']) ?></h1>
                        <p>Release: <?= ($i['release']) ?>
                        <br>Genre: <?= ($i['genre']) ?>
                        <br>Director: <?= ($i['director']) ?>
                        <br><br><?= ($i['plot']) ?></p>
                        <p><a href="#" class="btn btn-default" role="button">+ Watchlist</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? 
    $count ++;
    if ($count % 4 == 0) {
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