<?php 

// Format calss 
class Format{
    public function formatDate($date){
        return date ('F j, Y, g:i a',strtotime($date));
    }

    public function textShorten($text, $limit = 400){
        $text=$text." ";
        $text= substr($text, 0, $limit);
        // $text= substr($text, 0, strrpos($text, ' '));
        $text= $text."....";
        return $text;
    }

    public function validation ($data){
        $data= trim($data); // inbuilt function which removes whitespaces and also the predefined characters from both sides of a string that is left and right.
        $data= stripcslashes($data); //removes backslashes added by the addcslashes() function. Tip: This function can be used to clean up data retrieved from a database or from an HTML form.
        $data= htmlspecialchars($data);  //use for protect script tag
        return $data;
    }
     
    public function title(){
        $path = $_SERVER['SCRIPT_FILENAME'];
        $title = basename($path,'.php');
        //$title=str_replace('_',' ',$title);  //if i use contact_us.php it show Contact us
        if ($title == 'index') {
            $title ='home';
        }elseif($title=='contact'){
            $title ='contact';
        }

        return $title = ucwords($title);
        //return $title = ucfirst($title);
      }

}

?>