<?php
require_once 'opertion_courses.php';
  if (isset($_POST['oper'])&&$_POST['oper']==="add_Course") {
    // Get the input values from the AJAX request
    $Course_Code=$_POST['Course_Code'];
    $Name_Course = $_POST['Name_Course'];
    $Hour_Credit = $_POST['Hour_Credit'];
    $short_description = $_POST['short_description'];
  
 

    // Call the add_student function and pass in the input values
    add_Course($Course_Code,$Name_Course,$Hour_Credit,$short_description);
}
if (isset($_POST['oper'])&&$_POST['oper']==="update_Course") {
  // Get the input values from the AJAX request
  $Id_Course=$_POST['Id_Course'];
  $Course_Code=$_POST['Course_Code'];
  $Name_Course = $_POST['Name_Course'];
  $Hour_Credit = $_POST['Hour_Credit'];
  $short_description = $_POST['short_description'];


  // Call the add_student function and pass in the input values
  update_Course($Id_Course,$Course_Code,$Name_Course,$Hour_Credit,$short_description);
}
if (isset($_POST['delete_Course'])) {
  // Get the input values from the AJAX request
  $Id_Course = $_POST['Id_Course'];

  // Call the delete_student function and pass in the input values
  delete_Course($Id_Course);
}

?>