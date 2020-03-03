<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>
                <?php
                if (isset($_GET['deluser'])) {
                    $delid = $_GET['deluser'];
                    $query ="DELETE from tbl_user where id= '$delid'";
                    $deluser = $db->delete($query);
                    if ($deluser) {
                        echo "<span class='success'>User Profile Delete Successfully !!</span>";
                    }
                    else{
                        echo "<span class='error'>User Profile Not Delete Sucessfully !!</span>";
                    }
                }
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Name</th>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Details</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT *FROM tbl_user ORDER BY id DESC";
                        $userlist =$db->select($query);
                        if ($userlist) {
                            $i=0;
                            while($result=$userlist->fetch_assoc()){
                        $i++;
                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['name'];?></td>
                              <td><?php echo $result['username'];?></td>
                                <td><?php echo $result['email'];?></td>
                                  <td><?php echo $fm->textshort($result['details'],33);?></td>
                                    <td>
                                        <?php 
                                        if ($result['role'] == '1') {
                                            echo "Admin";
                                        }elseif ($result['role'] == '2') {
                                           echo "Author";
                                        }else{
                                            echo "Editor";
                                        }

                                        ?>
                                            
                                        </td>
                            <td><a href="Viweuser.php?viweid=<?php echo $result['id'];?>">Viweuser</a> 

                                <?php if (session::get('userRole')=='0') {
                                    
                                 ?>
                            || <a onclick="return confirm('Are you sure to delete this user!!')"     href="?deluser=<?php echo $result['id'];?>">Delete</a>
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

