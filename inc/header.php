<?php include "helpers/Formate.php";?>
<?php include "config/config.php";?>
<?php include "lib/Database.php";?>

<?php 
	$db = new Database();
	$fm = new formate();
?>
<!DOCTYPE html>
<html>
<head>
	<?php include "scripts/meta.php"; ?>
	<?php include "scripts/css.php"; ?>
	<?php include "scripts/js.php"; ?>
</head>

<body>
	<div class="headersection templete clear">
		<?php
		$query = "SELECT * FROM  title_slogan where id='1'";
		$showdata = $db->select($query);
		if ($showdata) {
			while ($result = $showdata->fetch_assoc()) {
			
		
		?>
		<a href="#">
			<div class="logo">
				<img src="admin/<?php echo $result['logo'];?>" alt="Logo"/>
				<h2><?php echo $result['title'];?></h2>
				<p><?php echo $result['slogan'];?></p>
			</div>
		</a>
		<?php
			}
		}
		?>
		<?php
		$query = "SELECT * FROM tbl_social where id = '1'";
		$datashow =$db->select($query);
		if ($datashow) {
			while ($result = $datashow->fetch_assoc()) {
		?>
		<div class="social clear">
			<div class="icon clear">
				<a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['tw'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['ln'];?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['gp'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
			<?php
	}
		}
			?>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>

<div class="navsection templete">
	<ul>
		<?php 
 		 $path = $_SERVER['SCRIPT_FILENAME'];
 		 $currentpage = basename($path,'.php');
		 ?>
		<li>
		

<a 
<?php if ($currentpage == 'index') { echo "id='active'";}?> href="index.php">Home</a></li>
			<?php
	$query = "SELECT *FROM  tbl_page";
	$showpage = $db->select($query);
	if ($showpage) {
		while ($result = $showpage->fetch_assoc()) {
			
	
	?>
		<li>
			<a 
			<?php
			if (isset($_GET['pageid']) && $_GET['pageid']== $result['id']) {
				echo "id='active'";
			}
			?>

			href="page.php?pageid=<?php echo $result['id'];?>"><?php echo $result['menu'];?></a></li>
		<?php
	}
	}
?>	
		<li><a <?php
if ($currentpage == 'contact') { echo "id='active'";}?> 

			href="contact.php">Contact</a></li>
	</ul>
</div>
