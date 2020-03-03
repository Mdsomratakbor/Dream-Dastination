<?php
include "../lib/session.php";
 session :: checksession();
?>

<?php include "../config/config.php";?>
<?php include "../lib/Database.php";?>

<?php 
    $db = new Database();
?>
<?php
if (!isset($_GET['delid']) || $_GET['delid']==NULL) {
	echo "<script>window.location='index.php'</script>";
}
else{
	$id = $_GET['delid'];

	$query ="DELETE from tbl_page where id ='$id'";
	$deldata = $db->delete($query);
	if ($deldata) {
		echo "<script>alert('Data delete successfully !!')</script>";
		echo "<script>window.location ='index.php'</script>";
	}
	else{
	echo "<script>alert('Data  not delete successfully !!')</script>";
		echo "<script>window.location ='index.php'</script>";
	}


}

?>