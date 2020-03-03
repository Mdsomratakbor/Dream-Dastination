<?php
include "../lib/session.php";
 session :: checksession();
?>
<?php include "../helpers/Formate.php";?>
<?php include "../config/config.php";?>
<?php include "../lib/Database.php";?>

<?php 
    $db = new Database();
?>
<?php
if (!isset($_GET['deleteid']) || $_GET['deleteid']==NULL) {
	echo "<script>window.location='postlist.php'</script>";
}
else{
	$id = $_GET['deleteid'];
	$query= "SELECT *from dbl_post where id='$id'";
	$getdata = $db->select($query);
	if($getdata){
	while($delimg=$getdata->fetch_assoc()) {
		$dellink = $delimg['image'];
		unlink($dellink);
	}
}
	$query ="DELETE from dbl_post where id ='$id'";
	$deldata = $db->delete($query);
	if ($deldata) {
		echo "<script>alert('Data delete successfully !!')</script>";
		echo "<script>window.location ='postlist.php'</script>";
	}
	else{
	echo "<script>alert('Data  not delete successfully !!')</script>";
		echo "<script>window.location ='postlist.php'</script>";
	}


}

?>