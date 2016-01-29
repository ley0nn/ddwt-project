<?php 
include('logincheck.php');
$username=$_SESSION['username'];
?>

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
      <a class="navbar-brand" href="index.php"><img alt="Poar Neem'n" src="img/pnwhite.png"></a>
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
<?php if (($username) == '') { ?>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php">Login</a></li>
    </ul>     
<? } else{ ?>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$username ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="account.php">View profile</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul> 
<? } ?>
  

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<?
include("config.ini.php");

if($_GET['add'] != ''){
    $newmovie = $_GET['add'];
    mysql_query("UPDATE account SET watchlist=CONCAT(watchlist,'$newmovie') WHERE username='$username'");
    mysql_query("UPDATE account SET watchlist=CONCAT(watchlist,';') WHERE username='$username'");
    header('Location: account.php');
}
unset($_GET['add']);


// get info
$u_query = "SELECT * FROM `account` WHERE username='$username' ";
$user = mysql_query($u_query);
$user_array = array();

while($row = mysql_fetch_array($user)) {
    $user_array[] = array('username'=>$row['username'], 'firstname'=>$row['firstname'], 'lastname'=>$row['lastname'], 'file'=>$row['file'], 'watchlist'=>$row['watchlist']);
} ?> 

<div class="container" style="margin-top: 100px;"> 

<?

foreach ($user_array as $i) { ?>
    <div class="container center">
    <div class="row">
        <div class="col-sm-6">
            <img src="<?= ($i['file']) ?>" class="img-responsive"/>
            <h1><?= ($i['username']) ?></h1>
            <p><?= ($i['firstname'])." ".($i['lastname']) ?></p>
        </div>
        <div class="col-sm-6">
            <h2>Watchlist</h2>
            <form role="search" method="post" action="result.php" name="searchmovie" id="searchmovie">
            <?
            $watchlist = explode(";", $i['watchlist']);
            foreach ($watchlist as $w) { ?>
                <a href="result.php?name=<?=($w)?>" value="<?=($w)?>" name="name" id="name" onclick="document.forms['searchmovie'].submit();"><?=($w)?></a><br>
            <? } ?>
            </form> 
        </div>
    </div>
</div>
<? } ?>

   
  


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/slide.js"></script>
    <script type="text/javascript" src="image_enlarge/slide.js"></script>
</body>
</html>