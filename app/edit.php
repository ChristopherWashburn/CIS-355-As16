<?php
session_start();
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
else {

    // get ID of the product to be read
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
      
    // include database and object files
    include_once '../database/database.php';
    include_once '../objects/persons.php';
      
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
      
    // prepare objects
    $person = new Persons($db);
      
    // set ID property of product to be read
    $person->id = $id;
      
    // read the details of product to be read
    $person->readOne();

    if($_SESSION['role'] == 'admin' || $person->email == $_SESSION['username'])
    {
        // set page header
    $page_title = "Update Person";
    include_once "../layout/layout_header.php";
      
    echo "<div class='right-button-margin'>
              <a href='index.php' class='btn btn-default pull-right'>Read Products</a>
         </div>";
      

        // if the form was submitted
    if($_POST) {
      
        // set product property values
        if($_SESSION['role'] == 'admin')
        {
            $person->role = $_POST['role'];
        }
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
        $person->zip = $_POST['zip_code'];
      
        // update the product
        if($person->update()){
            echo "<div class='alert alert-success alert-dismissable'>";
                echo "Product was updated.";
            echo "</div>";
        }
      
        // if unable to update the product, tell the user
        else {
            echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Unable to update product.";
            echo "</div>";
        }
    }
    ?>
      
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
        <table class='table table-hover table-responsive table-bordered'>
      
            <tr>
                <td>Role</td>
                <td> 
                    <select name='role' class='form-control' <?php if ($_SESSION['role'] == 'user') echo 'disabled'?>>
                        <option value='admin' <?php if($person->role == 'admin') echo 'selected="selected"'; ?>>Admin</option>
                        <option value='user' <?php if($person->role == 'user') echo 'selected'; ?> >User</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><input type='text' name='fname' class='form-control' value='<?php echo $person->fname; ?>' /></td>
            </tr>
            <tr>
                <td>Last Name</td>
                <td><input type='text' name='lname' class='form-control' value='<?php echo $person->lname; ?>'></input></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type='text' name='email' class='form-control' value='<?php echo $person->email; ?>'></input></td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td><input type='text' name='phone' class='form-control' value='<?php echo $person->phone; ?>'></input></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type='text' name='password' class='form-control'></input></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input type='text' name='address' class='form-control' value='<?php echo $person->address; ?>'></input></td>
            </tr>
            <tr>
                <td>Address 2</td>
                <td><input type='text' name='address2' class='form-control' value='<?php echo $person->address2; ?>'></input></td>
            </tr>
            <tr>
                <td>City</td>
                <td><input type='text' name='city' class='form-control' value='<?php echo $person->city; ?>'></input></td>
            </tr>
            <tr>
                <td>State</td>
                <td><input type='text' name='state' class='form-control' value='<?php echo $person->state; ?>'></input></td>
            </tr>
            <tr>
                <td>Zip Code</td>
                <td><input type='text' name='zip_code' class='form-control' value='<?php echo $person->zip; ?>'></input></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-primary">Update</button>
                </td>
            </tr>
        </table>
    </form>

    <?php
    //set page footer
    include_once "../layout/layout_footer.php";
    }
    else {
        echo "<h4>Users are not allowed to use this functionality</h4>";
    }
      
    
}
?>