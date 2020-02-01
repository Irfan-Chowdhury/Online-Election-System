
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php //include '../config/config.php' ; ?>  
<?php //include '../lib/Database.php' ; ?>
<?php //include '../helpers/Format.php' ; ?>

<?php 
	$db= new Database();
?>
<!-- ************************************************************************************ -->
        <div class="grid_10">
            <div class="box round first grid">
				<h2>Voter List</h2>
<!-- Delete -->
<?php
	if (isset($_GET['deluserId'])) {
		$deluserId=$_GET['deluserId'];
		$delquery="DELETE FROM tbl_user WHERE userId='$deluserId'";
		$delData=$db->delete($delquery);
		if ($delData) {
			echo "<span style='color:green'>Voter Deleted Successfully</span>";
		}else {
			echo "<span style='color:red'>Voter Not Deleted !</span>";
		}
	}
?>				
<!-- /Delete -->				
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial</th>
							<th>Name</th>
							<th>Gender</th>
							<th>Age</th>
							<th>Address</th>
							<th>Voter Id</th>
							<th>User Id</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php
	$query="SELECT *FROM tbl_user ORDER BY userId";
	$post= $db->select($query);
	if ($post) {
		$i=0;
		while ($result=$post->fetch_assoc()) {
			$i++;	
?>
				<tr class="odd gradeX">	
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><?php echo $result['gender']; ?></td>
					<td><?php echo $result['age']; ?></td>
					<td><?php echo $result['address']; ?></td>
					<td><?php echo $result['voterId']; ?></td>
					<td><?php echo $result['userId']; ?></td>
					<td>
						<a onclick="return confirm('Are you sure to Delete !');" href="?deluserId=<?php echo $result['userId']; ?>">Delete</a>
					</td>
				</tr>	
<?php } } ?>						
					</tbody>
				</table>
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>


<?php include 'inc/footer.php'; ?>


