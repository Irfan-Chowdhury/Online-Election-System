<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php

class Vote
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db =new Database();
        $this->fm =new Format();

    }

    // ******************** For voting.php *************************
    public function insertVote($canditateId,$userId)  //---------------->>>>>   Method-1
    {
        $canditateId = mysqli_real_escape_string($this->db->link, $canditateId);
        $userId      = mysqli_real_escape_string($this->db->link, $userId);
        //$votes       = mysqli_real_escape_string($this->db->link, $data['votes']);
        //$electionId  = mysqli_real_escape_string($this->db->link, $data['electionId']);

        // if(isset($data['votes'])) {  
        //     $votes   = mysqli_real_escape_string($this->db->link, $data['votes']);
        // }else{
        //     $votes = "";
        //     $msg= "<span class='error'> Please Select A Canditate</span>";
        //     return $msg;
        // }

        $query = "SELECT electionId FROM tbl_canditate WHERE canditateId = '$canditateId' ";
        $getData = $this->db->select($query);

        if ($getData) {
            while ($result = $getData->fetch_assoc()) 
            {
                $electionId= $result['electionId'];

                $query="INSERT INTO tbl_vote (userId,canditateId,votes,electionId)
                        VALUES('$userId','$canditateId','1',$electionId)";
                
                $inserted_row=$this->db->insert($query);
                if ($inserted_row) 
                {
                    $msg= "<span class='success'>Voting succesfully </span>";
                    return $msg;
                }
                else 
                {
                    $msg= "<span class='error'>Voting Failed</span>";
                    return $msg;
                }
            }
        }

                
    }


    // ******************** For result.php *************************

    public function getCanditateResult($canditateId,$electionId) //---------------->>>>>   Method-2
    {
        //$query="SELECT SUM(votes) FROM tbl_vote WHERE canditateId='$canditateId' AND electionId='$electionId' ";
        $query="SELECT *FROM tbl_vote WHERE canditateId='$canditateId' AND electionId='$electionId' ";
        $result=$this->db->select($query);
        return $result;
    }


    // ******************** For Voting.php *************************

    public function getOnceVote($userId,$electionId) //---------------->>>>>   Method-3
    {
        $query="SELECT *FROM tbl_vote WHERE userId='$userId' AND electionId='$electionId' ";
        $result=$this->db->select($query);
        //$result->fetch_assoc();
        return $result;
    }

    // ******************** For result_status.php *************************

    public function getElectionStatus($electionId,$status)  //---------------->>>>>   Method-4
    {      
       
        $query="UPDATE tbl_vote
            SET 
            status='$status' 
            WHERE electionId='$electionId' ";
    
        $updated_row=$this->db->update($query);
        if ($updated_row) 
        {
            $msg= "<span class='success'>Update succesfully </span>";
            return $msg;
        }
        else 
        {
            $msg= "<span class='error'>Update Failed</span>";
            return $msg;
        }  
    }

    public function getStatus($electionId) //---------------->>>>>   Method-5
    {
        $query="SELECT status FROM tbl_vote WHERE electionId='$electionId' ";
        $result=$this->db->select($query);
        return $result;
    }
}

?>