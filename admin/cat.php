<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php 
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location ='catlist.php';</script>";
    }
    else{
        $id=$_GET['catid'];
    }

?>



        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Update  Category</h2>
               <div class="block copyblock"> 
                <?php
                if(isset($_SERVER['REQUEST_METHOD'])=='POST'){
                $name = $_POST["name"];
                $name = mysqli_real_escape_string($db->link,$name);
             if(empty($name)){
                echo "<span class='success'> Filed must not be empty !!</span>";
            }
            else{
                $query ="UPDATE tbl_catagory 
                SET 
                name ='$name'
                WHERE id = '$id'";
                $update = $db->update($query);
                if ($update) {
                    echo "<span class='success'>Data Update Successfully !!</span>";
                }else{
                    echo "<span class='error'>Data Not Update !!</span>";
                }
            }
        
                
                ?>
                <?php
                $query = "SELECT *FROM tbl_catagory where id='$id' order by id desc";
                $catagory = $db->select($query);
                while($result = $catagory->fetch_assoc()){
                ?>
                 <form action="" method="post">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }?>
                <?php }?>
                </div>
            </div>
        </div>
<?php include "inc/footer.php";?>