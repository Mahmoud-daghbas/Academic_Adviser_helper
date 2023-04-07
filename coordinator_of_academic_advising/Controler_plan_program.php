<?php
require_once 'opertion_plan_program.php';
if(isset($_POST['oper'])&&$_POST['oper']==='insert' )
{
    // Retrieve data from POST request
$data = $_POST['data'];
$Id_Plan=$_POST['Id_Plan'];
$Name_Plan=$_POST['Name_Plan'];
$Date_create=$_POST['Date_create'];
$Id_Dept=$_POST['Id_Dept'];

add_plan_programing($Id_Plan,$Name_Plan,$Date_create,$Id_Dept,$data);


}
if(isset($_POST['oper'])&&$_POST['oper']==='select' )
{
    $Id_Dept=$_POST['Id_Dept'];
    select_plan_in_dept($Id_Dept);
}

?>