<?php

session_start();
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
else if ($_SESSION['role'] == 'user') { 
    echo "<h4>Users are not allowed to use this functionality</h4>";
}
else {

// include database and object files
include_once '../database/database.php';
include_once '../objects/persons.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$person = new Persons($db);
$page_title = "Create Person";
include_once "../layout/layout_header.php";

if ($_SESSION['username'] == $person->email) {
    
}
  
echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Read People</a>
    </div>";
  
// if the form was submitted
if($_POST){
  
    // set product property values
    $person->role = $_POST['role'];
    $person->fname = $_POST['fname'];
    $person->lname = $_POST['lname'];
    $person->email = $_POST['email'];
    $person->phone = $_POST['phone'];
    $salt = MD5(microtime(true));
    $person->password_hash = MD5($_POST['password'] . $salt);
    $person->password_salt = $salt;
    $person->address = $_POST['address'];
    $person->address2 = $_POST['address2'];
    $person->city = $_POST['city'];
    $person->state = $_POST['state'];
    $person->zip_code = $_POST['zip_code'];


    //code for hashing and salting password
    

    
	
    // create the product
    if($person->create()){
        echo "<div class='alert alert-success'>Person was created.</div>";
		
    }
    // if unable to create the product, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create Person.</div>";
    }
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
  
    <table class='table table-hover table-responsive table-bordered'>
  
        <tr>
            <td>Role</td>
            <td> 
                <select name='role' class='form-control'>
                    <option value ="" selected disabled>--Choose A Role--</option>
                    <option value='admin'>Admin</option>
                    <option value='user'>User</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>First Name</td>
            <td><input type='text' name='fname' class='form-control' /></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type='text' name='lname' class='form-control'></input></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type='text' name='email' class='form-control'></input></td>
        </tr>
        <tr>
            <td>Phone Number</td>
            <td><input type='text' name='phone' class='form-control'></input></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type='text' name='password' class='form-control'></input></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><input type='text' name='address' class='form-control'></input></td>
        </tr>
        <tr>
            <td>Address 2</td>
            <td><input type='text' name='address2' class='form-control'></input></td>
        </tr>
        <tr>
            <td>City</td>
            <td><input type='text' name='city' class='form-control'></input></td>
        </tr>
        <tr>
            <td>State</td>
            <td><input type='text' name='state' class='form-control'></input></td>
        </tr>
        <tr>
            <td>Zip Code</td>
            <td><input type='text' name='zip_code' class='form-control'></input></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
    </table>
</form>

<?php
// footer
//include_once "../layout/layout_footer.php";
}
?>
