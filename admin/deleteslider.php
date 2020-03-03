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
if (!isset($_GET['sliderid']) || $_GET['sliderid']==NULL) {
	echo "<script>window.location='sliderlist.php'</script>";
}
else{
	$id = $_GET['sliderid'];
	$query= "SELECT *from tbl_slider where id='$id'";
	$getslider = $db->select($query);
	if($getslider){
	while($sliderimg=$getslider->fetch_assoc()) {
		$dellink = $sliderimg['image'];
		unlink($dellink);
	}
}
	$query ="DELETE from tbl_slider where id ='$id'";
	$delsliderimage = $db->delete($query);
	if ($delsliderimage) {
		echo "<script>alert('Delete Slider Image Successfully !!')</script>";
		echo "<script>window.location ='sliderlist.php'</script>";
	}
	else{
	echo "<script>alert('Delete Slider Image Not Successfully !!')</script>";
		echo "<script>window.location ='sliderlist.php'</script>";
	}


}

?>