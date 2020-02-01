<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/Database.php');
    include_once ($filepath.'/../helpers/Format.php');
?>

<?php

class Registration
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db =new Database();
        $this->fm =new Format();

    }

    // ******************** For registration.php *************************

    public function userRegistration($data,$file)  //---------------->>>>>   Method-1
    {
        $name     = mysqli_real_escape_string($this->db->link, $data['name']);
        $age      = mysqli_real_escape_string($this->db->link, $data['age']);
        $address  = mysqli_real_escape_string($this->db->link, $data['address']);
        $voterId  = mysqli_real_escape_string($this->db->link, $data['voterId']);
        $email    = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $status   = mysqli_real_escape_string($this->db->link, $data['status']);

        $permited   = array('jpg', 'jpeg', 'png', 'gif');
        $file_name  = $file['image']['name'];
        $file_size  = $file['image']['size'];
        $file_temp  = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "admin/uploads/".$unique_image;

        if(isset($data['gender'])) {
            $gender   = mysqli_real_escape_string($this->db->link, $data['gender']);
        }else{
            $gender = "";
            $msg= "<span class='error'> Feild must not be empty !</span>";
            return $msg;
        }

        if ($file_name=="" || $name=="" || $age=="" || $address=="" || $voterId=="" || $email=="" || $password=="" || $status==""  ) 
        {
            $msg= "<span class='error'> Feild must not be empty !</span>";
                return $msg;
        }

        $mailquery = "SELECT *FROM tbl_user WHERE email ='$email' LIMIT 1";
        $mailcheck =$this->db->select($mailquery);

        $voterIdquery = "SELECT *FROM tbl_user WHERE voterId='$voterId' LIMIT 1";
        $voterIdcheck =$this->db->select($voterIdquery);

        if ($mailcheck != false) 
        {
            $msg= "<span class='error'>Email already exists !</span>";
            return $msg;

        }
        elseif ($voterIdcheck != false) 
        {
            $msg= "<span class='error'>VoterId already exists !</span>";
            return $msg;
        }
        else 
        {
            move_uploaded_file($file_temp, $uploaded_image);

            $query = "INSERT INTO  tbl_user (image,name,gender,age,address,voterId,email,password,status)
                      VALUES('$uploaded_image','$name','$gender','$age','$address','$voterId','$email','$password','$status') ";
            $inserted_row=$this->db->insert($query);
            if ($inserted_row) 
            {
                $msg= "<span class='success-yellow'>Voter Registration Inserted succesfully </span>";
                return $msg;
            }
            else 
            {
                $msg= "<span class='error'>Voter Registration Inserted Failed</span>";
                return $msg;
            }          
        }
    }

    // ******************** For login.php *************************

    public function userLogin($userVoterId,$userPass)  //---------------->>>>>   Method-2
    {   
        $userVoterId = $this->fm->validation($userVoterId);
        $userPass    =$this->fm->validation($userPass);

        $userVoterId =  mysqli_real_escape_string($this->db->link, $userVoterId);
        $userPass    = mysqli_real_escape_string($this->db->link, $userPass);
            
        if (empty($userVoterId) || empty($userPass)) 
        {
            //$msg= "<span class='error'> Feild must not be empty !</span>";
            $msg= "<span style='color:red'> Feild must not be empty !</span>";
            return $msg;
        }

        $query  ="SELECT *FROM tbl_user WHERE voterId ='$userVoterId' AND password='$userPass' ";
        $result = $this->db->select($query);
        if ($result != false) 
        {
            $value = $result->fetch_assoc();
            Session::set("userLogin",true);
            Session::set("userId",$value['userId']);
            Session::set("voterId",$value['voterId']);
            Session::set("name",$value['name']);
            header("Location:index.php");                        
        }
        else 
        {
            $msg= "<span style='color:red'> Email or Password not matched !</span>";
            return $msg;                   
        }

    }

     // ******************** For canditatereg.php *************************

    public function canditateRegistration($data, $file)  //---------------->>>>>   Method-3
    {
        $name       =$this->fm->validation($data['name']);
        $age        =$this->fm->validation($data['age']);
        $address    =$this->fm->validation($data['address']);
        $voterId    =$this->fm->validation($data['voterId']);
        $designation=$this->fm->validation($data['designation']);
        $commitment =$this->fm->validation($data['commitment']);
        $email      =$this->fm->validation($data['email']);
        //$password   =$this->fm->validation($data['password']);
        //$status     =$this->fm->validation($data['status']);

        $name       = mysqli_real_escape_string($this->db->link, $data['name']);
        $age        = mysqli_real_escape_string($this->db->link, $data['age']);
        $country    = mysqli_real_escape_string($this->db->link, $data['country']);
        $address    = mysqli_real_escape_string($this->db->link, $data['address']);
        $voterId    = mysqli_real_escape_string($this->db->link, $data['voterId']);
        $designation= mysqli_real_escape_string($this->db->link, $data['designation']);
        $commitment = mysqli_real_escape_string($this->db->link, $data['commitment']);
        $email      = mysqli_real_escape_string($this->db->link, $data['email']);
        //$password   = mysqli_real_escape_string($this->db->link, md5($data['password']));
        $electionId = mysqli_real_escape_string($this->db->link, $data['electionId']);

        $permited   = array('jpg', 'jpeg', 'png', 'gif');
        $file_name  = $file['image']['name'];
        $file_size  = $file['image']['size'];
        $file_temp  = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "admin/uploads/".$unique_image;
        
        $mailquery = "SELECT *FROM tbl_canditate WHERE email ='$email' LIMIT 1";
        $mailcheck =$this->db->select($mailquery);

        $voterIdquery = "SELECT *FROM tbl_canditate WHERE voterId='$voterId' LIMIT 1";
        $voterIdcheck = $this->db->select($voterIdquery);

        $electionIdquery = "SELECT *FROM tbl_canditate WHERE electionId='$electionId' ";
        $electionIdcheck = $this->db->select($electionIdquery);


        
        $voterId_user_query = "SELECT *FROM tbl_user WHERE voterId='$voterId' ";
        $voterId_user_check =$this->db->select($voterId_user_query);

        $mail_user_query = "SELECT *FROM tbl_user WHERE email ='$email' ";
        $mail_user_check =$this->db->select($mail_user_query);

        if(isset($data['gender'])) {  //for gender
            $gender   = mysqli_real_escape_string($this->db->link, $data['gender']);
        }else{
            $gender = "";
            $msg= "<span class='error'> Feild must not be empty !</span>";
            return $msg;
        }

        if ( $file_name=="" || $name =="" || $age =="" || $address =="" || $voterId =="" || $designation =="" || $commitment =="" || $email =="" || $electionId =="" ) 
        {
            $msg= "<span class='error'>Feild must not be empty !</span>";
            return $msg;
        }
        elseif (($voterId_user_check and $mail_user_check) != true) 
        {
            $msg= "<span class='error'>Your identity do not match with voter list !</span>";
            return $msg;
        }
        elseif (($voterIdcheck and $electionIdcheck) == true) 
        {
            $msg= "<span class='error'>VoterId already exists !</span>";
            return $msg;
        }
        elseif (($mailcheck and $electionIdcheck) == true) 
        {
            $msg= "<span class='error'>Email already exists !</span>";
            return $msg;

        }
        elseif ($file_size >1048567) 
        {
            echo "<span class='error'>Image Size should be less then 1MB!</span>";
        } 
        elseif (in_array($file_ext, $permited) === false) 
        {
            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
        }
        else 
        // elseif ($voterIdcheck == $voterId_user_check)
        {
            move_uploaded_file($file_temp, $uploaded_image);

            $query="INSERT INTO tbl_canditate (image,name,gender,age,country,address,voterId,designation,commitment,email,electionId) 
                    VALUES('$uploaded_image','$name','$gender','$age','$country','$address','$voterId','$designation','$commitment','$email','$electionId') ";
            $inserted_row=$this->db->insert($query);
            if ($inserted_row) {
                $msg= "<span class='success-yellow'>Canditate Registration Succesfully </span>";
                return $msg;
            }else {
                $msg= "<span class='error'>Canditate Registration Failed</span>";
                return $msg;
            }
        }
    }



    // ******************** For canditatereg.php *************************

    public function getAllCountry() //---------------->>>>>   Method-4
    {
        $query="SELECT *FROM tbl_country ORDER BY countryName ASC";
        $result=$this->db->select($query);
        return $result;
    }

     // ******************** For result.php *************************

     public function getAllCanditate() //---------------->>>>>   Method-5
     {
         $query="SELECT *FROM tbl_canditate ";
        //  $query="SELECT tbl_canditate.voterId, tbl_canditate.electionId  electionName.tbl_election FROM tbl_canditate INNER JOIN tbl_election ON tbl_canditate.electionId = tbl_election.electionId";
         $result=$this->db->select($query);
         return $result;
     }

     // ******************** For canditatereg.php *************************

     public function getAllElection() //---------------->>>>>   Method-6
     {
         $query="SELECT *FROM tbl_election ";
         $result=$this->db->select($query);
         return $result;
     }

     // ******************** For voting.php *************************

     public function getAllCanditateByCandId($electionId) //---------------->>>>>   Method-7
     {
         $query="SELECT *FROM tbl_canditate WHERE electionId='$electionId' ";
         $result=$this->db->select($query);
         return $result;
     }


     // ******************** For voting.php *************************

     public function getUserProfile($voterId) //---------------->>>>>   Method-8
     {
         //$query="SELECT *FROM tbl_user WHERE userId='$userId' ";
         $query="SELECT *FROM tbl_user WHERE voterId='$voterId' ";
         $result=$this->db->select($query);
         return $result;
     }
     
     // ******************** For result.php *************************

     public function innerAllCanditate() //---------------->>>>>   Method-9
     {
         $query="SELECT C.*, V.votes 
                 FROM tbl_canditate as C, tbl_vote as V
                 WHERE C.canditateId = V.canditateId ";
         $result=$this->db->select($query);
         return $result;
     }

