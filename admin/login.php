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
		$username 	= $fm->validetion($_POST['username']);
		$userpass	= $fm->validetion(md5($_POST['password']));
		$username 	= mysqli_real_escape_string($db->link,$username);
		$userpass	= mysqli_real_escape_string($db->link,$userpass);
		$query 	= "SELECT *FROM tbl_user WHERE username='$username' AND password='$userpass'";
		$result = $db->select($query);
		if ($result != false) {
			$value = mysqli_fetch_array($result);
			$row = mysqli_num_rows($result);
			if ($row>0) {
				session ::set("login",true);
				session ::set("username",$value['username']);
				session ::set("userId",$value['id']);
				session ::set("userRole",$value['role']);
				header("Location:index.php");
			}
			else{
			echo "<span style='color:green;font-size:20px;'>No reslut found</span>";
		}
		}
		else{
			echo "<span style='color:red;font-size:20px;'>Username and Password not match</span>";
		}

	}
	?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="forgottenpass.php">Forgotten Password</a>
		</div>
		<div class="button">
			<a href="#">Dream Destinetion Admin pannel</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>