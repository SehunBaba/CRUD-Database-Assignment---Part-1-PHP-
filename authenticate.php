
<?php

//Sehun Babatunde

// Connect to the database, validate form data, retrieve database results, and create new sessions.
session_start(); //The first thing we have to do is start the session, this allows us to remember data on the server, this will be used later on to remember logged in users.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'assignment';
// Try and connect ung the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['username'], $_POST['password']) ) {
    // Could not get the data that should be sent 
    exit('Please fill both the username and password fields!');
}

//Sql prepared statement, prevents SQL Injection
//This will prepare the SQL statement that will select the id and password from the accounts table,
// it will bind the username to the SQL statement, execute, and then store the result.

if($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Account exists, now we verify the password.
        // Note: remember to use password_hash in your registration file to store the hashed passwords.
        if (password_verify($_POST['password'], $password)) {
            // Verification success! User has loggedin!
           // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
           session_regenerate_id();
           $_SESSION['loggedin'] = TRUE;
           $_SESSION['name'] = $_POST['username'];
           $_SESSION['id'] = $id;
           //echo 'Welcome ' . $_SESSION['name'] . '!';
           header('Location: home.php');
        } else {
            echo 'Incorrect Username or Password!';
        }
    }else {
        echo 'Incorrect Username or Password!';
    }
        }
        
    
    $stmt->close();
   
    
    //First, we need to check if the query has returned any results, if the username doesn't exist in the database then there would be no results.
    //If the username exists we can bind the results to the variables: $id and $password.
    //After we can verify the password with the password_verify function, only passwords that are created with the password_hash function will work.
    //if the user is able to login with the correct details our code will create new session variables to remember the user on the server, 
    //so when the user visits the home page our PHP code can check if the session variables exist.





?>
