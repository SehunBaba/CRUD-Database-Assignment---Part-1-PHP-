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

</html>





<?php
// including the database connection file
include_once("functions.php");
 
if(isset($_POST['update']))
{    
    $id = $_POST['id'];
    
    $name = $_POST['username'];
    $email = $_POST['email'];
    $doctor = $_POST['doctor'];
    $medication = $_POST['medication'];
    $pickupdate = $_POST['pickup_date'];   
    
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

        

    } else {    
        //updating the table
        $result = mysqli_query($mysqli, "UPDATE accounts SET username='$name', email ='$email', doctor ='$doctor', medication='$medication' , pickup_date='$pickupdate'  WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: crud.php");
    }
}

?>
<?php
//getting id from url
$id = $_GET['id'];
 
//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM accounts WHERE id=$id");
 

while($res = mysqli_fetch_array($result))
{  
    $name = $res['username'];
    $email = $res['email'];
    $doctor = $res['doctor'];
    $medication = $res['medication'];
    $pickupdate= $res['pickup_date']; 
}
?>
<html>
<head>    
    <title>Edit Data</title>
</head>
 
<body>
    <a href="crud.php">Home</a>
    <br/><br/>
    
  <!-- Linking the enterfields to the php variables  -->

    <form name="form1" method="post" action="edit.php">
        <table border="0">
            <tr> 
                <td>Name</td>
                <td><input type="text" name="username" value="<?php echo $name;?>"></td>
            </tr>

            <tr> 
                <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email;?>"></td>
            </tr>

            <tr> 
                <td>Doctor</td>
                <td><input type="text" name="doctor" value="<?php echo $doctor;?>"></td>
            </tr>

            <tr> 
                <td>Medication</td>
                <td><input type="text" name="medication" value="<?php echo $medication;?>"></td>
            </tr>
            
            <tr> 
                <td>Pickup Date</td>
                <td><input type="date" name="pickup_date" value="<?php echo $pickupdate;?>"></td>
            </tr>

            <tr>
                <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
            
        </table>
    </form>
</body>
</html>