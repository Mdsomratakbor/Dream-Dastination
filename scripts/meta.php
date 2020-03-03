<?php
	if (isset($_GET['pageid'])) {
		$showpageid = $_GET['pageid'];
		$query = "SELECT * FROM tbl_page where id = '$showpageid'";
		$pagesid = $db->select($query);
		if ($pagesid) {
			while ($result = $pagesid->fetch_assoc()) {

				?>
				<title><?php  echo $result['menu'];?>##<?php echo TITLE; ?></title>
			<?php
						
					}
				}
			}elseif (isset($_GET['id'])) {
			 $postid = $_GET['id'];
			 $query = "SELECT * FROM dbl_post where id = '$postid' ";
			 $showpostid = $db->select($query);
			 if ($showpostid) {
			 	while ($result = $showpostid->fetch_assoc()) {
			 		?>
			 		<title><?php  echo $result['title'];?>##<?php echo TITLE; ?></title>
			 		<?php
			 		
			 	}
			 }
			}
			else{
				?>
					<title><?php echo $fm->title(); ?>##<?php echo TITLE; ?></title>
		<?php

			}

			?>




	
	<meta name="language" content="English">
	
	<?php
	if (isset($_GET['id'])) {
		$keywordsid = $_GET['id'];
		$query ="SELECT * FROM dbl_post where id = '$keywordsid'";
		$showtags = $db->select($query);
		if ($showtags) {
			while ($result = $showtags->fetch_assoc()) {
			?>
			<meta name="description" content="<?php echo $result['description'];?>">
			<meta name="keywords" content="<?php echo $result['tags']; ?>">
			<?php
			}
		}
	}else{
			?>
			<meta name="description" content="<?php echo DESCRIPTION;?>">
			<meta name="keywords" content="<?php echo KEYWORDS;?>">

			<?php
		}
	
	?>


	
	<meta name="author" content="Md Somrat Akbor">