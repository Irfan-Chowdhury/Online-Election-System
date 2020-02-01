<!-- ----------- Footer ---------------- -->
<?php include 'inc/header.php'; ?>
<!-- ________________ X ________________ -->

<style>
.custom{
    color: dimgray;
    margin-top: -20px;
}
</style>

<!-- ------------------- 1st For (wihtout login if he try to acces main page) -------------------- -->
<?php 
	$login = Session::get("userLogin");  //watch classes/Registration.php, method-2
	if ($login == false) {   
		header("Location:login.php");
	}
?>


<!--*********--------- Main Content **********---------->

<div class="container" style="margin-top:10%">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 PersonsDetails custom text-uppercase font-weight-bold">User Profile</div>
        <div class="col-sm-3"></div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
<!-- --------------  for Profile -----------------     -->
<?php
    // $voterId= Session::get("voterId");
    $voterId= Session::get("voterId");
    $userProfile= $reg->getUserProfile($voterId);  //Watch class/Registration.php, Method-8
    if ($userProfile) {
        while ($result = $userProfile->fetch_assoc()) {
?>   
        <div class="col col-sm-md-3">
            <img src="<?php echo $result['image']; ?>" width="250px" height="300px"  alt="">
        </div>
       
        <div class="col col-sm-9 ">        
            <h1 class="display-4 font-weight-bold text-uppercase text-dark"><?php echo $result['name']; ?></h1>
            <h4 font-weight-bold>Voter Id:<small><?php echo $result['voterId']; ?></small></h4>
            <h4 font-weight-bold>Age     :<small><?php echo $result['age']; ?></small></h4>
            <!-- <h4 font-weight-bold>Gender  :<small><?php //echo $result['gender']; ?></small></h4> -->
            <h4 font-weight-bold>Address :<small><?php echo $result['address']; ?></small></h4><br>
            <h4 font-weight-bold>Email   :<small> <?php echo $result['email']; ?></small></h4><br>
            <a class="btn btn-primary" href="editprofile.php?voterId=<?php echo Session::get("voterId"); ?>">Update Voter Info</a>
            <!-- Test -->
            <?php 
                $chk= $reg->getAllCanditate();
                if ($chk) {
                    while ($result= $chk->fetch_assoc()) {
                       if ($result['voterId']==Session::get("voterId")) { 
                ?>
                        
                        <a class="btn btn-success" href="editCandProfile.php?voterId=<?php echo $result['voterId']; ?>">Update Canditate info</a>

            <?php       }
                    }
                }
            ?>
            <!-- Test -->
        </div>
        <!-- <input type="submit"  name="submit" Value="Update"> -->
<?php } } ?>   
        
<!-- ___________________ X  ________________________ -->
    </div>
</div>
<br><br>


<script >
 
</script>
<!--*********--------- Script for serach  End **********---------->


<!-- ----------- Footer ---------------- -->
<?php include 'inc/footer.php' ?>; 
<!-- ________________ X ________________ -->



