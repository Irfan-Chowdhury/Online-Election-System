<?php 
	// include '../lib/Session.php' ;
	// Session::checkSession();	
?>
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php include '../lib/config.php' ; ?>
<?php include '../lib/Database.php' ; ?>
<?php include '../helpers/Format.php' ; ?>

<?php 
	$db= new Database();
	$fm= new Format();
?>
<!-- ************************************************************************************ -->
    <?php
        if (!isset($_GET['edicanditateid']) || $_GET['edicanditateid']==NULL) {
            header("Location:Canditatets_list.php");
        }else {
            $edicanditateid=$_GET['edicanditateid'];
        }
    ?>       
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Canditate</h2>

                <?php
                    if ($_SERVER['REQUEST_METHOD']=='POST') {
                        $name   =mysqli_real_escape_string($db->link, $_POST['name']);
                        $gender =mysqli_real_escape_string($db->link, $_POST['gender']);
                        $age    =mysqli_real_escape_string($db->link, $_POST['age']);
                        $address=mysqli_real_escape_string($db->link, $_POST['address']);
                        $designation=mysqli_real_escape_string($db->link, $_POST['designation']);
                        $user_id=mysqli_real_escape_string($db->link, $_POST['user_id']);
                    
                        $permited=array('jpg','jpeg','png','gif');
                        $file_name=$_FILES['image']['name'];
                        $file_size=$_FILES['image']['size'];
                        $file_temp=$_FILES['image']['tmp_name'];

                        $div = explode('.',$file_name);
                        $file_ext= strtolower(end($div));
                        $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
                        $upload_image = "upload/".$unique_image;

                        
                        if ($name="" || $gender=="" || $age=="" || $address=="" || $designation=="" ||$user_id=="" ) {
                            echo "<span style='color:red'>Feild Must not be empty..</span>";
                        }else {
                            if (!empty($file_name)) {
                                if ($file_size > 1048567) {
                                    echo "<span style='color:red'>Image Size Should be less than 1MB </span>";
                                
                                }elseif (in_array($file_ext,$permited)===false) {
                                    echo "<span style='color:red'>You can upload only : ".implode(', ', $permited)." formate. </span>";
                                
                                }else {                   
                                    move_uploaded_file($file_temp,$upload_image);
        
                                    $query="UPDATE tbl_canditates 
                                            SET 
                                            image       ='$upload_image',
                                            name        ='$name',
                                            gender      ='$gender',
                                            age         ='$age',
                                            address     ='$address',
                                            designation ='$designation', 
                                            user_id     ='$user_id' 
                                            WHERE id    ='$edicanditateid' "; 
        
                                            $updated_row=$db->update($query);
                                            if($updated_row){
                                                echo "<span style='color:green'>Data Updated Successfuly.</span>";
                                            }else{
                                                echo "<span style='color:red'>Data Not Updated !</span>";
                                            }
                                    }
                                
                                }else {
                                    $query="UPDATE tbl_canditates 
                                            SET 
                                            name        ='$name',
                                            gender      ='$gender',
                                            age         ='$age',
                                            address     ='$address',
                                            designation ='$designation', 
                                            user_id     ='$user_id' 
                                            WHERE id    ='$edicanditateid' "; 
            
                                            $updated_row=$db->update($query);
                                            if($updated_row){
                                                echo "<span style='color:green'>Data Updated Successfuly.</span>";
                                            }else{
                                                echo "<span style='color:red'>Data Not Updated !</span>";
                                            }
                                    }
                            
                        }
                
                    }
                ?>


        <div class="block">  

<?php
    $query ="SELECT * FROM tbl_canditates WHERE id='$edicanditateid' ";
    $getcanditate= $db->select($query);
    while ($result=$getcanditate->fetch_assoc()) {
?>                     
            <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $result['image']; ?>" alt="" height="100px" width="200px"><br>
                        <input type="file" name="image" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $result['name']; ?>"  class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Gender</label>
                    </td>
                    <td>
                        <input <?php if($result['gender']=='Male'){echo "checked" ;}?> type="radio" name="gender" value="Male"/> Male
                        <input <?php if($result['gender']=='Female'){echo "checked" ;}?> type="radio" name="gender" value="Female"/> Female
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Age</label>
                    </td>
                    <td>
                        <input type="number" name="age" value="<?php echo $result['age']; ?>" class="medium" />
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <input type="text" name="address" value="<?php echo $result['address']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Designation</label>
                    </td>
                    <td>
                        <input type="text" name="designation" value="<?php echo $result['designation']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>User ID</label>
                    </td>
                    <td>
                        <input type="text" name="user_id" value="<?php echo $result['user_id']; ?>" class="medium" />
                    </td>
                </tr>

                <!-- <tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="select">
                            <option>Select Category</option>
                            <option value="1">Category One</option>
                            <option value="2">Category Two</option>
                            <option value="3">Cateogry Three</option>
                        </select>
                    </td>
                </tr> -->
            
            
                
                <!-- <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea class="tinymce"></textarea>
                    </td>
                </tr> -->

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
    <?php } ?>
        </div>
    </div>
</div>


<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
<!-- Load TinyMCE -->

 <?php include 'inc/footer.php'; ?>



