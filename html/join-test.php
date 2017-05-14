<?php include "../inc/dbinfo.inc"; ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">

    </head>

    <body style="background: linear-gradient(to right,  blue 10%,gray 30%,red 50%,yellow 100%);">


        <div id = "container">
<form id="customer" name="customer"  action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">

			<form id="customer" method="post" name="customer">
            <fieldset>
                <legend>Customer Sign up</legend>
				<!--Hidden fields that prevent spam and tell what type of event -->
				<input type="hidden" name="m_m_name" value="" />
                <label>FirstName</label>
                <input name = fName id = fName class = "required" type = "text" placeholder="Enter Your FirstName"><br>
                <label>LastName</label>
                <input name = lName id = lName class = "required" type = "text" placeholder="Enter Your LastName"><br>

                 <label>Street</label>
                <input name = street id = street class = "required" type = "text" placeholder="Enter Your Street Address"><br>
				<label>City</label>
                <input name = city id = city class = "required" type = "text" placeholder="Enter Your City"><br>
				<label>State</label>
                <input name = state id = state class = "required" type = "text" placeholder="Enter Your State"><br>
				<label>Zip</label>
                <input name = zip id = zip class = "required" type = "text" placeholder="Enter Your Zipcode"><br>
					<!-- CTRL+q comment out selected block of code in notepad++ -->
					 <!-- <label>Over 18 years old</label><br> -->
					<!-- <input type = "radio" name = "age"> Yes<br> -->
					<!-- <input type = "radio" name ="age">No <br><br> -->
					 <!-- <label>Birthdate</label> -->
					<!-- <input type = "date" name= "bday" max = "1979-12-31"><br><br> -->
					 <!-- <label for = "form-phone">Your phone number</label> -->
					<!-- <input type = "tel" id = "form-phone"> -->
				<!-- <select> -->
	<!--   					<option value="one">Choose Your Pet</option> -->
	<!--   					<option value="dog">Dog</option> -->
	<!--   					<option value="cat">Cat</option> -->
	<!--  					<option value="rabbit">Rabbit</option> -->
						<!-- <option value="bird">Bird</option> -->
						<!-- <option value="lizard">Lizard</option> -->
					<!-- </select><br><br> -->
                <label>Email</label>
                <input name = email id = email type = "email" placeholder="Your@email.com"><br>
				<label>UserName</label>
                <input name = userName id = userName class = "required" type = "username"><br><br>
                 <label>Password</label>
                <input name = pWord id = pWord class = "required" type = "password"><br><br>
                 <label>Message</label><br>
                <textarea name = message id = message rows = "10" cols="80"></textarea><br><br>

                <input type = "reset" value= "Reset">
				<input  type="submit" value="Submit" >

			</fieldset>
			</form>

          <?php	

			 $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);


			if(isset($_POST['submit'])) { //when 'submit' is clicked
			        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
				if (!$conn) { //connection error checking
					die("Connection failed: " . mysqli_connect_error());
				} else {
					echo "Connected successfully<br>";
				}
				$query = "USE petpals";
				if (mysqli_query($conn, $query)) {
					echo "Database in use";
				} else {
					echo "Error creating database: " . mysqli_error($conn);
				}

				//read data from HTML form fields
				$fName = $_POST['fName'];
				$lName = $_POST['lName'];
				$street = $_POST['street'];
				$city = $_POST['city'];
				$state = $_POST['state'];
				$zip = $_POST['zip'];
				$email = $_POST['email'];
				$userName = $_POST['userName'];
				$pWord = $_POST['pWord'];
				$message = $_POST['message'];
				//insert new user

				$query = "INSERT INTO 'Customer' VALUES('$fName', '$lName', '$street', '$city', '$state', '$zip', '$email', '$userName', '$pWord', '$message')";
				mysqli_query($conn, $query);

				mysqli_close($conn);
			}
			?>

        </div>
    </body>
    </html>
