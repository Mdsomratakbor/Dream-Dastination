﻿<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Post</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                $title          =    mysqli_real_escape_string($db->link,$_POST['title']);
                $cat           =    mysqli_real_escape_string($db->link,$_POST['cat']);
                $body           =    mysqli_real_escape_string($db->link,$_POST['fullbody']);
                $tags          =    mysqli_real_escape_string($db->link,$_POST['tags']);
                $author         =    mysqli_real_escape_string($db->link,$_POST['author']);
                $description    =    mysqli_real_escape_string($db->link,$_POST['description']);
                 $userid    =    mysqli_real_escape_string($db->link,$_POST['userid']);

                    $permited  = array('jpg', 'jpeg', 'png', 'gif','bmp');//This is the array image extention upload this image
                    $file_name = $_FILES['image']['name'];//image name upload
                    $file_size = $_FILES['image']['size'];//image size upload
                    $file_temp = $_FILES['image']['tmp_name'];//server image name or cooki

                    $div = explode('.', $file_name);//upload image in . extention 
                    $file_ext = strtolower(end($div));//small later upload image extention
                    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                    $uploaded_image = "upload/".$unique_image;//folder link imag upload
                    if ($title == " " || $cat == "" || $body == " "  || $author == " " || $file_name == "" || $description == "")
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
                        $query ="INSERT INTO dbl_post(cat,title,body,image,author,tags,description,userid) VALUES('$cat','$title','$body','$uploaded_image','$author','$tags','$description','$userid')";//data base data insert link
                        $insert_row = $db->insert($query);//database insert function link
                        if ($insert_row) {
                            echo "<span class='success'>Your Data Insert Successfully.</span>";
                        }
                        else{
                            echo "<span class='error'>Your Data Not Insert Successfully.</span>";
                        }

                     }




                }
                ?>
                <div class="block">               
                 <form action="addpost.php" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select Category</option>
                                    <?php
                                    $query = "SELECT * FROM tbl_catagory";//catagory show on data base query
                                    $catagory =$db->select($query);
                                    if($catagory){
                                        while($result=$catagory->fetch_assoc()){
                                    ?>
                                    <option value="<?php echo $result['id'];?>"><?php echo $result['name'];?></option>
                                    <?php
                                } 
                            }
                            ?>
                                </select>
                            </td>
                        </tr>
                   
                    
                    
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="fullbody"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" placeholder="Enter Post Tags..." class="medium" />
                            </td>
                        </tr>
                          <tr>
                            <td>
                                <label>Description</label>
                            </td>
                            <td>
                                <input type="text" name="description" placeholder="Enter Post description..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo session::get('username')  ?>" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo session::get('userId')  ?>" class="medium" />
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
