<html>

<!-- Sehun Babatunde -->

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




<head>
    <title>Add Data</title>
</head>
 
<body>
<?php
//including the database connection file
include_once("functions.php");
 
if(isset($_POST['Submit'])) {    
    $name = $_POST['username'];
    $email = $_POST['email'];
    $doctor = $_POST['doctor'];
    $medication = $_POST['medication'];
    $pickupdate= $_POST['pickup_date'];
        
    // checking empty fields
    if(empty($name) || empty($email) || empty($doctor) || empty($medication) || empty($pickupdate)) {                
       
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br/>";
        }
        
        if(empty($email)) {
            echo "<font color='red'>Email field is empty.</font><br/>";
        }
        
        if(empty($doctor)) {
            echo "<font color='red'>Doctor's name field is empty.</font><br/>";
        }
        
        if(empty($medication)) {
            echo "<font color='red'>Medication name field is empty.</font><br/>";
        }

        if(empty($pickupdate)) {
            echo "<font color='red'>Pickup date field is empty.</font><br/>";
        }


        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else { 
        // if all the fields are filled (not empty)             
        //insert data to database
        $result = mysqli_query($mysqli, "INSERT INTO accounts(username,email,medication,doctor,pickup_date) VALUES('$name','$email','$medication', '$doctor', '$pickupdate' )");
        
        //display success message
        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='crud.php'>View Result</a>";
    }
}
?>
</body>
</html>