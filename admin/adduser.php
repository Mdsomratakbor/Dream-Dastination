<?php include "inc/header.php";?>
<?php include "inc/sidebar.php";?>
<?php
 if (! session::get("userRole") == "0") {
  echo "<script>window.location= 'index.php';</script>";
 }

?>


        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock"> 
                <?php
                if(isset($_POST["submit"])){
                $username = $fm->validetion($_POST["username"]);
                $password = $fm->validetion(md5($_POST["password"]));
                $role     = $fm->validetion($_POST["role"]);
                $email     = $fm->validetion($_POST["email"]);
              
                $username= mysqli_real_escape_string($db->link,$username);
                $password= mysqli_real_escape_string($db->link,$password);
                $role= mysqli_real_escape_string($db->link,$role);
                $email= mysqli_real_escape_string($db->link,$email);
                if($username == "" || $password == "" || $role == "" || $email == ""){
                echo "<span class='error'> Filed must not be empty !!</span>";
            }

else{
           $mailquery = "SELECT * FROM tbl_user where email='$email' limit 1";
           $selectmail = $db->select($mailquery);
            if ($selectmail != false) {
                echo "<span class='error'>Your email is already exists !</span>";
            }


            else{
                $query ="INSERT INTO tbl_user(username, password, role,email) VALUES('$username', '$password', '$role','$email')";
                $catagoryinsert = $db->insert($query);
                if ($catagoryinsert) {
                    echo "<span class='success'>User Create Successfully !!</span>";
                }else{
                    echo "<span class='error'>User Not Create !!</span>";
                }
            }
        }
    }
                
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" placeholder="Enter User Name..." class="medium" />
                            </td>
                        </tr>
                             <tr>
                            <td>
                                <label>Password</label>
                            </td>
                            <td>
                                <input type="text" name="password" placeholder="Enter User Password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" placeholder="Enter Valid Email Address..." class="medium" />
                            </td>
                        </tr>
                              <tr>
                            <td>
                                <label>Role</label>
                            </td>
                            <td>
                                <select id="select" name="role">
                                    <option>Select User Role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="3">Editor</option>

                                </select>
                            </td>
                        </tr>



						<tr> 
                            <td> </td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include "inc/footer.php";?>