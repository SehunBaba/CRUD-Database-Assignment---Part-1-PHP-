<?php

//Sehun Babatunde

// Using sessions, always start session with following code.
session_start();
//If the user is not logged in, be redirected to the login page
if(!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>  
    <body class="loggedin">
        <nav class="navtop">   
            <div>
                <h1>Home</h1>
                <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                <a href="crud.php"><i class="fas fa-address-book"></i>Prescriptions</a>
                
		<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
            </div>
        </nav>
        <div class="content">
            <h2> Home Page</h2>
            <p>Welcome back Doctor, <?=$_SESSION['name']?>!</p>
        </div>
    </body>
</html>



