﻿<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                <?php
                if(isset($_POST["submit"])){
                $name = $_POST["name"];
                $name = mysqli_real_escape_string($db->link,$name);
                if($name == ""){
                echo "<span class='error'> Filed must not be empty !!</span>";
            }
            else{
                $query ="INSERT INTO tbl_catagory(name) VALUES('$name')";
                $catagoryinsert = $db->insert($query);
                if ($catagoryinsert) {
                    echo "<span class='success'>Data Insert Successfully !!</span>";
                }else{
                    echo "<span class='error'>Data Not Insert !!</span>";
                }
            }
        }
                
                ?>
                 <form action="addcat.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include "inc/footer.php";?>