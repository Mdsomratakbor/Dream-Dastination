﻿<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Copyright Text</h2>
                <div class="block copyblock"> 
                    <?php
                    $query = "SELECT * FROM tbl_footer";
                    $copyright = $db->select($query);
                    if ($copyright) {
                    while ($result = $copyright->fetch_assoc()) {
                


                    ?>
                    <?php
                    if ($_SERVER['REQUEST_METHOD']=='POST') {
                        $note = $fm->validetion($_POST['note']);
                        $note = mysqli_real_escape_string($db->link,$note);
                        if ($note == "") {
                            echo "<span class='scuccess'>Field Must Not Be Empty !!</span>";
                        }
                        else{
                            $query = "UPDATE tbl_footer
                            SET 
                            note = '$note'
                            where id='1' ";
                            $update_row = $db->update($query);
                            if ($update_row) {
                                echo "<span class='success'>Data Update Successfully !!</span>";
                            }
                            else{
                                echo "<span class='error'>Data Update Not Successfully !!</span>";
                            }
                        }
                    }

                    ?>


                 <form action="copyright.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="note" value="<?php echo $result['note'];?>" class="large" />
                            </td>
                        </tr>
						
						 <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
       <?php include "inc/footer.php";?>