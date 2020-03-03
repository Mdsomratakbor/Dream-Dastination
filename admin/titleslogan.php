<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
       

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Site Title and Description</h2>
                <div class="block sloginblock"> 
<?php
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                    $title = $fm->validetion($_POST['title']);
                    $slogan = $fm->validetion($_POST['slogan']);

                    $title       =    mysqli_real_escape_string($db->link,$title);
                    $slogan      =    mysqli_real_escape_string($db->link,$slogan);
                  
                    $permited    =      array('png');//This is the array image extention upload this image
                    $file_name = $_FILES['logo']['name'];//image name upload
                    $file_size = $_FILES['logo']['size'];//image size upload
                    $file_temp = $_FILES['logo']['tmp_name'];//server image name or cooki

                    $div = explode('.', $file_name);//upload image in . extention 
                    $file_ext = strtolower(end($div));//small later upload image extention
                    $unique_image = 'logo'.$file_ext;
                    $uploaded_image = "upload/".$unique_image;//folder link imag upload
                    if ($title == " " || $slogan == "")
                    //validetion the from
                     {
                         echo "<span class='error'>Filed Must Not Be Empty !!</span>";
                     } 


                     if(!empty($file_name)){

                     if ($file_size > 1048567) {
                         echo "<span class='error'>Image size should be less then 1MB !</span>";
                     }
                     elseif (in_array($file_ext, $permited) === false) {
                         echo "<span class='error'>You should only upload :".implode(',', $permited)."</span>";
                     }
                 
                     else
                     {
                        move_uploaded_file($file_temp, $uploaded_image);//upload data base link
                      
                        $query ="UPDATE title_slogan
                        SET 
                         title ='$title',
                         slogan='$slogan',
                         logo = '$uploaded_image'
                         where id='1'";//data base data insert link
                        $update_row = $db->update($query);//database insert function link
                        if ($update_row) {
                            echo "<span class='success'>Your Data Update Successfully.</span>";
                        }
                        else{
                            echo "<span class='error'>Your Data Not Update Successfully.</span>";
                        }
                         }
                         }
                 else{
                     $query ="UPDATE title_slogan
                        SET 
                         title ='$title',
                         slogan='$slogan'
                        where id='1'";//data base data insert link
                        $update_row = $db->update($query);//database insert function link
                        if ($update_row) {
                            echo "<span class='success'>Your Data Update Successfully.</span>";
                        }
                        else{
                            echo "<span class='error'>Your Data Not Update Successfully.</span>";
                 }
                 }
                }
                ?>
                <?php
$query = "SELECT * FROM title_slogan where id='1'";
$data_slogan = $db->select($query);
if ($data_slogan) {
  while ($result=$data_slogan->fetch_assoc()) {
?>
                <div class="leftsite">              
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Website Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['title'];?>"  name="title" class="medium" />
                            </td>
                        </tr>
						 <tr>
                            <td>
                                <label>Website Slogan</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $result['slogan'];?>" name="slogan" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload logo</label>
                            </td>
                            <td>
                                <input type="file" name="logo" >
                            </td>
                        </tr>
						 
						
						 <tr>
                            <td>
                            </td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <div class="rightsite">
                    <img src="<?php echo $result['logo'];?>"  alt="logo" height="200px" width="200px">
                </div>
                </div>
            </div>
            <?php
             }
            }   
            ?>
        </div>
<?php include "inc/footer.php";?>
