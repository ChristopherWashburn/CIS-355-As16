<?php

session_start();
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
else {

// include database and object files
include_once '../database/database.php';
include_once '../objects/persons.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
$person = new Persons($db);
  
$page_title = "People Menu";
include_once "../layout/layout_header.php";
  
// query products
$stmt = $person->readAll();
$total_rows = $person->countAll();

echo "<div class='left-button-margin'>";
    echo "<a href='logout.php' class='btn btn-primary pull-left'>";
        echo "<span class='glyphicon glyphicon-minus'></span>Logout";
    echo "</a>";
echo "</div>";
  
// create product button
echo "<div class='right-button-margin'>";
    echo "<a href='create.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Create Person";
    echo "</a>";
echo "</div>";

  
// display the products if there are any
if($total_rows>0){
  
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Email</th>";
            echo "<th>Controls</th>";
        echo "</tr>";
  
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
            extract($row);
  
            echo "<tr>";
                echo "<td>{$fname}</td>";
                echo "<td>{$lname}</td>";
                echo "<td>{$email}</td>";
  
                echo "<td>";
  
                    // read product button
                    echo "<a href='read_person.php?id={$id}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";
  
                    // edit product button
                    echo "<a href='edit.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
  
                    // delete product button
                    echo "<a delete-id='{$id}' fname-id='{$fname}' lname-id='{$lname}' email='{$email}' class='btn btn-danger delete-object'> ";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a>";
  
                echo "</td>";
  
            echo "</tr>";
        }
    echo "</table>";
}
  
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No products found.</div>";
}
include_once "../layout/layout_footer.php";

}

?>