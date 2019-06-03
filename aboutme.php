<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=art_gallery';
$username = 'root';
$password = '';
$passw="";
$bdate="";
$bhist="";
try {
    $conn=new PDO($dsn,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $usern= $_SESSION["username"];
    $sql1 = "SELECT Password FROM artist where username=\"$usern\"";
    $data1 = $conn->query($sql1);
    $sql2 = "SELECT Bdate FROM artist where username=\"$usern\"";
    $data2 = $conn->query($sql2);
    $sql3 = "SELECT Brief_History FROM artist where username=\"$usern\"";
    $data3 = $conn->query($sql3);
    }
    catch(PDOException $e)
    {
      echo'failed'.$e->getMessage();
    }
    $pass = $data1->fetch();
    $passw=$pass['Password'];
    $bdatew = $data2->fetch();
    $bdate=$bdatew['Bdate'];
    $bhistw = $data3->fetch();
    $bhist=$bhistw['Brief_History'];
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
        <li class="active"><a href="#">About Me<span class="sr-only">(current)</span></a></li>
        <li><a href="http://localhost/dataproj/myworkshop.php">My Workshop</a></li>
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
            <li><a href="http://localhost/dataproj/wel.php">Yes</a></li>
            <li ><a href="http://localhost/dataproj/aboutme.php">No</a></li>    
        </ul>            
        </div>  
        </div>
    </div>
    </div>
        </ul>
  </div><!-- /.container-fluid -->
      </div>
</nav>
  </div>
<!--navbar-->
     <div class="container-fluid">
     <div class="parentaboutme">
            <div class="im">
            </div>
         <div class="artistinfo">
         <div class="usern">
         <form class="form" action="connection.php" method="get">
             <div><h3>Username</h3>></div>
             <input type="text" name="usernam" value="<?php echo $_SESSION["username"];?>" disabled>
             
             <button class="btn btn-primary btn-sm dropdown-toggle" type="button">Edit</button>
        </form>
         </div>
         <div class="userpass">
         <form class="form" action="connection.php" method="post" >
             <div><h3>Password:</h3></div>
        <input type="text" name="passu" value="<?php echo $passw;?>" disabled="">
        
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" >Edit</button>
        </form>
         </div>
             <div class="userbd">
         <form class="form" action="connection.php" method="get">
             <div><h3>Birthdate</h3></div>
        <input type="text" name="birthdate" value="<?php echo $bdate; ?>" disabled>
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button">Edit</button>
        </form>
         </div>
         <div class="userbh">
         <form class="form" action="connection.php" method="get">
             <div><h3>Brief-History</h3></div>
        <input type="text" name="briefhis" value="<?php echo $bhist;?>" disabled>
        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" >
         Edit 
         </button>
        </form>
         </div>
     </div>
     </div>
     </div>
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
        $(function () {
             'use strict';
         $('button').click(function () {
         console.log($(this).text());

         if ($(this).text().trim() == "Edit") {
           $(this).prev('input').removeAttr('disabled');
           $(this).text('save');
         } else if($(this).text().trim() == "save") {
                        $(this).prev('input').removeAttr('disabled');

         $(this).text('Edit');
         $(this).parent('form').submit();
        }
    });
       });    
header('aboutme.php');
        </script>
    </body>
</html>