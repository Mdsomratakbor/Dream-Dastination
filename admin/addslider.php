<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php
if (!session::get('userRole')=='0') {
   echo "<script>window.location='index.php';</script>";
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Slider</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                $title          =    mysqli_real_escape_string($db->link,$_POST['title']);

                    $permited  = array('jpg', 'jpeg', 'png', 'gif','bmp');//This is the array image extention upload this image
                    $file_name = $_FILES['image']['name'];//image name upload
                    $file_size = $_FILES['image']['size'];//image size upload
                    $file_temp = $_FILES['image']['tmp_name'];//server image name or cooki

                    $div = explode('.', $file_name);//upload image in . extention 
                    $file_ext = strtolower(end($div));//small later upload image extention
                    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                    $uploaded_image = "upload/slider/".$unique_image;//folder link imag upload
                    if ($title == " " || $file_name == "" )
                    //validetion the from
                     {
                         echo "<span class='error'>Filed Must Not Be Empty !!</span>";
                     } 
                     elseif ($file_size > 1048567) {
                         echo "<span class='error'>Image size should be less then 1MB !</span>";
                     }
                     elseif (in_array($file_ext, $permited) === false) {
                         echo "<span class='error'>You should only upload :".implode(',', $permited)."</span>";
                     }
                     else{
                        move_uploaded_file($file_temp, $uploaded_image);//upload data base link
                        $query ="INSERT INTO tbl_slider(title,image) VALUES('$title','$uploaded_image')";//data base data insert link
                        $insert_row = $db->insert($query);//database insert function link
                        if ($insert_row) {
                            echo "<span class='success'>Slider image Insert Successfully.</span>";
                        }
                        else{
                            echo "<span class='error'>Slider image Not Insert Successfully.</span>";
                        }

                     }




                }
                ?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Slider Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload SliderImage</label>
                            </td>
                            <td>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
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
