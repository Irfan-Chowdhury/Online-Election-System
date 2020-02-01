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
        <div class="col-sm-6 PersonsDetails custom text-uppercase font-weight-bold">Canditates Details</div>
    <div class="col-sm-3"></div>
</div>

<!-- ----------------- For Select Election Option ----------------- -->
<form class="form-inline" action="canditates.php" method="POST" enctype="multipart/form-data">
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
        <input class="btn btn-info ml-3"  type="submit" value="Show">  <!-- Go it into 67 line -->
 </form>
<!-- ___________________ X ______________________ -->     

    <div class="table-responsive mt-3">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Serial</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Country</th>
                    <th>Address</th>
                    <th>Designation</th>
                    <th>Commitment</th>
                </tr>
            </thead>

<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') 
    {
        $electionId=$_POST['electionId'];

        $query="SELECT *FROM tbl_canditate WHERE electionId='$electionId' ";
        $getCanditates= $db->select($query);
        if ($getCanditates) {
            $i=0;
            while ($result=$getCanditates->fetch_assoc()) {
                $i++;	
?>
            <tbody id="myTable" class="table-secondary">
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><img src="<?php echo $result['image']; ?>" alt="" height="50px" width="50px"></td>
                    <td><?php echo $result['name']; ?></td>
                    <td><?php echo $result['gender']; ?></td>
                    <td><?php echo $result['age']; ?></td>
                    <td><?php echo $result['country']; ?></td>
                    <td><?php echo $result['address']; ?></td>
                    <td><?php echo $result['designation']; ?></td>
                    <td><?php echo $result['commitment']; ?></td>
                </tr>
<!-- <?php //}}else{echo "<h1 style='color:red'>Data Not Found </h1>";}} ?>  -->                        
            </tbody>

<?php }}else{ ?> 
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h3 class='text-danger'><strong>Sorry!</strong> Data Not Found.</h3>
        </div>
<?php }} ?>     

        </table>
    </div>
     
</div>
<br><br>



<!--*********--------- Main Content End **********---------->


<!--*********--------- Script for serach  **********---------->

<script >
 $(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<!--*********--------- Script for serach  End **********---------->


<!-- ----------- Footer ---------------- -->
<?php include 'inc/footer.php' ?>; 
<!-- ________________ X ________________ -->


