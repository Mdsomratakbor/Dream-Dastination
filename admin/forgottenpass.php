<?php include"../lib/session.php";
 session::checklogin();
?>

<?php include "../helpers/Formate.php";?>
<?php include "../config/config.php";?>
<?php include "../lib/Database.php";?>

<?php 
	$db = new Database();
	$fm = new formate();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>

<div class="container">
	<section id="content">
			<?php
	if ($_SERVER["REQUEST_METHOD"] == 'POST') {
		$email 	= $fm->validetion($_POST['email']);
		$email 	= mysqli_real_escape_string($db->link,$email);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	 	    echo  "<span style='color:red;font-size:20px;'>Invalid email format!</span>";
		 }
		else{
		$mailquery 	= "SELECT *FROM tbl_user WHERE email='$email' limit 1";
		$mailcheck = $db->select($mailquery);
		if ($mailcheck) {
		while ($value = $mailcheck->fetch_assoc()) {
			$userid 	= $value['id'];
			$username   = $value['username'];

		}
		$text = substr($email, 0,4);
		$ran  = rand(1000, 90000);
		$newpass = "$text$ran";
		$password = md5($newpass);
		$updatequery = "UPDATE tbl_user
		SET 
		password = '$password'
		where id ='$userid'";
		$update_row = $db->update($updatequery);

		$to = "$email";
		$from = "somrat@gmail.com";
		$headers = "From:$from\n";
		$headers .= 'MIME-Version: 1.0';
		$headers .= 'Content-type: text/html; charset=iso-8859-1';
		$subject ="Your New Password";
		$message ="Your name is :".$username."your new password :".$newpass."please visit your login page";

		$sendmail = mail($to, $subject, $message,$headers);
		if ($sendmail) {
			echo "<span class='success'>Please cheack your email for new password !</span>";
		}
		else
		{
			echo "<span style='color:red;font-size:20px;'>Your Email Not Sent !</span>";
		}
		}
		else{
			echo "<span style='color:red;font-size:20px;'>Email not exists !</span>";
		}

	}
}
	?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter valid Email.." required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Log in</a>
		</div>
		<div class="button">
			<a href="#">Dream Destinetion Admin pannel</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>