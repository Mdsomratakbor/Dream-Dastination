<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Update Them</h2>
               <div class="block copyblock"> 
                <?php
                if(isset($_POST['them'])){
                $them = mysqli_real_escape_string($db->link,$_POST["them"]);
                $query ="UPDATE tbl_them
                SET 
                them ='$them'
                WHERE id = '1'";
                $update = $db->update($query);
                if ($update) {
                    echo "<span class='success'>Theme  Update Successfully !!</span>";
                }else{
                    echo "<span class='error'>Theme Not Update !!</span>";
                }
            }
                
                ?>
                <?php
                
                $query = "SELECT *FROM tbl_them where id='1'";
                $them = $db->select($query);
                if($them){
                while($result = $them->fetch_assoc()){
                ?>
                 <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input <?php if ($result['them'] == "default") {
                                    echo "checked";
                                }
                                 ?>
                                type="radio" name="them" value="default" />default
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input <?php if ($result['them'] == "green") {
                                    echo "checked";
                                }
                                 ?>
                                type="radio" name="them" value="green" />Green
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <input 
                                <?php 
                                if ($result['them'] == "red") {
                                 echo "checked";
                                }
                                ?>
                                type="radio" name="them" value="red" />Red
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Change"/>
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }
                }
                ?>
                
                </div>
            </div>
        </div>
<?php include "inc/footer.php";?>