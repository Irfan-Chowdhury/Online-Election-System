<?php 
	// include '../lib/Session.php' ;
	// Session::checkSession();	
?>
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
                <h2>Election List</h2>
<!-- Delete -->
<?php
	if (isset($_GET['delelectionId'])) {
		$delelectionId=$_GET['delelectionId'];
		$delquery="DELETE FROM tbl_election WHERE electionId='$delelectionId'";
		$delData=$db->delete($delquery);
		if ($delData) {
			echo "<span style='color:green'>Election Deleted Successfully</span>";
		}else {
			echo "<span style='color:red'>Election Not Deleted !</span>";
		}
	}
?>				
<!-- /Delete -->
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial</th>
							<th>Election Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
<?php
	$query="SELECT *FROM tbl_election";
	$post= $db->select($query);
	if ($post) {
		$i=0;
		while ($result=$post->fetch_assoc()) {
			$i++;	
?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['electionName']; ?></td>
							<td>
								<a onclick="return confirm('Are you sure to Delete !');" href="?delelectionId=<?php echo $result['electionId']; ?>">Delete</a>
							</td>
						</tr>
<?php } } ?>		
					</tbody>
				</table>
	
               </div>
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