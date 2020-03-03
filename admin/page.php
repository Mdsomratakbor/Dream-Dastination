<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
        echo "<script>window.lacation = 'index.php';</script>";
    }
    else{
        $id = $_GET['pageid'];
    }
?>
<style>
    .deleteid{
    border: 1px solid #ddd;
color: #444;
cursor: pointer;
font-size: 20px;
padding: 2px 10px;    }
.deleteid a{
    font-weight: normal;
    background-color: #f0f0f0 none repeat scroll 0 0;

}
</style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Pages</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                    $name =    mysqli_real_escape_string($db->link,$_POST['name']);
                    $body  =    mysqli_real_escape_string($db->link,$_POST['fullbody']);

               
                    if ($name == "" || $body == "")
                    //validetion the from
                     {
                         echo "<span class='error'>Filed Must Not Be Empty !!</span>";
                     } 
                  
                     else{
                       
                        $query ="UPDATE tbl_page
                        SET
                        name = '$name',
                        body = '$body'
                        WHERE  id ='$id'";//database data update link
                        $insert_row = $db->insert($query);//database insert function link
                        if ($insert_row) {
                            echo "<span class='success'>Your Data Update Successfully.</span>";
                        }
                        else{
                            echo "<span class='error'>Your Data Not Update Successfully.</span>";
                        }

                     }




                }
                ?>
                <div class="block"> 
                <?php
                $query = "SELECT * FROM tbl_page WHERE id='$id'";
                $pagedata = $db->select($query);
                if ($pagedata) {
                    while ($result = $pagedata->fetch_assoc()) {
             


                ?>              
                 <form action="" method="post" >
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>
                     
                    
                   
                    
                    
                    
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="fullbody"><?php echo $result['body'] ?></textarea>
                            </td>
                        </tr>
                  
                     
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="deleteid">

                                    <?php
                                    if (session::get('userRole')=='0') {
                                     ?>
                                <a onclick="return confirm('Are you sure delte this page !')" href="delete.php?delid=<?php echo $result['id'];?>">
                                   Delete
                                </a>
                                <?php
                            }
                            ?>
                            </span>
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
