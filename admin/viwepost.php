<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>

<?php
if (!isset($_GET['viweid']) || $_GET['viweid']==NULL) {
    echo "<script>window.location='postlist.php'</script>" ; 
}
else{
    $id = $_GET['viweid'];
}


?>


        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Viwe This Post</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                    echo "<script>window.location = 'postlist.php'</script>";
                }
                ?>
                <div class="block">  
                    <?php
                    $query = "SELECT * from dbl_post where id='$id' order by id desc";
                    $postedit =$db->select($query);
                    if ($postedit) {
                   while ($postresult = $postedit->fetch_assoc()) {
                    ?>

                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $postresult['title'];?>" class="medium" />
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
                                    <option 
                                    <?php 
                                    if ($postresult['cat']== $result['id']) {?>
                                        selected = "selected"
                                    

                                   <?php } ?>

                                    value="<?php echo $result['id'];?>"><?php echo $result['name'];?></option>
                                    <?php
                                } 
                            }
                            ?>
                                </select>
                            </td>
                        </tr>
                   
                    
                    
                        <tr>
                            <td>
                                <label>Image</label>
                            </td>
                            <td>
                                <img src="<?php echo $postresult['image'];?>" height="70px" width="70px"/>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="fullbody">
                                    <?php echo $postresult['body'] ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $postresult['tags'];?>" class="medium" />
                            </td>
                        </tr>
                          <tr>
                            <td>
                                <label>Description</label>
                            </td>
                            <td>
                                <input type="text" name="description" value="<?php echo $postresult['description']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value ="<?php echo session::get('username');?>" class="medium" />
                                <input type="text" name="userid" value ="<?php echo session::get('userId');?>" class="medium" />
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
