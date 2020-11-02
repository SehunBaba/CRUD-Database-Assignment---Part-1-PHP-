<?php

// Sehun Babatunde 
//including the database connection file
include_once("functions.php");
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM accounts ORDER BY id DESC"); // using mysqli_query instead
?>



 
<html>
    

<meta charset="utf-8">
		<title>Prescriptions</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

        

    <nav class="navtop">
    	<div>
    		<h1>Prescriptions</h1>
            <a href="crud.php"><i class="fas fa-address-book"></i>Prescriptions</a>
            <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    	</div>
    </nav>





 
<body>
    <a href="add.html">Add New Prescription</a><br/><br/>
 
    <table width='80%' border=0>
        
        <tr bgcolor='#CCCCCC'>
            <td>ID</td>
            <td>Username</td>
            <td>Email</td>
            <td>Medication</td>
            <td>Doctor</td>
            <td>Time Proscribed</td>
            <td>Pickup Date</td>
            <td>Update</td>
        </tr>
        <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo "<td>".$res['id']."</td>";
            echo "<td>".$res['username']."</td>";
            echo "<td>".$res['email']."</td>";  
            echo "<td>".$res['medication']."</td>";  
            echo "<td>".$res['doctor']."</td>";
            echo "<td>".$res['time_created']."</td>";
            echo "<td>".$res['pickup_date']."</td>";
            echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";    
                
        }
        ?>
    </table>
</body>
</html>