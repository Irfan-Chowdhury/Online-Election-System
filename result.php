<!-- ----------- Header ---------------- -->
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
        <div class="col-sm-6 PersonsDetails custom font-weight-bold">Result of Vote</div>
    <div class="col-sm-3"></div>
</div>

<!-- ----------------- For Select Election Option ----------------- -->
<form class="form-inline" action="result.php" method="POST" enctype="multipart/form-data">
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
        <input class="btn btn-info ml-3"  type="submit" value="Show">  <!-- Go it into 55 line -->
 </form>
<!-- ___________________ X ______________________ -->

    <div class="table-responsive mt-3">
       <form action="">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Serial</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody id="myTable" class="table-secondary">
<?php
    if(isset($_POST['electionId'])) //from line--> 23
    {
        $electionId=$_POST['electionId'];

            //-------old Line ------->
                    $canditates= $reg->getAllCanditateByCandId($electionId);  //watch Registration.php, Method-7
                    if ($canditates) 
                    {
                //------- result status---->        
                        $getStatus = $vote->getStatus($electionId)->fetch_assoc();
                        if ($getStatus['status']=="enabled") 
                        {

                            $i=0;
                            while ($result=$canditates->fetch_assoc()) 
                            {
                                $i++;      
?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><img src="<?php echo $result['image']; ?>" alt="" height="50px" width="50px"></td>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['designation']; ?></td>
                    <td>
        <?php 
            $canditateId=$result['canditateId'];
            $electionId=$result['electionId'];

            $voteResult= $vote->getCanditateResult($canditateId,$electionId);
            if ($voteResult) {
                $count=mysqli_num_rows($voteResult);
                // while ($resultVote=$canditates->fetch_assoc()){    
        ?>                        
                        <div class="progress">
                            <!-- <div class="progress-bar progress-bar-striped  progress-bar-animated" style="width:<?php //echo $resultVote['votes'];?>%;"> <?php //echo $resultVote['votes'] ;?> </div> -->
                            <div class="progress-bar progress-bar-striped  progress-bar-animated" style="width:<?php echo $count+20;?>%;"> <?php echo $count ;?> </div>
                        </div>
        <?php }  ?>
                    </td>
                </tr>   

<?php   //-------------         
                }
            } else{ echo "<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button> <h3 class='text-danger'><strong>Sorry !</strong> Result Not Published Yet .</h3></div> ";}}
            else 
            {                
?>      <!---------------  -->           

                <div class="alert alert-danger alert-dismissible">
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <h3 class='text-danger'><strong>Sorry!</strong> Data Not Found.</h3>
                </div>
            
<?php   //-------------    
            }
      }
?>  <!---------------  -->

            </tbody>
        </table>
        </form>
    </div>
</div>

<br><br>

<!--*********--------- Main Content End **********---------->







<!--*********--------- Script for serach  **********---------->

<script >
 
</script>
<!--*********--------- Script for serach  End **********---------->


<!-- ----------- Footer ---------------- -->
<?php include 'inc/footer.php' ?>; 
<!-- ________________ X ________________ -->






<?php
// $canditates= $reg->getAllCanditate();  //watch classes/Registration.php  method-5
                                            // ------> $canditates= $reg->innerAllCanditate();  //watch classes/Registration.php  method-9
    // if ($canditates) {
    //     $i=0;
    //     while ($result=$canditates->fetch_assoc()) {
    //     $i++;
?>	