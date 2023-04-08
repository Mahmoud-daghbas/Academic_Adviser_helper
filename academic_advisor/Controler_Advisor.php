<?php
require_once 'opertion_advisor.php';
  if (isset($_POST['oper'])&&$_POST['oper']==="add_advisor") {
    // Get the input values from the AJAX request
    $Id_Advisor=$_POST['Id_Advisor'];
    $Name_Advisor = $_POST['Name_Advisor'];
    $Email_Advisor = $_POST['Email_Advisor'];
    $Phone_Number = $_POST['Phone_Number'];
    $Office_Room = $_POST['Office_Room'];
    $Id_Dept = $_POST['Id_Dept'];
 

    // Call the add_student function and pass in the input values
    add_advisor($Id_Advisor,$Name_Advisor,$Email_Advisor,$Phone_Number,$Office_Room,$Id_Dept);
}
if (isset($_POST['oper'])&&$_POST['oper']==="update_advisor") {
  // Get the input values from the AJAX request
  $Id_Advisor=$_POST['Id_Advisor'];
  $Name_Advisor = $_POST['Name_Advisor'];
  $Email_Advisor = $_POST['Email_Advisor'];
  $Phone_Number = $_POST['Phone_Number'];
  $Office_Room = $_POST['Office_Room'];
  $Id_Dept = $_POST['Id_Dept'];

  // Call the add_student function and pass in the input values
  update_advisor($Id_Advisor,$Name_Advisor,$Email_Advisor,$Phone_Number,$Office_Room,$Id_Dept);
}
if (isset($_POST['delete_advisor'])) {
  // Get the input values from the AJAX request
  $Id_Advisor = $_POST['Id_Advisor'];

  // Call the delete_student function and pass in the input values
  delete_advisor($Id_Advisor);
}
if (isset($_POST['select_advisor'])) 
{
  $Id_Dept=$_POST['Id_Dept'];
  select_advisor_in_deptAssigment($Id_Dept);
}
if (isset($_POST['oper']) && $_POST['oper']=='select_advisor' ) 
{
 $data= $_POST['data'];
  $Id_Dept=$data;
  select_advisor_in_deptAssigment($Id_Dept);
}
?>