<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>

<?php
if (!isset($_GET['sliderid']) || $_GET['sliderid']==NULL) {
    echo "<script>window.location='sliderlist.php'</script>" ; 
}
else{
    $id = $_GET['sliderid'];
}


?>


        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Slider Image</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                    $title =    mysqli_real_escape_string($db->link,$_POST['title']);
                    $permited  = array('jpg', 'jpeg', 'png', 'gif','bmp');//This is the array image extention upload this image
                    $file_name = $_FILES['image']['name'];//image name upload
                    $file_size = $_FILES['image']['size'];//image size upload
                    $file_temp = $_FILES['image']['tmp_name'];//server image name or cooki

                    $div = explode('.', $file_name);//upload image in . extention 
                    $file_ext = strtolower(end($div));//small later upload image extention
                    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                    $uploaded_image = "upload/slider/".$unique_image;//folder link imag upload
                    if ($title == " ")
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
                 
                     else{
                        move_uploaded_file($file_temp, $uploaded_image);//upload data base link
                      
                        $query ="UPDATE tbl_slider
                        SET 
                        
                        title ='$title',
                        image ='$uploaded_image'
                        where id='$id'";//data base data insert link
                        $update_row = $db->update($query);//database insert function link
                        if ($update_row) {
                            echo "<span class='success'>Your SliderImage Update Successfully.</span>";
                        }
                        else{
                            echo "<span class='error'>Your SliderImage Not Update Successfully.</span>";
                        }

                     }
                 }else{
                     $query ="UPDATE tbl_slider
                        SET 
                        
                        title ='$title',
                        where id='$id'";//data base data insert link
                        $update_row = $db->update($query);//database insert function link
                        if ($update_row) {
                            echo "<span class='success'>Your Title Update Successfully.</span>";
                        }
                        else{
                            echo "<span class='error'>Your Title Not Update Successfully.</span>";
                        }



                 }




                }
                ?>
                <div class="block">  
                    <?php
                    $query = "SELECT * from tbl_slider where id='$id'";
                    $slideredit =$db->select($query);
                    if ($slideredit) {
                   while ($sliderresult = $slideredit->fetch_assoc()) {
                    ?>

                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $sliderresult['title'];?>" class="medium" />
                            </td>
                        </tr>
                             <tr>
                            <td>
                                <label>Update SliderImage</label>
                            </td>
                            <td>
                                <img src="<?php echo $sliderresult['image'];?>" height="100px" width="100px"/>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        <tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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
        <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
     <?php include "inc/footer.php";?>
