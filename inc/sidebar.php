<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Division Based Travel Space</h2>
					<ul>
						<?php
						$query = "SELECT * FROM tbl_catagory";
						$catagory =$db->select($query);
						if ($catagory) {
							while($result = $catagory->fetch_assoc()){


						?>
						<li><a href="posts.php?catagory= <?php echo $result['id'];?>"><?php echo $result['name']; ?></a></li>
							<?php
						}
					}else{
						echo "No catagory selected..";
					}
							?>			
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Recent Added Tourist Place</h2>
				<?php
				$query = "SELECT * FROM dbl_post order by id desc  limit 15";
				$post = $db->select($query);
				?>
				<?php
				if ($post) {
					while($result = $post->fetch_assoc()){
				?>
					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $result['id'];?>"><?php echo $result['title'];?></a></h3>
						<a href="post.php?id =<?php echo $result['id'];?>"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
						<?php echo $fm->textshort($result['body'], 200);?>
					</div>
					
					<?php }} else { header("location:404.php");}?>
			</div>
			
		</div>
		</div>