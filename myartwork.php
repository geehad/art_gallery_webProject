<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Art Gallery</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
         <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
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
        <li class="active"><a href="#">my Art work <span class="sr-only">(current)</span></a></li>
        <li><a href="http://localhost/dataproj/aboutme.php">About Me</a></li>
        <li><a href="http://localhost/dataproj/myworkshop.php">My Workshop</a></li>
        <li><a href="http://localhost/dataproj/contests.php">Contests</a></li>
        <li><a href="http://localhost/dataproj/uploadartwork.php">Upload Artwork</a></li>
        <li><a href="http://localhost/dataproj/heldcont.php">Held Contest</a></li>
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
            <li ><a href="http://localhost/databaseproj/myartwork.php">No</a></li>    
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
        
        </div >
        <div class="container-fluid">
         <div class="w3-container w3-center w3-animate-fading">
         <h1>Your artworks info <img src="imiges/1481525535_heart.png"></h1>
         </div>
            
      <div class="parent">
<?php
$dsn = 'mysql:host=localhost;dbname=art_gallery';
$username = 'root';
$password = '';
$us= $_SESSION["username"];
$count=0;

try {
    $conn=new PDO($dsn,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $conn->prepare("SELECT * FROM artwork WHERE AUN='$us'");
     $sth->execute();     
     $result = $sth->fetchAll(PDO::FETCH_ASSOC);
       foreach($result as $Rows)
       {
           $count++;
            echo'<div class="img1">
               
            <img class="w3-hover-grayscale" src="data:image/jpeg;base64,'.base64_encode( $Rows['image'] ).'"/>
            </div>';

            echo"<div class='par1'>";
            echo "<h2> Title: </h2>  "."<h3>".$Rows['Title']."<h3>"."<br>";
            echo "<h2> Price: </h2>  "."<h3>".$Rows['Price']."<h3>"."<br>";
            echo "<h2> Date: </h2>  "."<h3>".$Rows['Date']."<h3>"."<br>";
            if($Rows['Status']==0)
            {
            echo "<h2>Status: </h2>  "."<h3>"."Not Sold"."<h3>"."<br>";
            }
           else {
            echo "<h2>Status: </h2>  "."<h3>"."Sold"."<h3>"."<br>";
            }
            echo "<h2> ArtStyle: </h2>  "."<h3>".$Rows['Art_Style']."<h3>"."<br>";
            echo "</div>";
        
       }
    echo $count;
  }

   catch(PDOException $e)
    {
      echo'failed'.$e->getMessage();
    }
   $conn = null;
  ?>
<?php
if($count==0)
          {
               echo "</br>"."</br>"."</br>"."</br>"."</br>"."</br>"."</br>"."</br>"."</br>";
               echo'<h1>Sorry NO ArtWorks Available</h1>';
               echo'<h1>    for our dear Artist      <img src="imiges/sorry.png"></h1>';
   
          }

?>
        </div>
        </div>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>