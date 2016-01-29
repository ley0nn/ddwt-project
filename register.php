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

<?php 
include('config.ini.php');

function registration(){ ?>
        <h1>Registration</h1>
        <form method="post" action="register.php" enctype="multipart/form-data" name="registerform" id="registerform">
            <fieldset class="form-group">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
            </fieldset>   
            <fieldset class="form-group">
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
            </fieldset>
            <fieldset class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </fieldset>
            <fieldset class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
            </fieldset>
            <fieldset class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </fieldset>
            <fieldset class="form-group">
                    <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
            </fieldset>
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Browse Avatar&hellip; <input type="file" name="fileToUpload" id="fileToUpload" required>
                    </span>
                </span>
                <input type="text" class="form-control" readonly placeholder="Only .JPG and .PNG formats are supported.">
            </div>
            <br>
            <button type="submit" class="btn btn-primary btn-block" name="register" id="register">Register Now!</button>
        </form>
<? }



if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysql_real_escape_string($_POST['username']);
    $password = md5(mysql_real_escape_string($_POST['password']));
    $confirmpassword = md5(mysql_real_escape_string($_POST['confirmpassword']));
    $email = mysql_real_escape_string($_POST['email']);
    $firstname = mysql_real_escape_string($_POST['firstname']);
    $lastname = mysql_real_escape_string($_POST['lastname']);
     
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    //$kaboom = explode(".", $fileName); // Split file name into an array using the dot
    //$fileExt = end($kaboom); // Now target the last array element to get the file extension
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                
            include_once("ak_php_img_lib_1.0.php");
            $fileName = basename( $_FILES["fileToUpload"]["name"]);
            $target = "uploads/$fileName";
            $resized_file = "uploads/resized_$fileName";
            $fileExt = $imageFileType;
            $wmax = 500;
            $hmax = 500;
            ak_img_resize($target, $resized_file, $wmax, $hmax, $fileExt);

            unlink("uploads/".$fileName);
            $target = "uploads/resized_$fileName";
            $thumbnail = "uploads/thumb_$fileName";
            $wthumb = 250;
            $hthumb = 250;
            ak_img_thumb($target, $thumbnail, $wthumb, $hthumb, $fileExt);

            unlink("uploads/resized_".$fileName);
            chmod($thumbnail, 0777);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $checkusername = mysql_query("SELECT * FROM account WHERE username = '".$username."'");
      
    if(mysql_num_rows($checkusername) >= 1) {
        echo "<p>Sorry, that username is taken. Please try again.</p><br>";
        registration();
    }
    elseif ($password != $confirmpassword) {
        echo "<p>You've entered two different passwords. Please try agian.</p><br>";
        registration();
    }
    else {
        mysql_query("INSERT INTO account (username, firstname, lastname, email, password, file) VALUES('".$username."', '".$firstname."', '".$lastname."', '".$email."', '".$password."', '".$thumbnail."')");   
        echo "<p>Registration complete! You will be redirected in five seconds.</p>";
        header( "refresh:5; url=login.php" ); 
    }
}
else { 
    registration();
}

?>
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