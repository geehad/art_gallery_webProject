<?php
session_start();

error_reporting(0);
$titleErr="";
$dateErr="";

$dsn = 'mysql:host=localhost;dbname=art_gallery';
$username = 'root';
$password = '';

 $us= $_SESSION["username"];

try {
    $conn=new PDO($dsn,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $titA="";        //for uploadloadartwork form
    $styA="";
    $priA="";
    $dtA="";

    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {  
      if (empty($_POST["tit"])) {
      $titleErr = "Title is required";
        } else {
      $titA =$_POST["tit"];
       }
       
       //////////
  if (isset($_POST['sty']))
    {
      $styA=$_POST['sty'];
    }
    //////////////
    
    if (isset($_POST['pri']))
    {
      $priA=$_POST['pri']; 
    }
    //////////
      if (empty($_POST["dt"])) {
      $dateErr = "Date is required";
        } else {
      $dtA =$_POST["dt"];
       }
    
    $status=false;
    if(isset($_FILES['image']))
    {
     $file=$_FILES['image']['tmp_name'];
     $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
     $image_name=addslashes($_FILES['image']['name']);
     $image_size= getimagesize($_FILES['image']['tmp_name']);  //check if img or not
     if($image_size==true)
         $status=true;
    }  
    
     if($titA!=""&& $styA!=""&& $priA!=""&& $dtA!=""&& $status==true)
    {
    $q7="INSERT INTO artwork (`Title`, `Art_Style`, `Price`, `Date`,`image`,`AUN`) VALUES ('$titA', '$styA', '$priA', '$dtA','$image','$us')";
    $conn->exec($q7);

    }
    }
}
catch(PDOException $e)
    {
      echo'failed'.$e->getMessage();
    }
    //header(``)
$conn = null;
?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <title>Art Gallery</title>
        <link rel='stylesheet'href='css/bootstrap.css'>
        <link rel='stylesheet'href='css/style.css'>
        <link href="https://fonts.googleapis.com/css?family=Lobster|Pacifico" rel="stylesheet">
         <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script >
      
     $( function() {
    $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" }).val();

  } );
  </script>
  
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
        <li><a href="http://localhost/dataproj/contests.php">Contests</a></li>
        <li class="active"><a href="#">Upload Artwork<span class="sr-only">(current)</span></a></li>
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

        <ul>
            <li><a href="http://localhost/dataproj/logout.php">Yes</a></li>
            <li ><a href="http://localhost/dataproj/myworkshop.php">No</a></li>    
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
      <div class="heldart">
          <div class="heldartinfo">
              <h1>ArtWork info</h1><br>
              <p><span class="error">* required field.</span></p>
      <form class="form" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <label for="Title">Title:</label>
        <span class="error">* <?php echo $titleErr;?></span>
        <input type="text" name="tit" class="form-control"  placeholder="Enter Title" >
      </div>
            <?php
         echo "</br>";
         ?>
         
      <div class="form-group">
        <label for="Artstyle">Style:</label>
       <select class="form-control" name="sty">
        <option value="Troiscrayons">Troiscrayons</option>
        <option value="Chiaroscuro">Chiaroscuro </option>
        <option value="Hatching">Hatching</option>
        <option value="Screentone">Screentone</option>
      </select>
      </div>
          <?php
         echo "</br>";
         ?>
        <div class="form-group">
        <label for="price">Price:</label>
        <select class="form-control" name="pri">
        <option value="10000">10,000</option>
        <option value="20000">20,000</option>
        <option value="30000">30,000</option>
        <option value="40000">40,000</option>
        <option value="50000">50,000</option>
        <option value="60000">60,000</option>
        <option value="70000">70,000</option>
        <option value="80000">80,000</option>
        <option value="90000">90,000</option>
      </select>
      </div>
          <?php
         echo "</br>";
         ?>
         
        <div class="form-group">
         <label for="Date">Date:</label>
         <span class="error">* <?php echo $dateErr;?></span>
         <input type="text" name="dt" class="form-control" id="datepicker">
         <?php
         echo "</br>";
         ?>
            </div>
              <div class="form-group">
                <label for="upload">Upload your artwork:</label>
                <input type="file" name="image" id="image">
             </div>
          <?php
         echo "</br>";
         ?>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>      
          </div>
        </div>
        </div>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
