<html>
    <head>
	<?php include_once("styleIncludeHead.php"); ?>
    </head>
    <body>
	<?php include_once("nav.php"); ?>
	<div class="body-wrapper">
<form class="pure-form pure-form-stacked">
    <fieldset>
        <legend>Sign Up</legend>
	<label for="username">Username</label>
	<input type="text"  name="username" required/>
	<label for="password">Password</label>
	<input type="password" name="password" required/>
	<label for="firstname">First Name</label>
	<input type="text" name="firstname" required/>
	<label for="lastname">Last Name</label>
	<input type="text" name="lastname" required/>
	<label for="phone">Phone Number</label>
	<input type="text" name="phone" />
	<label for="email">Email Address</label>
	<input type="text" name="email" />
        <button type="submit" class="pure-button pure-button-primary">Sign in</button>
    </fieldset>
</form>
<?php
//connection information
$servername = "localhost";
$username = "root";
$password = "";


if(isset($_POST['submit'])) { //when 'submit' is clicked
	$conn = mysqli_connect($servername, $username, $password); //connect and return a reference
	if (!$conn) { //connection error checking
		die("Connection failed: " . mysqli_connect_error());
	} else {
		echo "Connected successfully<br>";
	}

	//sample query
	$query = "USE store";
	if (mysqli_query($conn, $query)) {
		echo "Database in use<br>";
	} else {
		echo "Error creating database: " . mysqli_error($conn);
	}

	//read data from HTML form fields
	$username = $_POST['username'];
	$password = $_POST['password'];
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	
	//determine if userName is available
	$query = "SELECT * FROM customer";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			if($row['userName'] == $username) {
				echo "<p>Username already exists. Try again.</p>";
				exit;
			}
		}
	}
	
	
	//insert new user
	$query = "INSERT INTO customer VALUES('$username', '$password', '$lastname', '$firstname', null, '$phone', '$email')";
	mysqli_query($conn, $query);
		
	setcookie("username",$username,time()+24*60*60*30);
	header('Location: mainpage.php');
	$query = "SELECT * FROM customer";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		echo "<table border=2>";
		echo "<tr><th>Username</th><th>Password</th><th>Last Name</th><th>First Name</th><th>Address</th><th>Phone</th><th>Email</th></tr>";
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>".$row['userName']."</td><td>".$row['passcode']."</td><td>".$row['lastName']."</td><td>".$row['firstName']."</td><td>".$row['userAddress']."</td><td>".$row['phone']."</td><td>".$row['email']."</td></tr>";
		}
		echo "</table>";
	}

	mysqli_close($conn);
}


?>
</div>
</body>
</html>







