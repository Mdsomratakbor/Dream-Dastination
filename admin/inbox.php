<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                if (isset($_GET['seenid'])) {
                	$seenid = $_GET['seenid'];
                	$query = "UPDATE tbl_contact
                	SET 
                	status = '1'
                	where id = '$seenid'";
                	$seen_row = $db->update($query);
                	if ($seen_row) {
                		echo "<span class='success'>Message sent to seen box successfully !!</span>";
                	}
                	else{

                		echo "<span class='error'>Message not sent to seen box successfully !!</span>";
                	}
                }
                ?>
                <div class="block"> 
                    
                    <table class="data display datatable" id="example">
            
					<thead>
						<tr>
							<th width="10%">Serial No.</th>
							<th width="15%">Name</th>
							<th width="15%">Email</th>
							<th width="20%">Message</th>
							<th width="20%">Date</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					        	  <?php
                $query = "SELECT * FROM  tbl_contact where status='0' order by id desc";
                $getmessage = $db->select($query);
                if ($getmessage) {
                	$i = 0;
                while ($result = $getmessage->fetch_assoc()) {
                	
            		$i++;
                ?> 
					<tbody>
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $result['fname'].''.$result['lname'];?></td>
							<th><?php echo $result['email'];?></th>
							<th><?php echo $fm->textshort($result['body'],30);?></th>
							<th><?php echo $fm->dateformate($result['date']);?></th>
							<td>
                                <a href="viwe.php?msgid=<?php echo $result['id'];?>">Viwe</a>
                                <?php 
                                if (session::get('userRole')=='0' || session::get('userRole')=='1') {
                                ?>

                                 ||

                                  <a href="repley.php?msgid=<?php echo $result['id'];?>">Repley</a> 
                                  <?php
                              }
                                  ?>

                                  ||

                                   <a onclick="return confirm('Are you sure to sent the message in seen box')" href="?seenid=<?php echo $result['id'];?>">Seen</a></td>
						</tr>
						
					</tbody>
					<?php
				    }
                }
				?>
				</table>
				
               </div>
            </div>
        </div>


       <div class="grid_10">
            <div class="box round first grid">
                <h2>Seen Message</h2>
                <?php 
 	 			if(isset($_GET['deleteid'])){
 	 				$delid = $_GET['deleteid'];
 	 				$query = "DELETE FROM tbl_contact where id = '$delid'";
 	 				$deletemsg = $db->delete($query);
 	 				if ($deletemsg) {
 	 					echo "<span class='success'>Messge delete successfully !!</span>";
 	 				}
 	 				else{
 	 					echo "<span class='error'>Message  not delete  successfully !!</span>";
 	 				}


 	 			}



                ?>
                <div class="block"> 
                    
                    <table class="data display datatable" id="example">
            
					<thead>
						<tr>
							<th width="10%">Serial No.</th>
							<th width="15%">Name</th>
							<th width="15%">Email</th>
							<th width="20%">Message</th>
							<th width="20%">Date</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
			<?php
                $query = "SELECT * FROM  tbl_contact where status='1' order by id desc";
                $getmessage = $db->select($query);
                if ($getmessage) {
                	$i = 0;
                while ($result = $getmessage->fetch_assoc()) {
                	
            		$i++;
                ?> 
					<tbody>
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $result['fname'].''.$result['lname'];?></td>
							<th><?php echo $result['email'];?></th>
							<th><?php echo $fm->textshort($result['body'],30);?></th>
							<th><?php echo $fm->dateformate($result['date']);?></th>
							<td>
                                <?php
                                if (session::get('userRole')=='0') {
                                    ?>

                                <a onclick="return confirm('Are you sure to delete this message')" href="?deleteid=<?php echo $result['id'];?>">Delete</a>
                                <?php
                            }
                                ?>
                                 </td>
						</tr>
						
					</tbody>
					<?php
				    }
                }
				?>
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