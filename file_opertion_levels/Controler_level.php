<?php
require_once 'opertion_levels.php';
  if (isset($_POST['oper'])&&$_POST['oper']==="add_Level") {
    // Get the input values from the AJAX request
    $Name_Level = $_POST['Name_Level'];
    // Call the add_student function and pass in the input values
    add_Level($Name_Level);
}
if (isset($_POST['oper'])&&$_POST['oper']==="update_Level") {
  // Get the input values from the AJAX request
  $Name_Level = $_POST['Name_Level'];
  $Id_Level = $_POST['Id_Level'];
  // Call the add_student function and pass in the input values
  update_Level($Id_Level,$Name_Level);
}
if (isset($_POST['delete_Level'])) {
  // Get the input values from the AJAX request
  $Id_Level = $_POST['Id_Level'];

  // Call the delete_student function and pass in the input values
  delete_Level($Id_Level);
}
if(isset($_GET['select_level']))
select_level();

?>