<?php
include"inc/header.php";
?>
<?php 
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
	echo "<script>window.loaction = '404.php'<script>";
}
else {
	$id = $_GET['pageid'];
}
?>
<?php
$query = "SELECT * FROM tbl_page WHERE id='$id'";
$pagedata = $db->select($query);
if ($pagedata) {
	while ($result = $pagedata->fetch_assoc()) {
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $result['name']; ?></h2>
				<?php echo $result['body'];?>	
	</div>

		</div>
		<?php
	}
}
else{
	echo "<script>window.location = '404.php'</script>";
}
		?>
	<?php include "inc/sidebar.php";?>
	<?php include "inc/footer.php";?>