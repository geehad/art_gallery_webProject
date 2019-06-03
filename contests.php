<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Art Gallery</title>
        <link rel='stylesheet'href='css/bootstrap.css'>
        <link rel='stylesheet'href='css/style.css'>
        <link href="https://fonts.googleapis.com/css?family=Lobster|Pacifico" rel="stylesheet">

    </head>
    <body>
        <!--navbar-->
  <div class="container-fluid">
  <nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li ><a href="http://localhost/dataproj/myartwork.php">my Art work</a></li>
        <li><a href="http://localhost/dataproj/aboutme.php">About Me</a></li>
        <li><a href="http://localhost/dataproj/myworkshop.php">My Workshop</a></li>
        <li class="active"><a href="#">Contests<span class="sr-only">(current)</span></a></li>
        <li ><a href="http://localhost/dataproj/uploadartwork.php">Upload Artwork</a></li>
        <li><a href="http://localhost/dataproj/heldcont.php">Held contest</a></li>
        <li><a href="http://localhost/dataproj/heldworkshop.php">Held Workshop</a></li>
          </ul>
      <ul class="nav navbar-nav navbar-right">
        <!--<button type="button" class="btn btn-default navbar-btn">Log out</button>-->
          
        <button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#myModal">Log out</button>
        <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <button type="button" class="btn btn-default" aria-label="Left Align">
          <span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>
              Do you really want to log out!!
          </button>
        </div>
        <div class="modal-footer">
          <!--<button type="button" class="btn btn-danger" data-dismiss="modal">Yes   
              <a href="../dbproject/uploadartwork.html"></a> 
          </button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>-->
        <ul>
            <li><a href="http://localhost/dataproj/logout.php">Yes</a></li>
            <li ><a href="http://localhost/dataproj/contests.php">No</a></li>    
        </ul>          
        </div>  
        </div>
    </div>
    </div>  
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<!--navbar-->
      <div class="search">
          <div class="c1">
      <button type="button" class="btn btn-default" aria-label="Left Align">
        <span class="glyphicon glyphicon glyphicon-search" aria-hidden="true"></span>
        </button>
        </div>
          <div class="c2">
      <div class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Current Contests
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
      
      
      <?php

     $dsn = 'mysql:host=localhost;dbname=art_gallery';
     $username = 'root';
     $password = '';

try {
    $conn=new PDO($dsn,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $conn->prepare("SELECT * FROM contest");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    $count=1;
    foreach($result as $Rows)
    {
        $ID=$Rows['ID'];
        $endd=$Rows['End'];
        $now = time();
        if($now <strtotime( $Rows['End']))
        {
        echo'<li><a href="http://localhost/dataproj/test.php?id='.$ID.'"> Contest '. "$count"."</a></li>";
        $count++;
        }
    } 
  }
  catch(PDOException $e)
    {
      echo'failed'.$e->getMessage();
    }
$conn = null;
?>
  </ul>
</div>
   </div>
      </div>
        <div class="contest1">
            <h1>Vote For Prefered ArtWork </h1> 
            <img src="imiges/6mzyblcys4-beata-ratuszniak.jpg">
          </div>
          
      </div>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>