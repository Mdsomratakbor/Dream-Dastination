<?php
include "inc/header.php";
?>
<?php
	if (!isset($_GET['id']) || $_GET['id'] == NULL) {
		header("location:404.php");
	}
else{
	$id = $_GET['id'];

}


?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
				$query = "SELECT * FROM dbl_post WHERE id = $id";
				$post = $db->select($query);
				?>
				<?php
				if ($post) {
					while($result = $post->fetch_assoc()){
				?>
				<h2><?php echo $result['title']; ?></h2>
				<h4><?php echo $fm->dateformate($result['date']);?>,<a  href=""><?php echo $result['author']; ?></a></h4>
				<img src="admin/<?php echo $result['image'];?>" alt="MyImage"/>
				<?php echo $result['body'];?>

		
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php
					$catid =$result['cat'];
					$queryrelated = "SELECT * FROM dbl_post WHERE cat =$catid limit 6";
					$relatedpost = $db->select($queryrelated);
					if ($relatedpost) {
					while ($result =$relatedpost->fetch_assoc()) {
					?>

					
					<a href="post.php?id= <?php echo $result['id']; ?>">
						<img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
					
			
			<?php }}else{
				echo "No related post available here !!";
				}?>
	</div>
					<?php }
				} else{
			header("location:404.php");}?>
	</div>
</div>



		<?php
		include "inc/sidebar.php";
		include "inc/footer.php";
		?>