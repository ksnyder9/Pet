<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1>Sample page</h1>
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the Employees table exists. */
  VerifyCustomerTable($connection, DB_DATABASE); 

  /* If input fields are populated, add a row to the Employees table. */
  $customer_fName = htmlentities($_POST['fName']);
  $customer_lName = htmlentities($_POST['lName']);
  $customer_street = htmlentities($_POST['street']);
  $customer_city = htmlentities($_POST['city']);
  $customer_state = htmlentities($_POST['state']);
  $customer_zip = htmlentities($_POST['zip']);
  $customer_email = htmlentities($_POST['email']);
  $customer_userName = htmlentities($_POST['userName']);
  $customer_pWord = htmlentities($_POST['pWord']);
  $customer_message = htmlentities($_POST['message']);


  if (strlen($customer_fName) || strlen($customer_lName)) {
    AddEmployee($connection, $customer_fName, $customer_lName, $customer_street, $customer_city, $customer_state, $customer_zip, $customer_email, $customer_userName, $customer_pWord, $customer_message);
  }
?>

<!-- Display table data. -->
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>FirstName</td>
    <td>LastName</td>
    <td>Street</td>
    <td>City</td>
    <td>State</td>
    <td>Zip</td>
    <td>Email</td>
    <td>UserName</td>
    <td>Password</td>
    <td>Message</td>
  </tr>

<?php

$result = mysqli_query($connection, "SELECT * FROM Customer"); 

while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>",$query_data[0], "</td>",
       "<td>",$query_data[1], "</td>",
       "<td>",$query_data[2], "</td>",
       "<td>",$query_data[3], "</td>",
       "<td>",$query_data[4], "</td>",
       "<td>",$query_data[5], "</td>",
       "<td>",$query_data[6], "</td>",
       "<td>",$query_data[7], "</td>",
       "<td>",$query_data[8], "</td>",
       "<td>",$query_data[9], "</td>";

  echo "</tr>";
}
?>

</table>

<!-- Clean up. -->
<?php

  mysqli_free_result($result);
  mysqli_close($connection);

?>

</body>
</html>


<?php
 /* Add an employee to the table. */
function AddCustomer($connection, $customer_fName, $customer_lName, $customer_street, $customer_city, $customer_state, $customer_zip, $customer_email, $customer_userName, $customer_pWord, $customer_message) {
   $f = mysqli_real_escape_string($connection, $customer_fName);
   $l = mysqli_real_escape_string($connection, $customer_lName);
   $s = mysqli_real_escape_string($connection, $customer_street);
   $c = mysqli_real_escape_string($connection, $customer_city);
   $t = mysqli_real_escape_string($connection, $customer_state);
   $z = mysqli_real_escape_string($connection, $customer_zip);
   $e = mysqli_real_escape_string($connection, $customer_email);
   $u = mysqli_real_escape_string($connection, $customer_userName);
   $p = mysqli_real_escape_string($connection, $customer_pWord);
   $m = mysqli_real_escape_string($connection, $customer_message);


   $query = "INSERT INTO 'Customer' ('fName', 'lName', 'street', 'city', 'state', 'zip', 'email', 'userName', 'pWord', 'message') VALUES ('$f', '$l', '$s', '$c', '$t', '$z', '$e', '$u', '$p', '$m');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>");
}

/* Check whether the table exists and, if not, create it. */
function VerifyCustomerTable($connection, $dbName) {
     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}

?>
