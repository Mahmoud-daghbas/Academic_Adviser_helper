<?php
include '..\login\config.php';
$query=$conn->query("SELECT `Id_Student`, `Name_Student`, IF(`Gender_Student`=1,'ذكر', 'انثى') gender,`Date_Birth`, `Phone_Student`, `Email_Student`,  concat(d.`Code_Dept`, d.`Name_Dept` ) as'Name_Dept' FROM `table_students` s inner JOIN table_department d on  s.Id_Dept=d.Id_Dept");
$data=array();
while ($row=$query->fetch_assoc())
{
$data[]=$row;



}
echo json_encode($data);

?>