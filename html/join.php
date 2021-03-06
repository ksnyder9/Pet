<?php include "../inc/dbinfo.inc"; ?>
<html>
<head>  <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
  <body style="background: linear-gradient(to right, gray 0.2%,rgba(25,52,84,1) 100%);">
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the Customer table exists. */
  VerifyCustomerTable($connection, DB_DATABASE);

  /* If input fields are populated, add a row to the Customer table. */
  if (isset($_POST['submit'])){
  $fname = htmlentities($_POST['fName']);
  $lname = htmlentities($_POST['lName']);
  $street = htmlentities($_POST['street']);
  $city = htmlentities($_POST['city']);
  $state = htmlentities($_POST['state']);
  $zip = htmlentities($_POST['zip']);
  $email = htmlentities($_POST['email']);
  $userName = htmlentities($_POST['userName']);
  $pWord = htmlentities($_POST['pWord']);
  $message = htmlentities($_POST['message']);

    AddCustomer($connection, $fname, $lname, $street, $city, $state, $zip, $email, $userName, $pWord, $message);
  }
?>

<!-- Input form -->
<div id = "container">
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" id="customer" name="customer" method="POST">
            <fieldset>
                <legend>Customer Sign up</legend>
				<!--Hidden fields that prevent spam and tell what type of event -->
				<input type="hidden" name="m_m_name" value="" />
                <label>FirstName</label>
                <input name = "fName" id = "fName" class = "required" type = "text" placeholder="Enter Your FirstName"><br>
                <label>LastName</label>
                <input name = "lName" id = "lName" class = "required" type = "text" placeholder="Enter Your LastName"><br>

                 <label>Street</label>
                <input name = "street" id = "street" class = "required" type = "text" placeholder="Enter Your Street Address"><br>
				<label>City</label>
                <input name = "city" id = "city" class = "required" type = "text" placeholder="Enter Your City"><br>
				<label>State</label>
                <input name = "state" id = "state" class = "required" type = "text" placeholder="Enter Your State"><br>
				<label>Zip</label>
                <input name = "zip" id = "zip" class = "required" type = "text" placeholder="Enter Your Zipcode"><br>


                <label>Email</label>
                <input name = "email" id = "email" type = "email" placeholder="Your@email.com"><br>
				<label>UserName</label>
                <input name = "userName" id = "userName" class = "required" type = "username"><br><br>
                 <label>Password</label>
                <input name = "pWord" id = "pWord" class = "required" type = "password"><br><br>
                 <label>Message</label><br>
                <textarea name = "message" id = "message" rows = "10" cols="80"></textarea><br><br>

                <input id="reset" name"reset" type = "reset" value= "Reset">
		<input id="submit" name="submit" type="submit" value="Submit" >

			</fieldset>

</form>
</div>


<!-- Clean up. -->
<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</html>


<?php

/* Add an employee to the table. */
function AddCustomer($connection, $fname, $lname, $street, $city, $state, $zip, $email, $userName, $pWord, $message) {
   $f = mysqli_real_escape_string($connection, $fname);
   $l = mysqli_real_escape_string($connection, $lname);
   $s = mysqli_real_escape_string($connection, $street);
   $c = mysqli_real_escape_string($connection, $city);
   $t = mysqli_real_escape_string($connection, $state);
   $z = mysqli_real_escape_string($connection, $zip);
   $e = mysqli_real_escape_string($connection, $email);
   $u = mysqli_real_escape_string($connection, $userName);
   $p = mysqli_real_escape_string($connection, $pWord);
   $m = mysqli_real_escape_string($connection, $message);

   $query = "INSERT INTO `Customer` (`fName`, `lName`, `street`, `city`, `state`, `zip`, `email`, `userName`, `pWord`, `message`) VALUES ('$f', '$l', '$s', '$c', '$t', '$z', '$e', '$u', '$p', '$m');";


   if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>");
}

/* Check whether the table exists and, if not, create it. */
function VerifyCustomerTable($connection, $dbName) {
  if(!TableExists("Customer", $connection, $dbName))
  {
     $query = "CREATE TABLE `Customer` (
         `ID` int(11) NOT NULL AUTO_INCREMENT,
         `Name` varchar(45) DEFAULT NULL,
         `Address` varchar(90) DEFAULT NULL,
         PRIMARY KEY (`ID`),
         UNIQUE KEY `ID_UNIQUE` (`ID`)
       ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>

