<?php 

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'registration';
// Try and connect using the info above.

// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['firstname']) || !isset($_POST['lastname'])  || !isset($_POST['address1']) || !isset($_POST['city']) || !isset($_POST['state']) || !isset($_POST['zip']) || !isset($_POST['country']))
	{
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
     }
// Make sure the submitted registration values are not empty.
if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['address1']) || empty($_POST['city'])|| empty($_POST['state'])|| empty($_POST['zip'])|| empty($_POST['country']) ) {
	// One or more values are empty.
	exit('Please complete the registration form');
   }

if ((strlen($_POST['zip']) != 5 && strlen($_POST['zip']) != 10) || (strlen($_POST['zip']) == 10  && !preg_match("/-/i",$_POST['zip'])))
{
	die("Please enter a valid zipcode!");
}

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);


if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }

   //Insert New User 
if ($stmt = $con->prepare('INSERT INTO users (first_name,last_name,address_1,address_2,city,state,zip,country,`date`) VALUES (?, ?, ?, ?, ? ,? , ? , ?, NOW())')) {
	$stmt->bind_param('ssssssss', $_POST['firstname'], $_POST['lastname'], $_POST['address1'],$_POST['address2'], $_POST['city'], $_POST['state'], $_POST['zip'],$_POST['country']);
	$stmt->execute();
	echo 'You have successfully registered!';
} else {
	// Something is wrong with the sql statement.
	echo 'Internal server error, please contact site administrator!';
}
$con->close();
?>