<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php 
    //include '../classes/Registration.php'; 
    spl_autoload_register(function($class){
        include_once "../classes/".$class.".php";
    });
?>


<?php
    $vote = new Vote(); 

    if ($_SERVER['REQUEST_METHOD']=='POST') {
       $electionId = $_POST['electionId'];
       $status     = $_POST['status'];
       
       $electionStatus = $vote->getElectionStatus($electionId,$status); //watch- class/Vote.php, Method-4
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Election Status</h2>
<?php
    if (isset($electionStatus)) {  //Show Message
        echo $electionStatus;
    }
?>        
            <div class="block copyblock">                
                 <form action="result_status.php" method="post" enctype="multipart/form-data">
                     <table class="form">		

<!-- ----------------- For Select Election Option ----------------- -->
                        <select name="electionId">
                              <option>--Select Election--</option>
<?php 
    $reg = new Registration();
    $getElection=$reg->getAllElection();  // watch- Registration.php, Method-6
    if ($getElection) {
        while ($result =$getElection->fetch_assoc()){ 
?>
                             <option value="<?php echo $result['electionId']; ?>"><?php echo $result['electionName']; ?></option>        
 <?php  } }  ?>
                            </select>
<!-- ___________________ X ______________________ --> 

<!-- ----------------- For Get Status Value from tbl_vote ----------------- -->
<?php
    // $electionId = $result['electionId'];

    // $vote = new Vote();
    // $getStatus = $vote->getStatus($electionId); //class/Vote.php, Method-5
    // while ($resultStatus = $getStatus->fetch_assoc()) {
    //     if ($resultStatus['status']=='enabled') { 
?>
                        <tr>
                            <td>
                                <!-- <input <?php //if ($resultStatus['status']=='enabled'){echo "checked" ;}  ?> type="radio" name="status" value="enabled"/>Enabled -->
                                <input type="radio" name="status" value="enabled"/>Enabled
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <!-- <input <?php //if ($resultStatus['status']=='disabled'){echo "checked" ;}  ?> type="radio" name="status" value="disabled" />Disabled -->
                                <input type="radio" name="status" value="disabled" />Disabled
                            </td>
                        </tr>
<?php  //} }  ?>
<!-- ____________________ X _____________________ --> 

                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>