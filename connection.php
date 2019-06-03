<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=art_gallery';
$username = 'root';
$password = '';

try {
    $conn=new PDO($dsn,$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                           
    
    $usn="";        //for update profile
    $pss="";
    $bd="";
    $bhis="";     
     
    
    if (isset($_GET['usernam']))   //for update account  ->start
    {
      $usn=$_GET['usernam']; 
    }
    if (isset($_POST['passu']))
    {
        $pss=$_POST['passu'];
    }
    if (isset($_GET['birthdate']))
    {
      $bd=$_GET['birthdate']; 
    }
    if (isset($_GET['briefhis']))
    {
      $bhis=$_GET['briefhis'];          //for update account  ->end
    }
      
    
    $us= $_SESSION["username"];
    
    if($pss!="")
    {
    $q3 = "UPDATE `artist` SET `Password` =". "'$pss'"." WHERE `artist`.`username` = '$us'".";\"";
    $stmt1 = $conn->prepare($q3);
    $stmt1->execute();
    $stmt1->closeCursor();
    }
    if($bd!="")
    { 
    $us= $_SESSION["username"];
    $q4 = "UPDATE `artist` SET `Bdate` =". "'$bd'"." WHERE `artist`.`username` = '$us'".";\"";
    $stmt2 = $conn->prepare($q4);
    $stmt2->execute();
     $stmt2->closeCursor();
    }
    if($bhis!="")
    { 
    $us= $_SESSION["username"];
    $q5 = "UPDATE `artist` SET `Brief_History` =". "'$bhis'"." WHERE `artist`.`username` = '$us'".";\"";
    $stmt3 = $conn->prepare($q5);
    $stmt3->execute();
     $stmt3->closeCursor();
    }
    if($usn!="")
    { 
    $us= $_SESSION["username"];
    $q6 = "UPDATE `artist` SET `username` =". "'$usn'"." WHERE `artist`.`username` = '$us'".";\"";
    $stmt4 = $conn->prepare($q6);
    $stmt4->execute();
    $stmt4->closeCursor();
    $_SESSION["username"]="$usn";
    }
 
    }
 
catch(PDOException $e)
    {
      echo'failed'.$e->getMessage();
    }
    header('location:aboutme.php');
$conn = null;
?>