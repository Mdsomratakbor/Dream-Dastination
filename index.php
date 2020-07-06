<?php include 'inc/header.php';?>
<?php include "inc/slider.php";?>
 


	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<!--------PAGINETION CODE------>
			<?php
			$per_page = 12;
			if (isset($_GET['page'])) {
				$page = $_GET['page'];
			}
			else{
				$page =1;
			}
			$start_from = ($page-1)*$per_page;

			?>
			<!--------PAGINETION CODE-------->
			<?php
			$query = "SELECT * FROM dbl_post limit $start_from,$per_page";
			$post = $db->select($query);
			if ($post) {				
			while ($result = $post->fetch_assoc()) {
			?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h2>
				<h4><?php echo $fm->dateformate($result['date']);?> <a href="#"><?php echo $result['author'];?></a>
				</h4>
				<a href="post.php?id =<?php echo $result['id'];?>"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
			<?php echo $fm->textshort($result['body'],400);?>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
			</div>
		</div>
		<?php } ?><!--------END OF WHILE LOOP----->
		<!------PAGINATION START ----------->
		<?php
		$query = "SELECT * FROM dbl_post";
		$result= $db->select($query);
		$total_rows = mysqli_num_rows($result);
		$total_pages =ceil($total_rows/$per_page);



		echo "<span class='paginetion'> <a href='index.php?page=1'>".'First page '."</a>";
		for ($i=1; $i <=$total_pages; $i++) { 
			echo "<a href='index.php?page=".$i."'>".$i."</a>";
		}



		echo "<a href='index.php?page=$total_pages'>".'Last page'."</a></span>";
		?>

		<!------PAGINATION END----------->




		<?php } else { header("location:404.php");}?>
	</div>

		<?php
		include "inc/sidebar.php";
		?>
		<?php
		
		include "inc/footer.php";
		?>
	
