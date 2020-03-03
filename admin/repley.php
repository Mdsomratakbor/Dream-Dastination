<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php 
  if(!isset($_GET['msgid']) || $_GET['msgid'] == NULL){
    echo "<script>window.location ='index.php'</srcipt>";
  }
  else{
    $id = $_GET['msgid'];
  }
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $to = $fm->validetion($_POST['toemail']);
   $from = $fm->validetion($_POST['fromemail']);
   $subject = $fm->validetion($_POST['subject']);
   $message = $fm->validetion($_POST['message']);
   $sendemail = mail($to, $subject, $message,$from);
   if ($sendemail) {
     echo "<span class='success'>Message sent successfully !!</span>";
   }
   else{
    echo "<span class='error'>Message not sent successfully !!</span>";
   }
}
?>
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Viwe Message</h2>
               
              
                <div class="block">               
                 <form action="" method="post" >
                    <?php
                    $query = "SELECT * FROM tbl_contact where id ='$id'";
                    $viwemsg = $db->select($query);
                    if ($viwemsg) {
                     while ($result = $viwemsg->fetch_assoc()) {
                      
                    
                    ?>
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>TO</label>
                            </td>
                            <td>
                                <input type="text" readonly name="toemail" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromemail" placeholder="please enter your email address" class="medium" />
                            </td>
                        </tr>
                       
                   
                    
                    
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="please enter your Subject" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea  name="message" class="tinymce">
                                    
                                </textarea>
                            </td>
                        </tr>
                   
                       
                        <tr>
                            <td></td>
                            <td>
                                
                                <input type="submit" name="submit" Value="OK" />
                    
                            </td>
                        </tr>
                    </table>
                    <?php
                     }
                    }
                    ?>
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