// ******************** For result.php *************************

     public function userUpdate($data, $file, $voterId)  //Method-10
     {
        
        $name     = mysqli_real_escape_string($this->db->link, $data['name']);
        $age      = mysqli_real_escape_string($this->db->link, $data['age']);
        $address  = mysqli_real_escape_string($this->db->link, $data['address']);
        // $voterId  = mysqli_real_escape_string($this->db->link, $data['voterId']);
        // $email    = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
        //$status   = mysqli_real_escape_string($this->db->link, $data['status']);

        $permited   = array('jpg', 'jpeg', 'png', 'gif');
        $file_name  = $file['image']['name'];
        $file_size  = $file['image']['size'];
        $file_temp  = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "admin/uploads/".$unique_image;

        // ---- mail & VoterId Check ---------------
        // $mailquery = "SELECT *FROM tbl_user WHERE email ='$email' LIMIT 1";
        // $mailcheck =$this->db->select($mailquery);

        // $voterIdquery = "SELECT *FROM tbl_user WHERE voterId='$voterId' LIMIT 1";
        // $voterIdcheck =$this->db->select($voterIdquery);
        
        
        // ---- Now turn to apply condition -------
        
        if(isset($data['gender'])) {
            $gender   = mysqli_real_escape_string($this->db->link, $data['gender']);
        }else{
            $gender = "";
            $msg= "<span class='error'> Feild must not be empty !</span>";
            return $msg;
        }
        

        if ( $name=="" || $age=="" || $address=="" ||$password=="" ) //|| $status=="" 
        { 
            $msg= "<span class='error'> Feild must not be empty !</span>";
                return $msg;
        }
        // elseif ($mailcheck != false) 
        // {
        //     $msg= "<span class='error'>Email already exists !</span>";
        //     return $msg;

        // }
        // elseif ($voterIdcheck != false) 
        // {
        //     $msg= "<span class='error'>VoterId already exists !</span>";
        //     return $msg;
        // }
        else 
        {
            if (!empty($file_name)) 
            {            
                if ($file_size >1048567) 
                {
                    echo "<span class='error'>Image Size should be less then 1MB!</span>";
                } 
                elseif (in_array($file_ext, $permited) === false) 
                {
                    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                }
                else //--->when image file axists
                {
                    move_uploaded_file($file_temp, $uploaded_image);

                    $query="UPDATE tbl_user
                            SET
                            image='$uploaded_image', 
                            name='$name', 
                            gender='$gender', 
                            age='$age', 
                            address='$address', 
                            password='$password'
                            WHERE voterId='$voterId' ";  

                    $updated_row=$this->db->update($query) ;
                    if ($updated_row) 
                    {
                        header("Location:profile.php");
                        // $msg= "<span class='success'>User Profile Updated succesfully </span>";
                        // return $msg;
                    }
                    else 
                    {
                        $msg= "<span class='error'>User Profile Updated Failed</span>";
                        return $msg;
                    }
                }
            }
            else  //--->when image file does not axists
            {
                $query="UPDATE tbl_user
                        SET
                        name='$name', 
                        gender='$gender', 
                        age='$age', 
                        address='$address', 
                        password='$password'
                        WHERE voterId='$voterId' ";

                $updated_row=$this->db->update($query) ;
                if ($updated_row) 
                {
                    header("Location:profile.php");
                    // $msg= "<span class='success'>User Profile Updated succesfully </span>";
                    // return $msg;
                }
                else 
                {
                    $msg= "<span class='error'>User Profile Updated Failed</span>";
                    return $msg;
                }
            }
        }
     }



     public function getAllDesignation()  //Method-11
     {
        $query="SELECT *FROM tbl_designation";
        $result=$this->db->select($query);
        return $result;
     }


     // ******************** For editCandProfile.php *************************

     public function getCandProfile($voterId) //---------------->>>>>   Method-12 
     {
         $query="SELECT *FROM tbl_canditate WHERE voterId ='$voterId' ";
         $result=$this->db->select($query);
         return $result;
     }





     // ******************** For result.php *************************

     public function candUpdate($data, $file, $voterId)  //Method-13
     {
        
        $name     = mysqli_real_escape_string($this->db->link, $data['name']);
        $age      = mysqli_real_escape_string($this->db->link, $data['age']);
        $address  = mysqli_real_escape_string($this->db->link, $data['address']);
        // $voterId  = mysqli_real_escape_string($this->db->link, $data['voterId']);
        // $email    = mysqli_real_escape_string($this->db->link, $data['email']);
        //$status   = mysqli_real_escape_string($this->db->link, $data['status']);

        $permited   = array('jpg', 'jpeg', 'png', 'gif');
        $file_name  = $file['image']['name'];
        $file_size  = $file['image']['size'];
        $file_temp  = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "admin/uploads/".$unique_image;

        // ---- mail & VoterId Check ---------------
        // $mailquery = "SELECT *FROM tbl_user WHERE email ='$email' LIMIT 1";
        // $mailcheck =$this->db->select($mailquery);

        // $voterIdquery = "SELECT *FROM tbl_user WHERE voterId='$voterId' LIMIT 1";
        // $voterIdcheck =$this->db->select($voterIdquery);
        
        
        // ---- Now turn to apply condition -------
        
        if(isset($data['gender'])) {
            $gender   = mysqli_real_escape_string($this->db->link, $data['gender']);
        }else{
            $gender = "";
            $msg= "<span class='error'> Feild must not be empty !</span>";
            return $msg;
        }
        

        if ( $name=="" || $age=="" || $address=="" ) //|| $status=="" 
        { 
            $msg= "<span class='error'> Feild must not be empty !</span>";
                return $msg;
        }
        // elseif ($mailcheck != false) 
        // {
        //     $msg= "<span class='error'>Email already exists !</span>";
        //     return $msg;

        // }
        // elseif ($voterIdcheck != false) 
        // {
        //     $msg= "<span class='error'>VoterId already exists !</span>";
        //     return $msg;
        // }
        else 
        {
            if (!empty($file_name)) 
            {            
                if ($file_size >1048567) 
                {
                    echo "<span class='error'>Image Size should be less then 1MB!</span>";
                } 
                elseif (in_array($file_ext, $permited) === false) 
                {
                    echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
                }
                else //--->when image file axists
                {
                    move_uploaded_file($file_temp, $uploaded_image);

                    $query="UPDATE tbl_canditate
                            SET
                            image='$uploaded_image', 
                            name='$name', 
                            gender='$gender', 
                            age='$age', 
                            address='$address'
                            WHERE voterId='$voterId' ";  

                    $updated_row=$this->db->update($query) ;
                    if ($updated_row) 
                    {
                        //header("Location:profile.php");
                         $msg= "<span class='success'>User Profile Updated succesfully </span>";
                         return $msg;
                    }
                    else 
                    {
                        $msg= "<span class='error'>User Profile Updated Failed</span>";
                        return $msg;
                    }
                }
            }
            else  //--->when image file does not axists
            {
                $query="UPDATE tbl_canditate
                        SET
                        name='$name', 
                        gender='$gender', 
                        age='$age', 
                        address='$address'
                        WHERE voterId='$voterId' ";

                $updated_row=$this->db->update($query) ;
                if ($updated_row) 
                {
                    //header("Location:profile.php");
                     $msg= "<span class='success'>User Profile Updated succesfully </span>";
                     return $msg;
                }
                else 
                {
                    $msg= "<span class='error'>User Profile Updated Failed</span>";
                    return $msg;
                }
            }
        }
     }


// ******************** For editprofile.php *************************

    //  public function userProfile($userId)
    //  {
    //     $query="SELECT *FROM tbl_user WHERE userId='$userId' ";
    //      $result=$this->db->select($query);
    //      return $result;
    //  }

     
}

?>