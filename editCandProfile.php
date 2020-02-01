<!-- ----------- Header ---------------- -->
<?php include 'inc/header.php'; ?>
<!-- ________________ X ________________ -->
<br><br><br><br>

<?php 
	// $login = Session::get("userLogin");  //watch classes/Registration.php, method-2
	// if ($login == false) {   
	// 	header("Location:login.php");
	// }
?>
<!-- ------------------------ 1st for User Registration ------------------- -->


<?php

    if (isset($_GET['voterId'])) {
        $voterId=$_GET['voterId'];
    }


    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) 
    {
        $updatetCand  = $reg->candUpdate($_POST, $_FILES, $voterId); //--> watch class/Registration.php, method-13
	}
?>
    <div class="container pl-5">   
        <h3>Canditate Profile Update</h3>
<?php
	if (isset($updatetCand)) {  //show Message
		echo $updatetCand;
	}
?>


<?php
    //$voterId= Session::get("voterId");
    $getCanProfile=$reg->getCandProfile($voterId); //Watch class/Registration.php, Method-12
    if ($getCanProfile) {
        while ($result= $getCanProfile->fetch_assoc()) {
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">          
    <table>
        <tbody>
            <tr>
                <td>Image</td>
                <img src="<?php echo $result['image'];?>" alt="" height="250px" width="250px">
                <td><input class="form-control" type="file" name="image"></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input class="form-control" type="text" name="name" value="<?php echo $result['name'];?>" ></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>
                    <input <?php if ($result['gender']=='Male'){echo "checked" ;} ?> type="radio" name="gender" value="Male">Male
                    <input <?php if ($result['gender']=='Female'){echo "checked" ;} ?> type="radio" name="gender" value="Female">Female
                </td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input class="form-control" type="number" name="age" value="<?php echo $result['age'];?>" ></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input class="form-control" type="text" name="address" value="<?php echo $result['address'];?>" ></td>
            </tr>
            <!-- <tr>
                <td>Password</td>
                <td><input class="form-control" type="text" name="password" value="<?php //echo $result['password'];?>" ></td>
            </tr> -->
            <tr>
                <td></td>
                <td><input class="btn btn-primary" type="submit" name="submit" value="Update"></td>
            </tr>
        </tbody>
    </table>
    </div>    
</form> 
<?php } } ?>
</div>
<br><br><br>


<!-- ____________________________________ X ______________________________________ -->


<!-- ----------- Footer ---------------- -->
<?php include 'inc/footer.php'; ?>
<!-- ________________ X ________________ -->