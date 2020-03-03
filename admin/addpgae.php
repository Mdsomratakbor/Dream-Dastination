<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New Pages</h2>
                <?php
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                     $name =    mysqli_real_escape_string($db->link,$_POST['name']);
                    $menu = mysqli_real_escape_string($db->link,$_POST['menu']);
                   
                    $body  =    mysqli_real_escape_string($db->link,$_POST['fullbody']);


               
                    if ($name == "" || $body == "")
                    //validetion the from
                     {
                         echo "<span class='error'>Filed Must Not Be Empty !!</span>";
                     } 
                  
                     else{
                       
                        $query ="INSERT INTO tbl_page(name,menu,body) VALUES('$name','$menu','$body')";//data base data insert link
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
                 <form action="" method="post" >
                    <table class="form">
                        <tr>
                            <td>
                                <label>Menubar</label>
                            </td>
                            <td>
                                <input type="text" name="menu" placeholder="Enter Post menu..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
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
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
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
