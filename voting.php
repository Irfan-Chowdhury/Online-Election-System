<!-- ------------ Header  ------------------>
<?php include 'inc/header.php';  ?>
<!-- _______________ X __________________ -->

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
        <div class="col-sm-6 PersonsDetails custom text-uppercase font-weight-bold">Vote</div>
    <div class="col-sm-3"></div>
</div>

<!-- ----------------- For Select Election Option ----------------- -->
<form class="form-inline" action="voting.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <select class="form-control bg-success text-white" name="electionId">
                <option class="bg-light text-dark">--Select Election--</option>
<?php       
    $getElection=$reg->getAllElection();  // watch- Registration.php, Method-6
    if ($getElection) {
        while ($result =$getElection->fetch_assoc()){ 
?> 
                <option class="bg-light text-dark" value="<?php echo $result['electionId']; ?>"><?php echo $result['electionName']; ?></option> 
<?php } } ?> 
            </select>     
        </div>
        <input class="btn btn-info ml-3"  type="submit" value="Show">  <!-- এখানে ক্লিক করলে এটার রিকুয়েস্ট 70 লাইনে চলে যাবে -->
 </form>
<!-- ___________________ X ______________________ -->

<!-- ------------- For Catch The CanditateId------ -->
<?php
    if(isset($_GET['canditateId'])) //from line--> 92 
    {   
        $canditateId=$_GET['canditateId'];
        $userId = Session::get("userId");
        $insertVoting = $vote->insertVote($canditateId,$userId); //-------->> (watch class-Vote.php, method-1)   
    }
?>
<?php
	if (isset($insertVoting)) {  //show Message
		echo $insertVoting;
	}
?>
<!-- _____________________ X _____________________ -->

    <div class="table-responsive mt-3">
       <form action="" method="" enctype="multipart/form-data">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Serial</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Selecet a Canditate</th>
                </tr>
            </thead>
            <tbody id="myTable" class="table-secondary">
<?php
    if(isset($_POST['electionId'])) //from line--> 23
    {
        $electionId=$_POST['electionId'];

        $getCanditates= $reg->getAllCanditateByCandId($electionId);  //watch Registration.php, Method-7
        if ($getCanditates) 
        {
            $i=0;
            while ($result=$getCanditates->fetch_assoc()) 
            {
                $i++;	
?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><img src="<?php echo $result['image']; ?>" alt="" height="50px" width="50px"></td>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['designation']; ?></td>
<!--for line 47-->  <td>
<?php
               $userId = Session::get("userId");
               $oneTimeVote = $vote->getOnceVote($userId,$electionId ); //watch class/Vote.php, Method-3
               if ($oneTimeVote) { ?>
                        <a class="btn btn-danger" disabled>Vote Disabled</a></td>
<?php          }else{ ?>    
                        <a onclick="return confirm('You are selected <?php echo $result['name'];?> \nAre you sure to Vote ? ');" class="btn btn-success" href="?canditateId=<?php echo $result['canditateId'];?>">Vote</a></td>
<?php          } ?> 
                </tr>
                
<?php }}else{ ?> 
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h3 class='text-danger'><strong>Sorry!</strong> Data Not Found.</h3>
        </div>
<?php }} ?> 
            </tbody>
        </table>
        
        <!-- <button type="submit" class=" btn btn-primary">Submit</button> -->
        


        </form>
    </div>
</div>
<br><br>

<!--*********--------- Main Content End **********---------->







<!--*********--------- Script for serach  **********---------->

<script >
 $(document).ready(function(){
  $(".close").click(function(){
    $("#myAlert").alert("close");
  });
});
</script>
<!--*********--------- Script for serach  End **********---------->




<!-- ----------- Footer ---------------- -->
<?php include 'inc/footer.php' ?>; 
<!-- ________________ X ________________ -->