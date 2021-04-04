<?php
// check if value was posted
if($_POST){
  
    if($_SESSION['role'] == 'admin')
    {
        // include database and object file
        include_once '../database/database.php';
        include_once '../objects/persons.php';
  
        // get database connection
        $database = new Database();
        $db = $database->getConnection();
  
        // prepare product object
        $person = new Persons($db);
      
        // set product id to be deleted
        $person->id = $_POST['object_id'];
        $person->email = $_POST['email'];

        if($_SESSION['email'] == $person->email)
        {
            // delete the product
            if($person->delete()){
                echo "Object was deleted.";
            }
            // if unable to delete the product
            else{
               echo "Unable to delete object.";
            }
        }
        
    }  
}
?>