	
<div class="slidersection templete clear">
        <div id="slider">
        	<?php 
        	$query = "SELECT * FROM tbl_slider order by id limit 5";
        	$slideshow = $db->select($query);
        	if ($slideshow) {
        		while ($result = $slideshow->fetch_assoc()) {
        	?>
            <a href="#"><img src="admin/<?php echo $result['image'] ?>" alt="<?php echo $result['title'] ?>" title="<?php echo $result['title'] ?>" /></a>
       <?php
       	}
        	}

       ?>
        </div>

</div>