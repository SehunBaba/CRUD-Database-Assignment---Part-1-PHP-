<?php

//Sehun Babatunde

//Initialize sessions and destroy them (if any) and redirect the user to the login page, 
//we use sessions to determine if the user is logged in or not so by removing them the user will not be logged in.

session_start();
session_destroy();
//Redirect to the login page:
header('Location: index.html');
?>