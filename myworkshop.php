<?php
session_start();
$us= $_SESSION["username"];
if(isset($_GET["sub"])) 
{
    $dsn = 'mysql:host=localhost;dbname=art_gallery';
$username = 'root';
$password = '';
    $id=$_GET["sub"]; //get name of contest_artwork 
    try {
    $conn=new PDO($dsn,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query="DELETE FROM workshop WHERE ID=$id";
     $conn->exec($query); 
     }
        
        catch(PDOException $e)
    {
      echo'failed'.$e->getMessage();
    }
$conn = null;
} 
?>

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
        <li class="active"><a href="#">My Workshop<span class="sr-only">(current)</span></a></li>
        <li><a href="http://localhost/dataproj/contests.php">Contests</a></li>
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
            <li ><a href="http://localhost/dataproj/myworkshop.php">No</a></li>    
        </ul>
            
            
        </div>  
        </div>
    </div>
    </div>
        </ul>
  </div><!-- /.container-fluid -->
      </div>
</nav>
<!--navbar-->
      <div class="myworkshop">
          <h1>Your Current Workshops <img src="imiges/1481530319_Art_supplies.png"></h1>
          
          <?php
         $dsn = 'mysql:host=localhost;dbname=art_gallery';
         $username = 'root';
         $password = '';
         $result="";
         $Rows="";
         $count=0;
    try { 
    $conn=new PDO($dsn,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sth = $conn->prepare("SELECT * FROM workshop WHERE AUN='$us'");
     $sth->execute();
     
     $result = $sth->fetchAll(PDO::FETCH_ASSOC);
       ?>          
         <?php foreach($result as $Rows)
          {  
             ?>
        <?php $endd=$Rows['End'];
        $now = time();
        if($now <strtotime( $Rows['End']))
        {?>
         
             <div class="myworkshopinfo">
                 <?php $id=$Rows['ID'];?>
                 <form action="" method="get">
                 <div class="button">
                     <button type="submit" class="btn btn-primary btn-lg">
                <span class="glyphicon glyphicon-trash"></span>
               </button>
                 </div>
                   <?php echo"<input type='hidden' name='sub' value="."$id".">";?>
                 </form>
				 <?php $count++; ?>
              <div class="wshop">
              <?php echo "<h2> start</h2> :   "."<h4>".$Rows['Start']."</h4>"."<br>"?> 
              <?php echo "<h2> End</h2> :   "."<h4>".$Rows['End']."</h4>"."<br>"?>
              <?php echo "<h2> Cost</h2>  :   "."<h4>".$Rows['Cost']."</h4>"."<br>"?>
              <?php echo "<h2> Address</h2>  :   "."<h4>".$Rows['Address']."</h4>"."<br>"?> 
              <?php
              $id=$Rows['ID'];
              $sth = $conn->prepare("SELECT * FROM train_in WHERE W_ID='$id';");
              $sth->execute();
              $result = $sth->fetchAll(PDO::FETCH_ASSOC);
             $number_of_rows = $sth->rowCount();
             //echo $number_of_rows;
             echo "<h2> no.of trainee</h2> :   "."<h4>".$number_of_rows."</h4>"."<br>";
              ?>
              </div>
          </div>
        <?php } ?>
          <?php
          }
    }
    catch(PDOException $e)
    {
      echo'failed'.$e->getMessage();
    }
    //header(``)
$conn = null;
          
          if($count==0)
          {
               echo'<img src="imiges/Noworkshopvailable.jpg">';
          }
echo " <h2>number of your workshops $count</h2>";
          ?> 
        </div>
       <!-- </div>-->
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>