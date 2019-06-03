<?php
session_start();
$artistname= $_SESSION["username"];
$startErr="";
  $endErr="";
$dsn = 'mysql:host=localhost;dbname=art_gallery';
$username = 'root';
$password = '';
 try {
    $conn=new PDO($dsn,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $ar="";        //for contest form
    $pr="";
    $st="";
    $en="";
  
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    if (isset($_POST['ArtStyle']))
    {
      $ar=$_POST['ArtStyle']; 
    }
    if (isset($_POST['prizes']))
    {
      $pr=$_POST['prizes'];
    }
    if (empty($_POST["Start"])) {
    $startErr = "Start Date is required";
     } else {
    $st =$_POST["Start"];
    }
    if (empty($_POST["End"])) {
    $endErr = "End Date is required";
     } else {
    $en =$_POST["End"];
  $endErr="";
    }
    
    if($ar!=""&&$pr!=""&&$st!=""&&$en!="")
    {
     
    $q1="INSERT INTO contest (`Art_Style`, `Prize`, `Start`, `End`,`AUN`) VALUES ('$ar', '$pr', '$st', '$en','$artistname')";
    $conn->exec($q1);
     
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
  <script>
     $( function() {
    $("#datepicker1").datepicker({ dateFormat: "yy-mm-dd" }).val();

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
        <li><a href="http://localhost/dataproj/uploadartwork.php">Upload Artwork</a></li>
        <li class="active"><a href="#">Held contest<span class="sr-only">(current)</span></a></li>
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
            <li ><a href="http://localhost/dataproj/heldcont.php">No</a></li>    
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
      <div class="contest">
          <div class="info">
              <h1>Contest info</h1><br>
              <p><span class="error">* required field.</span></p>
      <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <div class="form-group">
               <label for="start">Start Date:</label>
              <input type="text" name="Start" class="form-control" id="datepicker">
               <span class="error">* <?php echo $startErr;?></span>
             </div>
            <div class="form-group">
        <label for="End">End Date:</label>
        <input type="text" name="End" class="form-control" id="datepicker1">
         <span class="error">* <?php echo $endErr;?></span>
      </div>
      <div class="form-group">
        <label for="Artstyle">Art Style:</label>
    <select class="form-control" name="ArtStyle">
        <option value="Troiscrayons">Troiscrayons</option>
        <option value="Chiaroscuro">Chiaroscuro </option>
        <option value="Hatching">Hatching</option>
        <option value="Screentone">Screentone</option>
      </select>  </div>
        <div class="form-group">
        <label for="prizes">Prize:</label>
    <select class="form-control" name="prizes">
        <option value="10000">10,000</option>
        <option value="20000">20,000</option>
        <option value="30000">30,000</option>
        <option value="40000">40,000</option>
        <option value="50000">50,000</option>
        <option value="60000">60,000</option>
        <option value="70000">70,000</option>
        <option value="80000">80,000</option>
        <option value="90000">90,000</option>
      </select>  </div>
   
     <?php
     echo "</br>"."</br>";
      ?>
          
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>      
          </div>
        </div>
        </div>
      
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
