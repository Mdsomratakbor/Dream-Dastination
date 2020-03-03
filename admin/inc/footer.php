<div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <?php
    $query= "SELECT *FROM tbl_footer ";
    $copy = $db->select($query);
    if ($copy) {
    	while ($result = $copy->fetch_assoc()) {
    		
   
    ?>
    <div id="site_info">
        <p>
         &copy;<a href="http://trainingwithliveproject.com"><?php echo $result['note'];?></a>. All Rights Reserved.
        </p>
    </div>
    <?php
     	}
    }
    ?>
</body>
</html>
