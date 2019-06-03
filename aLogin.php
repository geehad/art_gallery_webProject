<?php
session_start();
$dsn='mysql:host=localhost;dbname=art_gallery';
 $user='root';
 $pass='';

 try{

 $db=new PDO($dsn,$user,$pass);
 $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

  $u="";
  $p=$error="";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

if(isset($_POST['uname'])){
  $u=test_input($_POST['uname']);
//}

  if(isset($_POST['Pass'])){
  $p=test_input($_POST['Pass']);
//}
     $hp=hash('sha256', $p);
      /*
     $sql="SELECT * FROM artist WHERE 'username'='$u' AND 'Password'='$hp'";
      $q=$db->query($sql);
      $count=$q->rowCount();
      echo $count;
      echo $u;
      echo $hp;
      if($count >"0") {
      $_SESSION['username']=$u;
     header("location: aboutme.php");  //yro7 lsf7t lcustomer
    }
  else{
$error="Wrong username or password";  
       }*/
     
     /*
     
     $a=$_POST['uname'];
     echo $a;
     $sth = $db->prepare("SELECT * FROM artist WHERE 'username'='$a'");
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    $count="0";
    foreach($result as $Rows)
    {
        echo "gogo";
        $count="1";
    } 
    if($count=="0"){
        $error="Wrong username or password";
        }else{
       $_SESSION['username']=$u;
     header("location: aboutme.php"); 
        }*/
     /*
      $sth = $db->prepare("SELECT COUNT('username') FROM artist WHERE 'username'='$u' AND 'Password'='$hp'");
      $sth->execute();
      $count=$sth->fetchColumn();
      if($count=="1"){
           $_SESSION['username']=$u;
     header("location: aboutme.php");
      }else{
           $error="Wrong username or password";
      }*/
     
       $sql='SELECT username,Password FROM artist';

     $q=$db->query($sql);
   while ($row = $q->fetch())
     {
    if($row['username']==$u){
        if($row['Password']==$p){  
            echo "found";
      $_SESSION['username']=$u;
     header("location: aboutme.php");
    // $t=$u;
        }
     }
    }
     $error="Wrong username or password";
     
  }//password found    
  }//userfound
  }//post

}//TRY


catch(PDOException $e){
   echo 'Failed'.$e->getMessage();
 }

 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<html>
 <head>
  <title>Artist login</title>
   <link rel="stylesheet"href="css/bootstrap.css"/>
   <link rel="stylesheet"href="css/login.css"/>
 </head>
 <body>
  
<!-- login form -->

<div class="login">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<div class="inside">
<div class="form-group" >
   <!--<label for="exampleInputEmail1"></label>-->
   <br><br>
    <input type="text" class="form-control" name="uname" id="exampleInputFname" placeholder="username" required>
  </div>
  <div class="form-group">
    <!--<label for="exampleInput">Last name</label>-->
    <input type="password" class="form-control" name="Pass" id="exampleInputLname" placeholder="password" required>
  </div>
 
 <div class="b"><button type="submit" name="login" class="btn btn-danger">login</button></div>  <!--3ayza a7ot lbutton gmb lremeber me -->
  <span><?php echo $error; ?></span>
 </div>
</form>
	</div>

    <script src="js/q1.js"></script>
     <script src="js/trial.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
 
</html>