<?php include "inc/header.php";?>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	$fname = $fm->validetion($_POST['fname']);
	$lname = $fm->validetion($_POST['lname']);
	$email = $fm->validetion($_POST['email']);
	$body  = $fm->validetion($_POST['body']);
	$fname = mysqli_real_escape_string($db->link,$fname);
	$lname = mysqli_real_escape_string($db->link,$lname);
	$email = mysqli_real_escape_string($db->link,$email);
	$body  = mysqli_real_escape_string($db->link,$body);
	 $error = "";
	 if (empty($fname)) {
	  $error = "FirstName must not be empty !";
	 }
	 elseif (!filter_var($fname, FILTER_SANITIZE_SPECIAL_CHARS)) {
	 	$error = "Invalid First Name !";
	 }
	 elseif (empty($lname)) {
	 	$error = "LastName must not be empty !";
	 }
	 elseif (!filter_var($lname, FILTER_SANITIZE_SPECIAL_CHARS)) {
	 	$error = "Invalid Last Name !";
	 }
	 elseif (empty($email)) {
	 	$error = "Email Address must not be empty !";
	 }
	 elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	 	$error = "Invalid email format !";
	 }
	 elseif (empty($body)) {
	 	$error = "Message filed must not be empty !";
	 }
 	else{
		 $query = "INSERT INTO tbl_contact(fname,lname,email,body) values('$fname','$lname','$email','$body')";
		 $insert_row = $db->insert($query);
		 if ($insert_row) {
		 $msg = "Your Message Sent Successfully !";
		 		 }
		 		 else{
		 		 	$error = "Your Message Not Sent Successfully";
		 		 }
		}
		}
 ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php
				if (isset($error)) {
					echo "<span style ='color:red'>$error</span>";
				}
				if (isset($msg)) {
					echo "<span style ='color:green'>$msg</span>";
				}
				
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="fname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lname" placeholder="Enter Last name"/>
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="text" name="email" placeholder="Enter Email Address"/>
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

</div>
		<?php include "inc/sidebar.php"; ?>
		<?php include "inc/footer.php"; ?>