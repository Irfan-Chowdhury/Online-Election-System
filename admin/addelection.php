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
                <h2>Add New Election</h2>
               <div class="block copyblock">
<?php
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $electionName=$_POST['electionName'];
        $electionName=mysqli_real_escape_string($db->link, $electionName);
        if(empty($electionName)){
            echo "<span class='error'>Feild must not be empty !</span>";
        }else {
            $query ="INSERT INTO tbl_election (electionName) VALUES('$electionName') ";
            $catinsert = $db->insert($query);
            if($catinsert){
                echo "<span class='success'>Election Inserted Successfully..</span>";
            }else {
                echo "<span class='error'>Election Not Inserted..</span>";
            }
        }

    }
?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="electionName" placeholder="Enter Election Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php'; ?>