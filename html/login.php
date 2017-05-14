<?php include "../inc/dbinfo.inc"; ?>

<html>
<head>  <link rel="stylesheet" type="text/css" href="stylesheet.css">
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
  if (isset($_POST['login'])){
  $userName = htmlentities($_POST['userName']);
  $pWord = htmlentities($_POST['pWord']);

    Login($connection, $userName, $pWord);
  }
?>
<form>
            <fieldset>
                <legend>Log in</legend>

                 <label>UserName</label>
                <input name = "username" id="username" type = "username"><br><br>
                 <label>Password</label>
                <input name="pWord" id="pWord" type = "password"><br><br>

                <input name="login" id="login" type = "submit" value= "Login">

                 <input name="reset" id="reset" type = "reset" value= "Reset">




    </fieldset>


        </form>
        </div>
    </body>
    </html>

    <?php
    function Login($connection, $userName, $pWord) {
       $u = mysqli_real_escape_string($connection, $userName);
       $p = mysqli_real_escape_string($connection, $pWord);

       $query = "SELECT * FROM `Customer` WHERE `userName`='$u'AND `pWord`='$p';";


       if(!mysqli_query($connection, $query))
       echo("<p>Error adding employee data.</p>");
       else {
         echo("WELCOME ".$u);
       }
       }
    }

    ?>
