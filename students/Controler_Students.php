<?php
require_once 'opertion_student.php';
  if (isset($_POST['oper'])&&$_POST['oper']==="add_student") {
    // Get the input values from the AJAX request
    $id_student=$_POST['id_student'];
    $s_name = $_POST['s_name'];
    $s_gender = $_POST['s_gender'];
    $birth_date = $_POST['birth_date'];
    $phone_no = $_POST['phone_no'];
    $s_email = $_POST['s_email'];
    $id_dept = $_POST['id_dept'];
    $id_plan = $_POST['Id_Plan'];
    unset($_POST["oper"]);
    // Call the add_student function and pass in the input values
    add_student($id_student,$s_name, $s_gender, $birth_date, $phone_no, $s_email, $id_dept, $id_plan);
}
if (isset($_POST['oper'])&&$_POST['oper']==="update_student") {
  // Get the input values from the AJAX request
  $id_student=$_POST['id_student'];
  $s_name = $_POST['s_name'];
  $s_gender = $_POST['s_gender'];
  $birth_date = $_POST['birth_date'];
  $phone_no = $_POST['phone_no'];
  $s_email = $_POST['s_email'];
  $id_dept = $_POST['id_dept'];
  $id_plan = $_POST['Id_Plan'];
  $_POST = array();
  // Call the add_student function and pass in the input values
  update_student($id_student,$s_name, $s_gender, $birth_date, $phone_no, $s_email, $id_dept, $id_plan);
}
if (isset($_POST['delete_student'])) {
  // Get the input values from the AJAX request
  $id_student = $_POST['id_student'];
  unset($_POST["delete_student"]);
  // Call the delete_student function and pass in the input values
  delete_student($id_student);

}
if (isset($_POST['select_students'])) 
{
  $Id_Dept=$_POST['Id_Dept'];
  select_student_in_dept_assigment($Id_Dept);
  $_POST = array();
}
if (isset($_POST['select_student_join_advisor'])) 
{
  $idvsior=$_POST['advisor'];
  $_POST = array();
  select_student_join_advisor_assigment($idvsior);

  
}?>