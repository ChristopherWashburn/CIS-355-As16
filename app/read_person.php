<?php

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

// set page headers
$page_title = "Person Details";
include_once "../layout/layout_header.php";
  
// read products button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Main Menu";
    echo "</a>";
echo "</div>";

// HTML table for displaying a product details
echo "<table class='table table-hover table-responsive table-bordered'>";
  
    echo "<tr>";
        echo "<td>Id</td>";
        echo "<td>{$person->id}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>First Name</td>";
        echo "<td>{$person->fname}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Last Name</td>";
        echo "<td>{$person->lname}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Role</td>";
        echo "<td>{$person->role}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Email</td>";
        echo "<td>{$person->email}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Password Hash</td>";
        echo "<td>{$person->password_hash}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Password Salt</td>";
        echo "<td>{$person->password_salt}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Address</td>";
        echo "<td>{$person->address}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Address 2</td>";
        echo "<td>{$person->address2}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>City</td>";
        echo "<td>{$person->city}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>State</td>";
        echo "<td>{$person->state}</td>";
    echo "</tr>";

    echo "<tr>";
        echo "<td>Zip Code</td>";
        echo "<td>{$person->zip_code}</td>";
    echo "</tr>";
echo "</table>";
  
// set footer
include_once "../layout/layout_footer.php";
?>