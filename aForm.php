<?php
session_start();
$dsn='mysql:host=localhost;dbname=art_gallery';
 $user='root';
 $pass='';
 
 try{
 $db=new PDO($dsn,$user,$pass);
 $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

// define variables and set to empty values

$afname=$alname=$auser=$aemail=$passw=$birth=$addr=$g=$history=$art=$hpass="";
$Euser=$Ep="";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["fname"])) {
    $afname = test_input($_POST["fname"]);
  }

    if (isset($_POST["lname"])) {
    $alname = test_input($_POST["lname"]);
  }

   
  if (isset($_POST["email"])) {
    $aemail = test_input($_POST["email"]);
  }

  if (empty($_POST["usern"])) {
    $Euser = "username is required";
  } else{
    $auser = test_input($_POST["usern"]);
    if(strlen($auser)<8 || strlen($auser)>20){
      $Euser = "Should be between 8-20 charcters";
       $auser ="";
    }else{
    $sql='SELECT username FROM artist';

     $q=$db->query($sql);
   while ($row = $q->fetch())
     {
    if($row['username']==$auser){
      $Euser = "This username is used";
      $user="";
     }
    }
  }
  }

  if (isset($_POST["pass"])) {
    $passw = test_input($_POST["pass"]);
       if(strlen($passw)<8){
      $Ep="password is too short";
      $passw="";
    }else{
    $hpass= hash('sha256', $passw);}
  }

 
if (isset($_POST["add"])) {
    $addr = test_input($_POST["add"]);
  }

   
if (isset($_POST["style"])) {
    $art = test_input($_POST["style"]);
  }


  if (isset($_POST["bdate"])) {
    $birth= test_input($_POST["bdate"]);
  }


  if (isset($_POST["History"])) {
    $history= test_input($_POST["History"]);
  }

   if (empty($_POST["gender"])) {
    $g= "";
  } else {
    if(test_input($_POST['gender'])=="Female"){
   $g=2;
 }else{
   $g=1;
 }
  }

 if($afname!="" && $alname!="" && $auser!="" && $aemail!="" && $passw!="" && $addr !=""&& $birth!="" && $g!=""){
  $q= "INSERT INTO artist(username,Fname,Lname,Password,Email,Bdate,Art_Style,Brief_History,gender) VALUES('$auser','$afname','$alname','$passw','$aemail','$birth','$art','$history','$g')";   
 $db->exec($q);}
 header('location:aboutme.php');
 $_SESSION['username']=$auser;
  }
}
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
  <title>Artist Form</title>
   <link rel="stylesheet"href="css/bootstrap.css"/>
   <link rel="stylesheet"href="css/a.css"/>
 </head>
 <body>
   <!-- form-->
  <div class="out">
  <div class="a">
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="form-group" >
    <label for="exampleInputEmail1">First name</label>
    <input type="name" name="fname"class="form-control" id="exampleInputFname" required>
  </div>
  <div class="form-group">
    <label for="exampleInputLname">Last name</label>
    <input type="name" name="lname"class="form-control" id="exampleInputLname"  required>
  </div>
   <div class="form-group">
    <label for="exampleInputUsername">Username</label>
    <input type="name" name="usern" class="form-control" id="exampleInputusername"  required>
     <span class="error"> <?php echo $Euser;?></span>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1"  required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="pass" class="form-control" id="exampleInputPassword1" required>
     <span class="error"> <?php echo $Ep;?></span>
  </div>
  <!--
   <div class="form-group">
    <label for="exampleInputPassword1">Art Style</label>
    <input type="text" name="style" class="form-control" id="exampleInputPassword1" placeholder="ArtStyle" required>
  </div>
  -->
     <div class="form-group">
        <label for="Artstyle">Art Style:</label>
    <select class="form-control" name="ArtStyle">
        <option value="Troiscrayons">Troiscrayons</option>
        <option value="Chiaroscuro">Chiaroscuro </option>
        <option value="Hatching">Hatching</option>
        <option value="Screentone">Screentone</option>
      </select>  </div>

  <div class="form-group">
    <label for="exampleInputBirthdate1">Birth date</label>
    <input type="date" name="bdate" class="form-control" id="exampleInputBdate" placeholder="year/month/day">
    
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Address</label>
    <input type="Address" name="add" class="form-control" id="exampleInputAddress" placeholder="Address" required><br>
  <div class="end">
  </div>
  <input type="radio" name="gender" value="Male">Male<br>
     <input type="radio" name="gender" value="Female">Female<br><br>
</div>
    <textarea name="History" rows="6" cols="100"></textarea><br><br>
  <button type="submit" class="btn btn-danger">Sign up</button>
</form>
  </div>
  </div>
 
  <script src="js/q1.js"></script>
  <script src="js/bootstrap.min.js"></script>
 </body>
 
</html>