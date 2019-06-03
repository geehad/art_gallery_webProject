<html>
 <head>
  <title>Welcome</title>
   <link rel="stylesheet"href="css/bootstrap.css"/>
   <link rel="stylesheet"href="css/wel.css"/>
 </head>
 <body>
  <div class="word">Everything has a beuty but not everyone sees it </div>

  <div class="join">
  <div class="dropdown">
   <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Join
    <span class="caret"></span>
   </button>
      
   <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    
   <?php
   
	    echo "<li><a href=\"../dataproj/aForm.php\">Artist</a></li>\n";
    echo "<li><a href=\"../dataproj/gForm.php\">Art Gallery</a></li>\n";
	 echo "<li><a href=\"../dataproj/cForm.php\">Cusomer</a></li>\n";

    ?>

   </ul>
  </div>
  </div>
  
  <div class="Signin">
  <div class="dropdown">
   <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    Sign in
    <span class="caret"></span>
   </button>
   <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
    <li><a href="http://localhost/dataproj/aLogin.php">Artist</a></li>
    <li><a href="http://localhost/dataproj/gLogin.php">Art Gallery</a></li>
   <?php
    echo "<li><a href=\"../dataproj/Clogin.php\">Cusomer</a></li>\n";
    ?>
   </ul>
  </div>
  </div>
	
    <script src="js/q1.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
 
</html>
