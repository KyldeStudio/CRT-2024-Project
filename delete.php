<?php 
if(isset($_GET["id"])){
    $id = $_GET["id"];

    include("connection.php");
    error_reporting(0);

    $sql= "DELETE FROM students WHERE id=$id";
    $conn->query($sql);
}

header("location:/IT05,ELEC7/index.php");
exit;
?>