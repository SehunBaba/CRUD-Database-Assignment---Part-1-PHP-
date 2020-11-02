<?php

//Sehun Babatunde

//including the database connection file
include("functions.php");
 
//getting id of the data from url
$id = $_GET['id'];
 
//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM accounts WHERE id=$id");
 
//redirecting to the display page (index.php in our case)
header("Location:crud.php");

?>