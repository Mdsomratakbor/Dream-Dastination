<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
		
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="15%">Post Title</th>
							<th width="20%">Description</th>
							<th width="10%">Category</th>
							<th width="10%">Image</th>
							<th width="10%">Author</th>
							<th width="10%">Tags</th>
							<th width="10%">Date</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
				
					<tbody>
							<?php
						$query = "SELECT dbl_post.*, tbl_catagory.name from dbl_post
						INNER JOIN tbl_catagory
						on dbl_post.cat = tbl_catagory.id
						order by dbl_post .title desc";
						$post = $db->select($query);
						if ($post) {
							$i=0;
							while ($result = $post->fetch_assoc()) {
								$i++;
						
						?>
				
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['title'];?><a href="editpost.php?editid=<?php echo $result['id']?>"></a></td>
							<td><?php echo $fm->textshort($result['body'], 50);?></td>
							<td class="center"> <?php echo $result['name'];?></td>
							<td><img src="<?php echo $result['image'];?>" height="30px" width="30px"/></td>
							<td><?php echo $result['author'];?></td>
							<td><?php echo $result['tags'];?></td>
							<td><?php echo $fm->dateformate($result['date']);?></td>
							
							<td>
									<a href="viwepost.php?viweid=<?php echo $result['id']?>">Viwe</a> 
									<?php

									if (session::get('userId') == $result['userid'] || session::get(
										'userRole') == '0') {
										?>
									

										||<a href="editpost.php?editid=<?php echo $result['id']?>">Edit</a> 
								|| 
								<a onclick="return confirm('Are you sure to delete this post!!')"
								href="deletepost.php?deleteid=<?php echo $result['id']?>">Delete</a>

								<?php
							}
								?>
									



								</td>
						</tr>
						<?php
						}
						}
						?>
					
					</tbody>
					
				</table>
	
               </div>
            </div>
             </div>
   <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>
 <?php include "inc/footer.php";?>

